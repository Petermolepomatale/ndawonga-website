<?php
// Fix clients table - remove duplicates and incorrect entries

require_once 'config.php';

try {
    // Clear all existing clients
    $pdo->exec("DELETE FROM clients");
    echo "<p>✓ Cleared existing client data</p>";
    
    // Insert correct client data
    $sql = "INSERT INTO `clients` (`name`, `logo`, `is_featured`, `display_order`) VALUES
        ('City of Johannesburg', 'assets/images/City of Johannesburg.png', 1, 1),
        ('Gauteng Province', 'assets/images/Gauteng Province.jpeg', 1, 2),
        ('Department of Public Works', 'assets/images/Department of Public Works.jpeg', 1, 3),
        ('Ekurhuleni Metro', 'assets/images/Ekurhuleni Metro.png', 1, 4),
        ('Transnet', 'assets/images/Transnet.jpeg', 1, 5),
        ('Eskom', 'assets/images/Eskom.jpg', 1, 6),
        ('SANRAL (South African National Roads Agency)', 'assets/images/SANRAL (South African National Roads Agency).jpg', 1, 7),
        ('Water Affairs', 'assets/images/Water Affairs.png', 1, 8)";
    
    $pdo->exec($sql);
    echo "<p>✓ Inserted correct client data</p>";
    
    // Verify the data
    $stmt = $pdo->query("SELECT name, logo FROM clients WHERE is_featured = 1 ORDER BY display_order");
    $clients = $stmt->fetchAll();
    
    echo "<h3>Verified Client Data:</h3>";
    foreach ($clients as $client) {
        $exists = file_exists($client['logo']) ? '✓' : '✗';
        echo "<p>$exists " . htmlspecialchars($client['name']) . " - " . htmlspecialchars($client['logo']) . "</p>";
    }
    
    echo "<hr>";
    echo "<p><strong>Client logos are now properly configured!</strong></p>";
    echo "<p><a href='index.php'>View Website</a> | <a href='test_images.php'>Test Images</a></p>";
    
} catch (PDOException $e) {
    echo '<p style="color: red;">Error: ' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>