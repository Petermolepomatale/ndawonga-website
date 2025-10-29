-- Admin User Setup for Ndawonga Admin Panel
-- Run this script to ensure admin user exists with correct credentials

-- Select the database
-- USE ndawonga_db;

-- Update admin user with correct email and ensure it exists
INSERT INTO admin_users (username, password_hash, email, full_name, role, login_attempts, is_locked) 
VALUES ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@ndawonga.co.za', 'System Administrator', 'super_admin', 0, 0)
ON DUPLICATE KEY UPDATE 
    email = 'admin@ndawonga.co.za',
    full_name = 'System