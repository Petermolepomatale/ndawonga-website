<?php
// Test file to verify config.php fix
echo "<h2>Config.php Fix Verification</h2>";

// Test 1: Check if config.php exists in root
$config_path = __DIR__ . '/config.php';
echo "<h3>Test 1: Config File Location</h3>";
if (file_exists($config_path)) {
    echo "<p style='color: green;'>✓ config.php found at: " . $config_path . "</p>";
    
    // Test 2: Try to include config.php
    try {
        require_once $config_path;
        echo "<p style='color: green;'>✓ config.php loaded successfully</p>";
        
        // Test 3: Check database connection
        if (isset($pdo)) {
            echo "<p style='color: green;'>✓ Database connection available</p>";
            
            // Test 4: Test database connection
            try {
                $stmt = $pdo->query("SELECT 1");
                echo "<p style='color: green;'>✓ Database connection working</p>";
                
                // Test 5: Check if admin_users table exists
                try {
                    $stmt = $pdo->query("SELECT COUNT(*) FROM admin_users");
                    echo "<p style='color: green;'>✓ admin_users table exists</p>";
                    
                    // Test 6: Check for admin users
                    $stmt = $pdo->query("SELECT COUNT(*) as count FROM admin_users WHERE username IN ('admin', 'superadmin')");
                    $result = $stmt->fetch();
                    
                    if ($result['count'] > 0) {
                        echo "<p style='color: green;'>✓ Admin user(s) found: " . $result['count'] . "</p>";
                        
                        // Get admin details
                        $stmt = $pdo->query("SELECT username, email, role FROM admin_users WHERE username IN ('admin', 'superadmin') LIMIT 1");
                        $admin = $stmt->fetch();
                        
                        echo "<div style='background: #e7f3ff; padding: 15px; border-radius: 5px; margin: 10px 0;'>";
                        echo "<h4>Admin User Details:</h4>";
                        echo "<p><strong>Username:</strong> " . htmlspecialchars($admin['username']) . "</p>";
                        echo "<p><strong>Email:</strong> " . htmlspecialchars($admin['email']) . "</p>";
                        echo "<p><strong>Role:</strong> " . htmlspecialchars($admin['role']) . "</p>";
                        echo "</div>";
                        
                    } else {
                        echo "<p style='color: orange;'>⚠ No admin users found. Run admin_user_setup.sql</p>";
                    }
                    
                } catch (PDOException $e) {
                    echo "<p style='color: red;'>✗ admin_users table not found. Run database_setup.sql</p>";
                }
                
            } catch (PDOException $e) {
                echo "<p style='color: red;'>✗ Database connection failed: " . $e->getMessage() . "</p>";
            }
            
        } else {
            echo "<p style='color: red;'>✗ Database connection not available</p>";
        }
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ Error loading config.php: " . $e->getMessage() . "</p>";
    }
    
} else {
    echo "<p style='color: red;'>✗ config.php not found at: " . $config_path . "</p>";
}

// Test 7: Check auth.php
echo "<h3>Test 2: Auth File Location</h3>";
$auth_path = __DIR__ . '/includes/auth.php';
if (file_exists($auth_path)) {
    echo "<p style='color: green;'>✓ auth.php found at: " . $auth_path . "</p>";
    
    try {
        require_once $auth_path;
        echo "<p style='color: green;'>✓ auth.php loaded successfully</p>";
        
        // Test Auth class
        $auth = new Auth();
        echo "<p style='color: green;'>✓ Auth class instantiated successfully</p>";
        
    } catch (Exception $e) {
        echo "<p style='color: red;'>✗ Error with auth.php: " . $e->getMessage() . "</p>";
    }
    
} else {
    echo "<p style='color: red;'>✗ auth.php not found at: " . $auth_path . "</p>";
}

// Test 8: Check admin files
echo "<h3>Test 3: Admin Files</h3>";
$admin_files = ['admin/login.php', 'admin/dashboard.php', 'admin/logout.php'];
foreach ($admin_files as $file) {
    if (file_exists($file)) {
        echo "<p style='color: green;'>✓ " . $file . " exists</p>";
    } else {
        echo "<p style='color: red;'>✗ " . $file . " missing</p>";
    }
}

echo "<hr>";
echo "<h3>File Structure Check</h3>";
echo "<div style='background: #f8f9fa; padding: 15px; border-radius: 5px; font-family: monospace;'>";
echo "Expected structure:<br>";
echo "ndawonga-website/<br>";
echo "├── config.php ← " . (file_exists('config.php') ? '✓' : '✗') . "<br>";
echo "├── includes/<br>";
echo "│   └── auth.php ← " . (file_exists('includes/auth.php') ? '✓' : '✗') . "<br>";
echo "└── admin/<br>";
echo "    ├── login.php ← " . (file_exists('admin/login.php') ? '✓' : '✗') . "<br>";
echo "    ├── dashboard.php ← " . (file_exists('admin/dashboard.php') ? '✓' : '✗') . "<br>";
echo "    └── logout.php ← " . (file_exists('admin/logout.php') ? '✓' : '✗') . "<br>";
echo "</div>";

echo "<hr>";
echo "<h3>Login Credentials</h3>";
echo "<div style='background: #d1ecf1; padding: 15px; border-radius: 5px;'>";
echo "<p><strong>Username:</strong> admin or superadmin</p>";
echo "<p><strong>Email:</strong> admin@ndawonga.co.za</p>";
echo "<p><strong>Password:</strong> Admin123</p>";
echo "</div>";

echo "<hr>";
echo "<p><a href='admin/login.php' style='background: #1a5276; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Admin Login</a></p>";

echo "<hr>";
echo "<h3>Setup Instructions (if needed)</h3>";
echo "<ol>";
echo "<li>Make sure XAMPP is running (Apache + MySQL)</li>";
echo "<li>Create database 'ndawonga_db' in phpMyAdmin</li>";
echo "<li>Run database_setup.sql to create tables</li>";
echo "<li>Run admin_user_setup.sql to create admin users</li>";
echo "<li>Access admin/login.php to test</li>";
echo "</ol>";
?>