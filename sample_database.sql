-- =====================================================
-- Quick PC Service - Sample Database
-- For Testing & Demo Purpose
-- =====================================================
-- This SQL file contains sample database structure
-- and data for Quick PC Service Management System
-- =====================================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- =====================================================
-- Database: quickpcservice
-- =====================================================

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS quickpcservice;
USE quickpcservice;

-- =====================================================
-- Table structure for `accounts`
-- =====================================================

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `type` varchar(50) DEFAULT NULL,
  `balance` decimal(15,2) DEFAULT 0.00,
  `currency` varchar(10) DEFAULT 'USD',
  `status` varchar(20) DEFAULT 'active',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `accounts` VALUES
(1, 'Bank Account', 'Main Business Bank Account', 'bank', 25000.00, 'USD', 'active', '2026-01-01 10:00:00', '2026-01-05 15:30:00'),
(2, 'Cash Register', 'Cash on Hand', 'cash', 5000.00, 'USD', 'active', '2026-01-01 10:00:00', '2026-01-05 12:00:00');

-- =====================================================
-- Table structure for `contacts`
-- =====================================================

DROP TABLE IF EXISTS `contacts`;
CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) DEFAULT 'customer',
  `name` varchar(150) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `type` (`type`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contacts` VALUES
(1, 'customer', 'John Smith', 'john.smith@email.com', '+1-555-0101', 'https://johnsmith.com', 'United States', 'New York', '123 Main Street, New York, NY 10001', 'Regular customer, pays on time', 'active', '2026-01-01 08:00:00', '2026-01-05 14:20:00'),
(2, 'customer', 'Sarah Johnson', 'sarah.j@email.com', '+1-555-0102', 'https://sarahjohnson.com', 'United States', 'Los Angeles', '456 Oak Avenue, Los Angeles, CA 90001', 'New customer', 'active', '2026-01-02 09:30:00', '2026-01-04 11:15:00'),
(3, 'customer', 'Mike Chen', 'mike.chen@email.com', '+1-555-0103', NULL, 'United States', 'Chicago', '789 Maple Road, Chicago, IL 60601', 'VIP customer', 'active', '2026-01-03 10:45:00', '2026-01-05 09:00:00'),
(4, 'vendor', 'Office Supplies Inc', 'orders@officesupplies.com', '+1-555-1001', 'https://officesupplies.com', 'United States', 'Boston', '321 Business Blvd, Boston, MA 02101', 'Regular vendor for office supplies', 'active', '2026-01-01 08:00:00', '2026-01-05 10:30:00'),
(5, 'customer', 'Tech Solutions LLC', 'contact@techsolutions.com', '+1-555-0104', 'https://techsolutions.com', 'United States', 'Seattle', '999 Tech Way, Seattle, WA 98101', 'Corporate client', 'active', '2026-01-03 14:00:00', '2026-01-05 13:45:00');

-- =====================================================
-- Table structure for `invoices`
-- =====================================================

DROP TABLE IF EXISTS `invoices`;
CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(50) UNIQUE NOT NULL,
  `contact_id` int(11) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `terms` text DEFAULT NULL,
  `subtotal` decimal(15,2) DEFAULT 0.00,
  `tax` decimal(15,2) DEFAULT 0.00,
  `discount` decimal(15,2) DEFAULT 0.00,
  `total` decimal(15,2) DEFAULT 0.00,
  `status` varchar(20) DEFAULT 'draft',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `invoice_number` (`invoice_number`),
  KEY `contact_id` (`contact_id`),
  KEY `status` (`status`),
  FOREIGN KEY (`contact_id`) REFERENCES `contacts`(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invoices` VALUES
(1, 'INV-2026-001', 1, '2026-01-01', '2026-01-31', 'Payment due within 30 days', 'Net 30', 5000.00, 500.00, 0.00, 5500.00, 'paid', '2026-01-01 10:00:00', '2026-01-03 15:30:00'),
(2, 'INV-2026-002', 2, '2026-01-02', '2026-02-01', 'Payment due within 30 days', 'Net 30', 3500.00, 350.00, 175.00, 3675.00, 'sent', '2026-01-02 11:00:00', '2026-01-04 09:00:00'),
(3, 'INV-2026-003', 3, '2026-01-03', '2026-02-03', 'Payment due within 30 days', 'Net 30', 7500.00, 750.00, 0.00, 8250.00, 'sent', '2026-01-03 14:30:00', '2026-01-05 12:00:00'),
(4, 'INV-2026-004', 1, '2026-01-04', '2026-02-04', 'Payment due within 30 days', 'Net 30', 2500.00, 250.00, 125.00, 2625.00, 'draft', '2026-01-04 09:00:00', '2026-01-05 08:30:00'),
(5, 'INV-2026-005', 5, '2026-01-05', '2026-02-05', 'Payment due within 30 days', 'Net 30', 12000.00, 1200.00, 0.00, 13200.00, 'draft', '2026-01-05 13:00:00', '2026-01-05 13:45:00');

-- =====================================================
-- Table structure for `invoice_items`
-- =====================================================

DROP TABLE IF EXISTS `invoice_items`;
CREATE TABLE IF NOT EXISTS `invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `item_name` varchar(150) DEFAULT NULL,
  `item_description` text DEFAULT NULL,
  `quantity` decimal(10,2) DEFAULT 1.00,
  `unit_price` decimal(15,2) DEFAULT 0.00,
  `amount` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`),
  FOREIGN KEY (`invoice_id`) REFERENCES `invoices`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `invoice_items` VALUES
