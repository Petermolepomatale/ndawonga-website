<?php
// check_admin_users.php - Quick check for admin users

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/config.php';

echo "<!DOCTYPE html>
<html>
<head>
    <title>Admin Users Check</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .success { background: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .error { background: #f8d7da; color: #721c24; padding: 10px; border-radius: 5px; margin: 10px 0; }
        .info { background: #d1ecf1; color: #0c5460; padding: 10px; border-radius: 5px; margin: 10px 0; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { background: #007bff; color: white; padding: 8px 16px; text-decoration: none; border-radius: 4px; display: inline-block; margin: 5px; }
    </style>
</head>
<body>";

echo "<h1>🔍 Admin Users Check</h1>";

try {
    if (!isset($pdo)) {
        throw new Exception("Database connection not available");
    }

    echo "<div class='success'>✓ Database connected successfully</div>";

    // Check if admin_users table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'admin_users'");
    $tableExists = $stmt->rowCount() > 0;

    if (!$tableExists) {
        echo "<div class='error'>❌ admin_users table does not exist</div>";
        echo "<div class='info'>
            <p>The admin_users table needs to be created. Please run:</p>
            <p><a href='setup_admin.php' class='btn'>🔧 Run Admin Setup</a></p>
        </div>";
    } else {
        echo "<div class='success'>✓ admin_users table exists</div>";

        // Check for admin users
        $stmt = $pdo->query("SELECT * FROM admin_users ORDER BY created_at DESC");
        $users = $stmt->fetchAll();

        if (count($users) == 0) {
            echo "<div class='error'>❌ No admin users found</div>";
            echo "<div class='info'>
                <p>No admin users exist in the database. Please run the setup:</p>
                <p><a href='setup_admin.php' class='btn'>🔧 Run Admin Setup</a></p>
            </div>";
        } else {
            echo "<div class='success'>✓ Found " . count($users) . " admin user(s)</div>";
            
            echo "<h3>👥 Admin Users:</h3>";
            echo "<table>";
            echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>Full Name</th><th>Role</th><th>Active</th><th>Created</th></tr>";
            
            foreach ($users as $user) {
                $activeStatus = $user['is_active'] ? '✅ Yes' : '❌ No';
                echo "<tr>";
                echo "<td>" . $user['id'] . "</td>";
                echo "<td>" . htmlspecialchars($user['username']) . "</td>";
                echo "<td>" . htmlspecialchars($user['email']) . "</td>";
                echo "<td>" . htmlspecialchars($user['full_name']) . "</td>";
                echo "<td>" . htmlspecialchars($user['role']) . "</td>";
                echo "<td>" . $activeStatus . "</td>";
                echo "<td>" . $user['created_at'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            echo "<div class='info'>
                <h3>🔑 Test Login:</h3>
                <p><strong>Default Password:</strong> Admin123</p>
                <p><a href='admin/login.php' class='btn'>🚀 Go to Admin Login</a></p>
            </div>";
        }
    }

} catch (Exception $e) {
    echo "<div class='error'>❌ Error: " . $e->getMessage() . "</div>";
    
    echo "<div class='info'>
        <h3>🔧 Troubleshooting:</h3>
        <ul>
            <li>Check if your database server is running</li>
            <li>Verify database credentials in config.php</li>
            <li>Make sure the database 'ndawonga_db' exists</li>
        </ul>
        <p><a href='setup_admin.php' class='btn'>🔧 Try Admin Setup</a></p>
    </div>";
}

echo "<div style='margin-top: 30px; text-align: center;'>
    <a href='index.php' class='btn'>🏠 Back to Website</a>
    <a href='setup_admin.php' class='btn'>🔧 Run Setup</a>
</div>";

echo "</body></html>";
?>