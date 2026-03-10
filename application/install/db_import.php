<?php

require '../config.php';

$link = null;
$dbh = null;
$c_mysqli = false;
$c_pdo = false;

// Try MySQLi connection first (recommended)
if (is_function_enabled('mysqli_connect')) {
    try {
        $link = new mysqli($db_host, $db_user, $db_password, $db_name);
        
        if ($link->connect_error) {
            throw new Exception('MySQLi connection failed: ' . $link->connect_error);
        }
        
        // Set charset
        $link->set_charset('utf8mb4');
        $c_mysqli = true;
    } catch (Exception $e) {
        error_log('MySQLi connection error: ' . $e->getMessage());
        $link = null;
    }
}

// Fall back to PDO if MySQLi is not available
if (!$c_mysqli) {
    try {
        $dsn = "mysql:host={$db_host};dbname={$db_name};charset=utf8mb4";
        $dbh = new PDO($dsn, $db_user, $db_password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $c_pdo = true;
    } catch (PDOException $e) {
        error_log('PDO connection error: ' . $e->getMessage());
    }
}

// Read SQL file
$sql_file = 'primary.sql';
if (!file_exists($sql_file)) {
    echo 'Error: Database SQL file not found at ' . htmlspecialchars($sql_file);
    exit;
}

$sql = file_get_contents($sql_file);
if ($sql === false) {
    echo 'Error: Could not read SQL file';
    exit;
}

// Import database using appropriate method
$import_success = false;

if ($c_mysqli) {
    try {
        // Split SQL statements and execute each one
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $statement) {
            if (!empty($statement)) {
                if (!$link->query($statement)) {
                    error_log('Database import error: ' . $link->error);
                }
            }
        }
        $import_success = true;
    } catch (Exception $e) {
        error_log('Database import failed: ' . $e->getMessage());
    }
} elseif ($c_pdo) {
    try {
        $statements = array_filter(array_map('trim', explode(';', $sql)));
        foreach ($statements as $statement) {
            if (!empty($statement)) {
                $dbh->exec($statement);
            }
        }
        $import_success = true;
    } catch (PDOException $e) {
        error_log('PDO database import failed: ' . $e->getMessage());
    }
} else {
    echo 'Error: No database connection method available. Please ensure MySQLi or PDO is installed.';
    exit;
}

if ($import_success) {
    echo 'Database imported successfully';
} else {
    echo 'Failed to import database. Check logs for details.';
}
?>
}

echo '1';
