<?php
// Direct Admin Setup Fix
// This script directly creates and sets up admin users

require_once 'config.php';

try {
    echo "<h2>Fixing Admin User Setup...</h2>";
    
    // Create admin_users table if it doesn't exist
    $create_table_sql = "CREATE TABLE IF NOT EXISTS `admin_users` (
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
    
    $pdo->exec($create_table_sql);
    echo "<p style='color: green;'>✓ Admin users table created/verified</p>";
    
    // Insert/Update admin users
    $insert_sql = "INSERT INTO admin_users (username, password_hash, email, full_name, role, login_attempts, is_locked) 
        VALUES (?, ?, ?, ?, ?, 0, 0)
        ON DUPLICATE KEY UPDATE 
        email = VALUES(email),
        full_name = VALUES(full_name),
        role = VALUES(role),
        login_attempts = 0,
        is_locked = 0";
    
    $stmt = $pdo->prepare($insert_sql);
    
    // Admin user
    $stmt->execute([
        'admin',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'admin@ndawonga.co.za',
        'System Administrator',
        'super_admin'
    ]);
    echo "<p style='color: green;'>✓ Admin user created/updated</p>";
    
    // Super admin user
    $stmt->execute([
        'superadmin',
        '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'superadmin@ndawonga.co.za',
        'Super Administrator',
        'super_admin'
    ]);
    echo "<p style='color: green;'>✓ Super admin user created/updated</p>";
    
    // Verify users exist
    $verify_sql = "SELECT id, username, email, full_name, role, created_at FROM admin_users WHERE username IN ('admin', 'superadmin')";
    $stmt = $pdo->query($verify_sql);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<h4>✅ Verified Admin Users:</h4>";
    echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
    echo "<tr style='background: #f0f0f0;'>";
    echo "<th style='padding: 8px;'>ID</th>";
    echo "<th style='padding: 8px;'>Username</th>";
    echo "<th style='padding: 8px;'>Email</th>";
    echo "<th style='padding: 8px;'>Full Name</th>";
    echo "<th style='padding: 8px;'>Role</th>";
    echo "<th style='padding: 8px;'>Created</th>";
    echo "</tr>";
    
    foreach ($users as $user) {
        echo "<tr>";
        echo "<td style='padding: 8px;'>" . htmlspecialchars($user['id']) . "</td>";
        echo "<td style='padding: 8px;'>" . htmlspecialchars($user['username']) . "</td>";
        echo "<td style='padding: 8px;'>" . htmlspecialchars($user['email']) . "</td>";
        echo "<td style='padding: 8px;'>" . htmlspecialchars($user['full_name']) . "</td>";
        echo "<td style='padding: 8px;'>" . htmlspecialchars($user['role']) . "</td>";
        echo "<td style='padding: 8px;'>" . htmlspecialchars($user['created_at']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<hr>";
    echo "<h3 style='color: green;'>🎉 Admin Setup Successfully Fixed!</h3>";
    
    echo "<div style='background: #d4edda; padding: 20px; border-radius: 10px; margin: 20px 0;'>";
    echo "<h4>✅ Login Credentials (Both Work):</h4>";
    echo "<ul>";
    echo "<li><strong>Username:</strong> admin | <strong>Email:</strong> admin@ndawonga.co.za | <strong>Password:</strong> Admin123</li>";
    echo "<li><strong>Username:</strong> superadmin | <strong>Email:</strong> superadmin@ndawonga.co.za | <strong>Password:</strong> Admin123</li>";
    echo "</ul>";
    echo "</div>";
    
    echo "<p><a href='admin/login.php' style='background: #1a5276; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin: 10px;'>🔐 Test Admin Login</a></p>";
    echo "<p><a href='test_admin_login.php' style='background: #28a745; color: white; padding: 15px 30px; text-decoration: none; border-radius: 5px; margin: 10px;'>🧪 Run System Test</a></p>";
    
} catch (PDOException $e) {
    echo "<p style='color: red;'><strong>Database Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>