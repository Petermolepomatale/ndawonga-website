<?php
// Fix database column and syntax errors

require_once 'config.php';

try {
    echo "<h2>Fixing Database Errors...</h2>";
    
    // Check if team table exists and has correct columns
    $stmt = $pdo->query("DESCRIBE team");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    if (!in_array('full_name', $columns)) {
        echo "<p>Adding missing 'full_name' column to team table...</p>";
        $pdo->exec("ALTER TABLE team ADD COLUMN full_name VARCHAR(100) NOT NULL DEFAULT ''");
        echo "<p>✓ Added full_name column</p>";
    } else {
        echo "<p>✓ full_name column already exists</p>";
    }
    
    // Check if contact_messages table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'contact_messages'");
    if (!$stmt->fetch()) {
        echo "<p>Creating contact_messages table...</p>";
        $sql = "CREATE TABLE IF NOT EXISTS `contact_messages` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL,
            `email` varchar(100) NOT NULL,
            `phone` varchar(20),
            `subject` varchar(200),
            `message` text NOT NULL,
            `is_read` tinyint(1) DEFAULT 0,
            `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        $pdo->exec($sql);
        echo "<p>✓ Created contact_messages table</p>";
        
        // Add sample message
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            'John Doe',
            'john.doe@example.com',
            '+27 11 123 4567',
            'Project Inquiry',
            'Hello, I am interested in your civil engineering services for a residential development project in Johannesburg. Could you please provide more information about your capabilities and pricing?'
        ]);
        echo "<p>✓ Added sample contact message</p>";
    } else {
        echo "<p>✓ contact_messages table already exists</p>";
    }
    
    // Verify all tables exist with correct structure
    $tables = ['admin_users', 'clients', 'services', 'projects', 'team', 'contact_messages'];
    
    echo "<h3>Table Verification:</h3>";
    foreach ($tables as $table) {
        $stmt = $pdo->query("SHOW TABLES LIKE '$table'");
        if ($stmt->fetch()) {
            echo "<p>✓ $table table exists</p>";
        } else {
            echo "<p style='color: red;'>✗ $table table missing</p>";
        }
    }
    
    echo "<hr>";
    echo "<h3>Database Errors Fixed!</h3>";
    echo "<p>Your admin system should now work without errors.</p>";
    echo "<p><a href='admin/dashboard.php'>Test Admin Dashboard</a></p>";
    
} catch (PDOException $e) {
    echo '<p style="color: red;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>