(1, 1, 'Computer Setup Service', 'Installation and configuration of new workstation', 1.00, 2500.00, 2500.00, '2026-01-01 10:00:00'),
(2, 1, 'Network Installation', 'Setup of secure network infrastructure', 1.00, 2500.00, 2500.00, '2026-01-01 10:00:00'),
(3, 2, 'Software License - Year 1', 'Professional software licensing', 2.00, 1250.00, 2500.00, '2026-01-02 11:00:00'),
(4, 2, 'Support & Maintenance (3 months)', 'Technical support and system maintenance', 1.00, 1000.00, 1000.00, '2026-01-02 11:00:00'),
(5, 3, 'Data Migration Service', 'Migration of legacy data to new system', 5.00, 1500.00, 7500.00, '2026-01-03 14:30:00'),
(6, 4, 'Consultation Hours', 'Professional IT consulting service', 5.00, 500.00, 2500.00, '2026-01-04 09:00:00'),
(7, 5, 'Enterprise Software Solution', 'Complete enterprise system implementation', 1.00, 8000.00, 8000.00, '2026-01-05 13:00:00'),
(8, 5, 'Training & Documentation', 'Staff training and system documentation', 8.00, 500.00, 4000.00, '2026-01-05 13:00:00');

-- =====================================================
-- Table structure for `users`
-- =====================================================

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) UNIQUE NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullname` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `roleid` int(11) DEFAULT 1,
  `status` varchar(20) DEFAULT 'active',
  `img` varchar(255) DEFAULT '',
  `notes` text DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `email` (`email`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` VALUES
