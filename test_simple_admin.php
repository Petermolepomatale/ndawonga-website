<?php
// Simple test for admin login system
echo "<h2>Admin System Test - FIXED VERSION</h2>";

// Test config loading
try {
    require_once 'config.php';
    echo "<p style='color: green;'>✓ Config loaded successfully</p>";
    
    // Test database connection
    if (isset($pdo)) {
        echo "<p style='color: green;'>✓ Database connection available</p>";
        
        // Test admin user exists
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM admin_users WHERE username IN ('admin', 'superadmin')");
        $result = $stmt->fetch();
        
        if ($result['count'] > 0) {
            echo "<p style='color: green;'>✓ Admin user(s) found in database</p>";
            
            // Get admin details
            $stmt = $pdo->query("SELECT username, email, role FROM admin_users WHERE username IN ('admin', 'superadmin') LIMIT 1");
            $admin = $stmt->fetch();
            
            echo "<p><strong>Admin Details:</strong></p>";
            echo "<ul>";
            echo "<li>Username: " . htmlspecialchars($admin['username']) . "</li>";
            echo "<li>Email: " . htmlspecialchars($admin['email']) . "</li>";
            echo "<li>Role: " . htmlspecialchars($admin['role']) . "</li>";
            echo "</ul>";
            
        } else {
            echo "<p style='color: red;'>✗ No admin users found. Please run admin_user_setup.sql</p>";
        }
        
    } else {
        echo "<p style='color: red;'>✗ Database connection not available</p>";
    }
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

// Test auth class
try {
    require_once 'includes/auth.php';
    $auth = new Auth();
    echo "<p style='color: green;'>✓ Auth class loaded successfully</p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>✗ Auth class error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

echo "<hr>";
echo "<h3>Test Credentials:</h3>";
echo "<ul>";
echo "<li><strong>Username:</strong> admin or superadmin</li>";
echo "<li><strong>Email:</strong> admin@ndawonga.co.za</li>";
echo "<li><strong>Password:</strong> Admin123</li>";
echo "</ul>";

echo "<p><a href='admin/login.php' style='background: #1a5276; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Go to Admin Login</a></p>";

echo "<hr>";
echo "<h3>Setup Instructions:</h3>";
echo "<ol>";
echo "<li>Ensure your database 'ndawonga_db' exists</li>";
echo "<li>Run database_setup.sql to create tables</li>";
echo "<li>Run admin_user_setup.sql to create admin users</li>";
echo "<li>Access admin/login.php to test login</li>";
echo "</ol>";
?>