<?php
/**
 * Quick PC Service - PHP Compatibility Helper
 * Handles deprecated PHP functions and provides compatibility layer for PHP 7.4+
 */

// Prevent direct access
if (!defined('APP_RUN')) {
    exit('Direct access not allowed');
}

/**
 * Polyfill for old PHP functions that may not exist in newer versions
 */

// Check if hash_algos is available (PHP 5.1.2+)
if (!function_exists('hash_algos')) {
    function hash_algos() {
        return array('md5', 'sha1', 'sha256', 'sha512');
    }
}

// String trim function with character list (PHP 4.1+)
if (!function_exists('trim_string')) {
    function trim_string($str, $charlist = " \t\n\r\0\x0B") {
        return trim($str, $charlist);
    }
}

// Safe serialization function
if (!function_exists('safe_serialize')) {
    function safe_serialize($data) {
        if (function_exists('json_encode')) {
            return json_encode($data);
        }
        return serialize($data);
    }
}

// Safe unserialize function
if (!function_exists('safe_unserialize')) {
    function safe_unserialize($data) {
        if (function_exists('json_decode')) {
            $decoded = json_decode($data, true);
            if ($decoded !== null) {
                return $decoded;
            }
        }
        if (is_string($data)) {
            return unserialize($data, ['allowed_classes' => false]);
        }
        return false;
    }
}

// Secure random bytes generation
if (!function_exists('secure_random_bytes')) {
    function secure_random_bytes($length = 16) {
        if (function_exists('random_bytes')) {
            return random_bytes($length);
        }
        if (function_exists('openssl_random_pseudo_bytes')) {
            return openssl_random_pseudo_bytes($length);
        }
        // Fallback for older systems
        $bytes = '';
        for ($i = 0; $i < $length; $i++) {
            $bytes .= chr(rand(0, 255));
        }
        return $bytes;
    }
}

// String position function - supports both single and multiple needles
if (!function_exists('str_contains')) {
    function str_contains($haystack, $needle) {
        if (is_array($needle)) {
            foreach ($needle as $n) {
                if (strpos($haystack, $n) !== false) {
                    return true;
                }
            }
            return false;
        }
        return strpos($haystack, $needle) !== false;
    }
}

// Array key exists with null coalesce
if (!function_exists('array_get')) {
    function array_get(&$array, $key, $default = null) {
        return isset($array[$key]) ? $array[$key] : $default;
    }
}

// Safely get POST/GET data
if (!function_exists('get_post')) {
    function get_post($key, $default = null, $type = 'POST') {
        $source = strtoupper($type) === 'GET' ? $_GET : $_POST;
        if (isset($source[$key])) {
            $value = $source[$key];
            if (is_array($value)) {
                return array_map('sanitize_input', $value);
            }
            return sanitize_input($value);
        }
        return $default;
    }
}

// Input sanitization function
if (!function_exists('sanitize_input')) {
    function sanitize_input($input) {
        if (is_array($input)) {
            return array_map('sanitize_input', $input);
        }
        return trim(htmlspecialchars(stripslashes($input), ENT_QUOTES, 'UTF-8'));
    }
}

// Escape string for database
if (!function_exists('escape_sql')) {
    function escape_sql($input, $db = null) {
        if (is_array($input)) {
            return array_map(function($v) use ($db) {
                return escape_sql($v, $db);
            }, $input);
        }
        
        if ($db && method_exists($db, 'real_escape_string')) {
            return $db->real_escape_string($input);
        }
        
        // Fallback using addslashes (less secure, but works)
        return addslashes($input);
    }
}

// Array filter with callback (PHP 5.3+)
if (!function_exists('array_filter_safe')) {
    function array_filter_safe($array, $callback = null, $flag = ARRAY_FILTER_USE_BOTH) {
        return array_filter($array, $callback, $flag);
    }
}

// Compatibility for file get contents with error suppression
if (!function_exists('file_get_safe')) {
    function file_get_safe($filename) {
        if (file_exists($filename) && is_readable($filename)) {
            return @file_get_contents($filename);
        }
        return false;
    }
}

// Compatibility for file put contents
if (!function_exists('file_put_safe')) {
    function file_put_safe($filename, $data) {
        $dir = dirname($filename);
        if (!is_dir($dir)) {
            @mkdir($dir, 0755, true);
        }
        return @file_put_contents($filename, $data);
    }
}

// Check if function is enabled
if (!function_exists('is_function_enabled')) {
    function is_function_enabled($function) {
        $disabled = explode(',', ini_get('disable_functions'));
        return !in_array($function, array_map('trim', $disabled));
    }
}

// Get safe database connection
if (!function_exists('get_db_connection')) {
    function get_db_connection($host, $user, $password, $database, $charset = 'utf8mb4') {
        if (!is_function_enabled('mysqli_connect')) {
            error_log('MySQLi extension is not enabled');
            return false;
        }
        
        try {
            $connection = new mysqli($host, $user, $password, $database);
            
            if ($connection->connect_error) {
                error_log('Database connection failed: ' . $connection->connect_error);
                return false;
            }
            
            // Set charset
            $connection->set_charset($charset);
            
            return $connection;
        } catch (Exception $e) {
            error_log('Database connection error: ' . $e->getMessage());
            return false;
        }
    }
}

/**
 * Disable deprecated error reporting for newer PHP versions
 */
if (version_compare(PHP_VERSION, '7.2.0') >= 0) {
    error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE);
}
?>
