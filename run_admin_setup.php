<?php
// Run Admin Setup SQL Script
// This script executes the admin_user_setup_fixed.sql file

require_once 'config.php';

try {
    echo "<h2>Running Admin User Setup...</h2>";
    
    // Read the SQL file
    $sql_file = 'admin_user_setup_fixed.sql';
    
    if (!file_exists($sql_file)) {
        throw new Exception("SQL file not found: $sql_file");
    }
    
    $sql_content = file_get_contents($sql_file);
    
    // Remove comments and split into individual statements
    $sql_statements = array_filter(
        array_map('trim', 
            preg_split('/;[\s]*\n/', $sql_content)
        ), 
        function($stmt) {
            return !empty($stmt) && !preg_match('/^--/', $stmt) && $stmt !== 'USE ndawonga_db';
        }
    );
    
    echo "<p>Found " . count($sql_statements) . " SQL statements to execute.</p>";
    
    // Execute each statement
    foreach ($sql_statements as $index => $statement) {
        if (trim($statement)) {
            try {
                $stmt = $pdo->prepare($statement);
                $stmt->execute();
                
                // If it's a SELECT statement, show results
                if (stripos(trim($statement), 'SELECT') === 0) {
                    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    if (!empty($results)) {
                        echo "<h4>Query Results:</h4>";
                        echo "<table border='1' style='border-collapse: collapse; margin: 10px 0;'>";
                        
                        // Headers
                        if (!empty($results[0])) {
                            echo "<tr style='background: #f0f0f0;'>";
                            foreach (array_keys($results[0]) as $header) {
                                echo "<th style='padding: 8px;'>" . htmlspecialchars($header) . "</th>";
                            }
                            echo "</tr>";
                        }
                        
                        // Data
                        foreach ($results as $row) {
                            echo "<tr>";
                            foreach ($row as $value) {
                                echo "<td style='padding: 8px;'>" . htmlspecialchars($value) . "</td>";
                            }
                            echo "</tr>";
                        }
                        echo "</table>";
                    }
                }
                
                echo "<p style='color: green;'>✓ Statement " . ($index + 1) . " executed successfully</p>";
                
            } catch (PDOException $e) {
                echo "<p style='color: red;'>✗ Error in statement " . ($index + 1) . ": " . htmlspecialchars($e->getMessage()) . "</p>";
                echo "<p><strong>Statement:</strong> " . htmlspecialchars(substr($statement, 0, 100)) . "...</p>";
            }
        }
    }
    
    echo "<hr>";
    echo "<h3 style='color: green;'>✅ Admin Setup Complete!</h3>";
    
    // Test login credentials
    echo "<h4>Test Login Credentials:</h4>";
    echo "<ul>";
    echo "<li><strong>Username:</strong> admin | <strong>Email:</strong> admin@ndawonga.co.za | <strong>Password:</strong> Admin123</li>";
    echo "<li><strong>Username:</strong> superadmin | <strong>Email:</strong> superadmin@ndawonga.co.za | <strong>Password:</strong> Admin123</li>";
    echo "</ul>";
    
    echo "<p><a href='admin/login.php' style='background: #1a5276; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Test Admin Login</a></p>";
    echo "<p><a href='test_admin_login.php'>Run Admin System Test</a></p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>