(1, 'admin', 'admin@quickpcservice.com', '$2y$10$YIjlrBc8Xr9D7eKq5XcQOO0z9KqY8Xr9D7eKq5XcQOO0z9KqY8Xr9', 'Admin User', '+1-555-9001', 1, 'active', '', 'System Administrator', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(2, 'user1', 'user1@quickpcservice.com', '$2y$10$YIjlrBc8Xr9D7eKq5XcQOO0z9KqY8Xr9D7eKq5XcQOO0z9KqY8Xr9', 'John Manager', '+1-555-9002', 2, 'active', '', 'Staff Member', '2026-01-02 09:00:00', '2026-01-05 11:30:00');

-- =====================================================
-- Table structure for `settings`
-- =====================================================

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `option_key` varchar(150) UNIQUE NOT NULL,
  `option_value` longtext DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `option_key` (`option_key`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `settings` VALUES
(1, 'CompanyName', 'Quick PC Service', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(2, 'CompanyEmail', 'contact@quickpcservice.com', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(3, 'CompanyPhone', '+1-555-0100', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(4, 'CompanyWebsite', 'https://quickpcservice.com', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(5, 'CompanyAddress', '123 Tech Plaza, New York, NY 10001', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(6, 'CompanyCity', 'New York', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(7, 'CompanyCountry', 'United States', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(8, 'CompanyTaxId', 'TAX123456789', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(9, 'CurrencySymbol', '$', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(10, 'CurrencyCode', 'USD', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(11, 'TimeZone', 'America/New_York', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(12, 'DateFormat', 'M d, Y', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(13, 'nstyle', 'blue', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(14, 'hide_footer', '0', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(15, 'rtl', '0', '2026-01-01 08:00:00', '2026-01-05 10:00:00'),
(16, 'mininav', '0', '2026-01-01 08:00:00', '2026-01-05 10:00:00');

-- =====================================================
-- Table structure for `transactions`
-- =====================================================

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `contact_id` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT 'payment',
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT 0.00,
  `payment_method` varchar(50) DEFAULT 'bank_transfer',
  `reference` varchar(100) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `transaction_date` date DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `account_id` (`account_id`),
  KEY `contact_id` (`contact_id`),
  KEY `type` (`type`),
  FOREIGN KEY (`invoice_id`) REFERENCES `invoices`(`id`),
  FOREIGN KEY (`account_id`) REFERENCES `accounts`(`id`),
  FOREIGN KEY (`contact_id`) REFERENCES `contacts`(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `transactions` VALUES
(1, 1, 1, 1, 'payment', 'Invoice INV-2026-001 Payment', 5500.00, 'bank_transfer', 'TRANS-2026-001', 'Payment received from John Smith', '2026-01-03', '2026-01-03 15:30:00', '2026-01-03 15:30:00'),
(2, NULL, 1, 4, 'expense', 'Office Supplies Purchase', 1250.50, 'check', 'CHK-2026-001', 'Monthly office supply purchase', '2026-01-04', '2026-01-04 10:00:00', '2026-01-04 10:00:00'),
(3, NULL, 2, NULL, 'income', 'Cash Sales', 2500.00, 'cash', 'CASH-2026-001', 'Daily cash sales', '2026-01-05', '2026-01-05 17:00:00', '2026-01-05 17:00:00');

-- =====================================================
-- Table structure for `expenses`
-- =====================================================

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT 0.00,
  `vendor_id` int(11) DEFAULT NULL,
  `expense_date` date DEFAULT NULL,
  `receipt` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'approved',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `account_id` (`account_id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `category` (`category`),
  FOREIGN KEY (`account_id`) REFERENCES `accounts`(`id`),
  FOREIGN KEY (`vendor_id`) REFERENCES `contacts`(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `expenses` VALUES
(1, 1, 'Office Supplies', 'Monthly office supplies from vendor', 1250.50, 4, '2026-01-04', 'receipt_001.pdf', 'Monthly restock', 'approved', '2026-01-04 10:00:00', '2026-01-04 10:00:00'),
(2, 1, 'Utilities', 'Monthly electricity bill', 450.00, NULL, '2026-01-04', 'receipt_002.pdf', 'January electricity', 'approved', '2026-01-04 11:00:00', '2026-01-04 11:00:00'),
(3, 1, 'Internet', 'Monthly internet service', 99.99, NULL, '2026-01-03', 'receipt_003.pdf', 'Monthly internet connection', 'approved', '2026-01-03 14:00:00', '2026-01-03 14:00:00');

-- =====================================================
-- Table structure for `quotes`
-- =====================================================

DROP TABLE IF EXISTS `quotes`;
CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quote_number` varchar(50) UNIQUE NOT NULL,
  `contact_id` int(11) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `valid_until` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `subtotal` decimal(15,2) DEFAULT 0.00,
  `tax` decimal(15,2) DEFAULT 0.00,
  `discount` decimal(15,2) DEFAULT 0.00,
  `total` decimal(15,2) DEFAULT 0.00,
  `status` varchar(20) DEFAULT 'draft',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `quote_number` (`quote_number`),
  KEY `contact_id` (`contact_id`),
  KEY `status` (`status`),
  FOREIGN KEY (`contact_id`) REFERENCES `contacts`(`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `quotes` VALUES
(1, 'QT-2026-001', 2, '2026-01-02', '2026-02-02', 'Valid for 30 days', 4000.00, 400.00, 200.00, 4200.00, 'sent', '2026-01-02 11:00:00', '2026-01-04 09:00:00'),
(2, 'QT-2026-002', 3, '2026-01-05', '2026-02-05', 'Valid for 30 days', 5500.00, 550.00, 0.00, 6050.00, 'draft', '2026-01-05 14:00:00', '2026-01-05 14:00:00');

-- =====================================================
-- Table structure for `roles`
-- =====================================================

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `permissions` longtext DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `role_name` (`role_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `roles` VALUES
(1, 'Administrator', 'Full system access', 'all', '2026-01-01 08:00:00', '2026-01-01 08:00:00'),
(2, 'Staff', 'Limited system access', 'view,create,edit', '2026-01-01 08:00:00', '2026-01-01 08:00:00');

-- =====================================================
-- Table structure for `countries`
-- =====================================================

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(3) NOT NULL,
  `status` varchar(20) DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `countries` VALUES
(1, 'United States', 'USA', 'active'),
(2, 'Canada', 'CAN', 'active'),
(3, 'United Kingdom', 'GBR', 'active'),
(4, 'Australia', 'AUS', 'active');

-- =====================================================
-- Table structure for `currencies`
-- =====================================================

DROP TABLE IF EXISTS `currencies`;
CREATE TABLE IF NOT EXISTS `currencies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(3) NOT NULL,
  `symbol` varchar(5) NOT NULL,
  `status` varchar(20) DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `currencies` VALUES
(1, 'US Dollar', 'USD', '$', 'active'),
(2, 'Canadian Dollar', 'CAD', 'C$', 'active'),
(3, 'British Pound', 'GBP', '£', 'active'),
(4, 'Australian Dollar', 'AUD', 'A$', 'active');

-- =====================================================
-- Table structure for `activity_logs`
-- =====================================================

DROP TABLE IF EXISTS `activity_logs`;
CREATE TABLE IF NOT EXISTS `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `module` varchar(100) DEFAULT NULL,
  `record_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(50) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `module` (`module`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `activity_logs` VALUES
(1, 1, 'created', 'invoices', 1, 'Invoice INV-2026-001 created', '127.0.0.1', '2026-01-01 10:00:00'),
(2, 1, 'updated', 'invoices', 1, 'Invoice INV-2026-001 marked as paid', '127.0.0.1', '2026-01-03 15:30:00'),
(3, 1, 'created', 'invoices', 2, 'Invoice INV-2026-002 created', '127.0.0.1', '2026-01-02 11:00:00'),
(4, 2, 'viewed', 'contacts', 1, 'Customer John Smith viewed', '192.168.1.100', '2026-01-04 14:30:00'),
(5, 1, 'created', 'invoices', 5, 'Invoice INV-2026-005 created', '127.0.0.1', '2026-01-05 13:00:00');

-- =====================================================
-- COMMIT TRANSACTION
-- =====================================================

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- =====================================================
-- Database Import Complete
-- =====================================================
-- This sample database includes:
-- - 5 Sample Customers & Vendors
-- - 5 Sample Invoices with line items
-- - 2 Sample Admin & Staff Users (passwords hashed)
-- - Company Settings pre-configured for Quick PC Service
-- - 3 Sample Transactions & Expenses
-- - 2 Sample Quotes
-- - Activity logs tracking
-- - Complete table structure for all features
-- =====================================================
-- Default Login:
-- Username: admin
-- Password: admin123
-- (Change password after first login)
-- =====================================================
