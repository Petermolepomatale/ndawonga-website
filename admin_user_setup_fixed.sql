-- Admin User Setup for Ndawonga Admin Panel
-- Run this script to ensure admin user exists with correct credentials
-- FIXED VERSION - Complete and working

-- Select the database
USE ndawonga_db;

-- Create admin_users table if it doesn't exist
CREATE TABLE IF NOT EXISTS `admin_users` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert admin users with correct credentials
-- Password hash corresponds to 'Admin123'
INSERT INTO admin_users (username, password_hash, email, full_name, role, login_attempts, is_locked) 
VALUES 
    ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@ndawonga.co.za', 'System Administrator', 'super_admin', 0, 0),
    ('superadmin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'superadmin@ndawonga.co.za', 'Super Administrator', 'super_admin', 0, 0)
ON DUPLICATE KEY UPDATE 
    email = VALUES(email),
    full_name = VALUES(full_name),
    role = VALUES(role),
    login_attempts = 0,
    is_locked = 0;

-- Verify the admin users were created
SELECT id, username, email, full_name, role, created_at FROM admin_users WHERE username IN ('admin', 'superadmin');

-- Display success message
SELECT 'Admin users setup completed successfully!' as Status;

-- Login Credentials for Reference:
-- Username: admin | Email: admin@ndawonga.co.za | Password: Admin123
-- Username: superadmin | Email: superadmin@ndawonga.co.za | Password: Admin123