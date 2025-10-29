<?php
// Simple Admin Setup Script
// Run this to create admin user and basic tables

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'ndawonga_db';

try {
    // Connect to MySQL
    $pdo = new PDO("mysql:host=$host", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    
    // Create database if it doesn't exist
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $pdo->exec("USE `$dbname`");
    
    echo "<h2>Setting up Ndawonga Database...</h2>";
    
    // Create admin_users table
    $sql = "CREATE TABLE IF NOT EXISTS `admin_users` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `username` varchar(50) NOT NULL UNIQUE,
        `password_hash` varchar(255) NOT NULL,
        `email` varchar(100) NOT NULL UNIQUE,
        `full_name` varchar(100) NOT NULL,
        `role` enum('super_admin','admin','editor') NOT NULL DEFAULT 'admin',
        `login_attempts` int(11) DEFAULT 0,
        `is_locked` tinyint(1) DEFAULT 0,
        `last_login` timestamp NULL DEFAULT NULL,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $pdo->exec($sql);
    echo "<p>✓ Admin users table created</p>";
    
    // Insert admin users (using ON DUPLICATE KEY UPDATE to avoid errors)
    $sql = "INSERT INTO `admin_users` (`username`, `password_hash`, `email`, `full_name`, `role`, `login_attempts`, `is_locked`) VALUES
        ('admin', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@ndawonga.co.za', 'System Administrator', 'super_admin', 0, 0),
        ('superadmin', '\$2y\$10\$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin@ndawonga.co.za', 'Super Administrator', 'super_admin', 0, 0)
        ON DUPLICATE KEY UPDATE 
        `email` = VALUES(`email`),
        `full_name` = VALUES(`full_name`),
        `role` = VALUES(`role`)";
    
    $pdo->exec($sql);
    echo "<p>✓ Admin users inserted/updated</p>";
    
    // Create clients table for the "Trusted by Leaders" section
    $sql = "CREATE TABLE IF NOT EXISTS `clients` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `name` varchar(100) NOT NULL,
        `logo` varchar(255),
        `website` varchar(255),
        `is_featured` tinyint(1) DEFAULT 0,
        `display_order` int(11) DEFAULT 0,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $pdo->exec($sql);
    echo "<p>✓ Clients table created</p>";
    
    // Insert client data
    $sql = "INSERT INTO `clients` (`name`, `logo`, `is_featured`, `display_order`) VALUES
        ('City of Johannesburg', 'assets/images/City of Johannesburg.png', 1, 1),
        ('Gauteng Province', 'assets/images/Gauteng Province.jpeg', 1, 2),
        ('Department of Public Works', 'assets/images/Department of Public Works.jpeg', 1, 3),
        ('Ekurhuleni Metro', 'assets/images/Ekurhuleni Metro.png', 1, 4),
        ('Transnet', 'assets/images/Transnet.jpeg', 1, 5),
        ('Eskom', 'assets/images/Eskom.jpg', 1, 6),
        ('SANRAL (South African National Roads Agency)', 'assets/images/SANRAL (South African National Roads Agency).jpg', 1, 7),
        ('Water Affairs', 'assets/images/Water Affairs.png', 1, 8)
        ON DUPLICATE KEY UPDATE 
        `logo` = VALUES(`logo`),
        `is_featured` = VALUES(`is_featured`),
        `display_order` = VALUES(`display_order`)";
    
    $pdo->exec($sql);
    echo "<p>✓ Client data inserted/updated</p>";
    
    // Create other essential tables
    $sql = "CREATE TABLE IF NOT EXISTS `services` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(100) NOT NULL,
        `description` text NOT NULL,
        `icon_class` varchar(50) DEFAULT 'fa-cog',
        `display_order` int(11) DEFAULT 0,
        `is_active` tinyint(1) DEFAULT 1,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $pdo->exec($sql);
    echo "<p>✓ Services table created</p>";
    
    $sql = "CREATE TABLE IF NOT EXISTS `projects` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `title` varchar(200) NOT NULL,
        `description` text,
        `location` varchar(100),
        `budget` varchar(50),
        `status` enum('planning','in_progress','completed','on_hold') DEFAULT 'planning',
        `featured_image` varchar(255),
        `start_date` date,
        `end_date` date,
        `client_name` varchar(100),
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $pdo->exec($sql);
    echo "<p>✓ Projects table created</p>";
    
    $sql = "CREATE TABLE IF NOT EXISTS `team` (
        `id` int(11) NOT NULL AUTO_INCREMENT,
        `full_name` varchar(100) NOT NULL,
        `position` varchar(100) NOT NULL,
        `bio` text,
        `photo` varchar(255),
        `email` varchar(100),
        `phone` varchar(20),
        `display_order` int(11) DEFAULT 0,
        `is_active` tinyint(1) DEFAULT 1,
        `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
        `updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    
    $pdo->exec($sql);
    echo "<p>✓ Team table created</p>";
    
    echo "<hr>";
    echo "<h3>Setup Complete!</h3>";
    echo "<p><strong>Admin Login Credentials:</strong></p>";
    echo "<ul>";
    echo "<li><strong>Username:</strong> admin or superadmin</li>";
    echo "<li><strong>Email:</strong> admin@ndawonga.co.za or superadmin@ndawonga.co.za</li>";
    echo "<li><strong>Password:</strong> Admin123</li>";
    echo "</ul>";
    
    echo "<p><a href='admin/login.php' style='background: #1a5276; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Admin Login</a></p>";
    echo "<p><a href='test_admin_login.php'>Test Admin System</a></p>";
    echo "<p><a href='index.php'>Go to Website</a></p>";
    
} catch (PDOException $e) {
    echo '<p style="color: red;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>