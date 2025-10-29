<?php
// setup_admin.php - Automatic Admin User Setup

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include config
require_once __DIR__ . '/config.php';

echo "<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Admin Setup - Ndawonga</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        .success { background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .info { background: #d1ecf1; color: #0c5460; padding: 15px; border-radius: 5px; margin: 10px 0; }
        .btn { background: #007bff; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-decoration: none; display: inline-block; margin: 10px 5px; }
        .btn:hover { background: #0056b3; }
        pre { background: #f8f9fa; padding: 15px; border-radius: 5px; overflow-x: auto; }
    </style>
</head>
<body>";

echo "<h1>🔧 Admin User Setup</h1>";

try {
    // Check if we have database connection
    if (!isset($pdo)) {
        throw new Exception("Database connection not available. Please check config.php");
    }

    echo "<div class='info'>✓ Database connection established</div>";

    // Read and execute the SQL setup file
    $sqlFile = __DIR__ . '/admin_user_setup.sql';
    
    if (!file_exists($sqlFile)) {
        throw new Exception("admin_user_setup.sql file not found!");
    }

    $sql = file_get_contents($sqlFile);
    
    // Split SQL into individual statements
    $statements = array_filter(array_map('trim', explode(';', $sql)));
    
    echo "<div class='info'>📄 Found " . count($statements) . " SQL statements to execute</div>";

    $successCount = 0;
    $errors = [];

    foreach ($statements as $statement) {
        if (empty($statement) || strpos($statement, '--') === 0) {
            continue; // Skip empty statements and comments
        }

        try {
            $pdo->exec($statement);
            $successCount++;
            echo "<div class='success'>✓ Executed: " . substr($statement, 0, 50) . "...</div>";
        } catch (PDOException $e) {
            $errors[] = "Error in statement: " . substr($statement, 0, 50) . "... - " . $e->getMessage();
        }
    }

    if (count($errors) > 0) {
        echo "<h3>⚠️ Some Errors Occurred:</h3>";
        foreach ($errors as $error) {
            echo "<div class='error'>$error</div>";
        }
    }

    // Check if admin users were created
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM admin_users WHERE is_active = 1");
    $result = $stmt->fetch();
    $adminCount = $result['count'];

    if ($adminCount > 0) {
        echo "<div class='success'>🎉 SUCCESS! Created $adminCount admin user(s)</div>";
        
        // Show admin users
        $stmt = $pdo->query("SELECT username, email, full_name, role FROM admin_users WHERE is_active = 1");
        $users = $stmt->fetchAll();
        
        echo "<h3>👥 Admin Users Created:</h3>";
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr><th>Username</th><th>Email</th><th>Full Name</th><th>Role</th></tr>";
        
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($user['username']) . "</td>";
            echo "<td>" . htmlspecialchars($user['email']) . "</td>";
            echo "<td>" . htmlspecialchars($user['full_name']) . "</td>";
            echo "<td>" . htmlspecialchars($user['role']) . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
        echo "<div class='info'>
            <h3>🔑 Default Login Credentials:</h3>
            <p><strong>Username:</strong> admin or superadmin</p>
            <p><strong>Email:</strong> admin@ndawonga.co.za</p>
            <p><strong>Password:</strong> Admin123</p>
        </div>";
        
        echo "<div style='text-align: center; margin: 30px 0;'>
            <a href='admin/login.php' class='btn'>🚀 Go to Admin Login</a>
            <a href='test_admin_login.php' class='btn'>🧪 Test Admin System</a>
        </div>";
        
    } else {
        echo "<div class='error'>❌ No admin users were created. Please check the errors above.</div>";
    }

} catch (Exception $e) {
    echo "<div class='error'>❌ Setup Error: " . $e->getMessage() . "</div>";
    
    echo "<div class='info'>
        <h3>🔧 Troubleshooting Steps:</h3>
        <ol>
            <li>Make sure your database is running</li>
            <li>Check database credentials in config.php</li>
            <li>Ensure the database 'ndawonga_db' exists</li>
            <li>Check file permissions</li>
        </ol>
    </div>";
}

echo "<div style='margin-top: 40px; padding: 20px; background: #f8f9fa; border-radius: 5px;'>
    <h3>📋 Next Steps:</h3>
    <ol>
        <li>If setup was successful, go to <a href='admin/login.php'>Admin Login</a></li>
        <li>Use the credentials shown above to log in</li>
        <li>Change the default password after first login</li>
        <li>Delete this setup file for security</li>
    </ol>
</div>";

echo "</body></html>";
?>