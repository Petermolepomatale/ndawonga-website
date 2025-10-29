<?php
// Create contact_messages table

require_once 'config.php';

try {
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
    echo "<p>✓ Contact messages table created successfully!</p>";
    
    // Insert a sample message for testing
    $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([
        'John Doe',
        'john.doe@example.com',
        '+27 11 123 4567',
        'Project Inquiry',
        'Hello, I am interested in your civil engineering services for a residential development project in Johannesburg. Could you please provide more information about your capabilities and pricing?'
    ]);
    
    echo "<p>✓ Sample contact message added for testing!</p>";
    echo "<p><a href='admin/messages.php'>View Messages in Admin Panel</a></p>";
    
} catch (PDOException $e) {
    echo '<p style="color: red;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>