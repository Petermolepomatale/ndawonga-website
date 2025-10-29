<?php
// Test script for admin login functionality
// Access this file directly to test the login system

require_once 'config.php';
require_once 'includes/auth.php';

echo "<h2>Admin Login System Test</h2>";

// Test database connection
try {
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM admin_users WHERE username = 'admin'");
    $result = $stmt->fetch();
    
    if ($result['count'] > 0) {
        echo "<p style='color: green;'>✓ Admin user exists in database</p>";
        
        // Get admin user details
        $stmt = $pdo->query("SELECT username, email, role, is_locked FROM admin_users WHERE username = 'admin'");
        $admin = $stmt->fetch();
        
        echo "<p><strong>Admin Details:</strong></p>";
        echo "<ul>";
        echo "<li>Username: " . htmlspecialchars($admin['username']) . "</li>";
        echo "<li>Email: " . htmlspecialchars($admin['email']) . "</li>";
        echo "<li>Role: " . htmlspecialchars($admin['role']) . "</li>";
        echo "<li>Locked: " . ($admin['is_locked'] ? 'Yes' : 'No') . "</li>";
        echo "</ul>";
        
    } else {
        echo "<p style='color: red;'>✗ Admin user not found in database</p>";
        echo "<p>Please run the admin_user_setup.sql script first.</p>";
    }
    
} catch (PDOException $e) {
    echo "<p style='color: red;'>✗ Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Test authentication class
try {
    $auth = new Auth();
    echo "<p style='color: green;'>✓ Auth class instantiated successfully</p>";
    
    // Test login with correct credentials
    if ($auth->login('admin', 'Admin123')) {
        echo "<p style='color: green;'>✓ Login test successful with username</p>";
        $auth->logout();
    } else {
        echo "<p style='color: red;'>✗ Login test failed with username</p>";
    }
    
    // Test login with email
    if ($auth->login('admin@ndawonga.co.za', 'Admin123')) {
        echo "<p style='color: green;'>✓ Login test successful with email</p>";
        $auth->logout();
    } else {
        echo "<p style='color: red;'>✗ Login test failed with email</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Auth class error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

echo "<hr>";
echo "<p><strong>Test Credentials:</strong></p>";
echo "<ul>";
echo "<li>Username: admin or superadmin</li>";
echo "<li>Email: admin@ndawonga.co.za</li>";
echo "<li>Password: Admin123</li>";
echo "</ul>";

echo "<p><a href='admin/login.php'>Go to Admin Login</a></p>";
?>