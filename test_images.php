<?php
// Test script to check if client logo images exist and are accessible

$client_logos = [
    'City of Johannesburg' => 'assets/images/City of Johannesburg.png',
    'Gauteng Province' => 'assets/images/Gauteng Province.jpeg',
    'Department of Public Works' => 'assets/images/Department of Public Works.jpeg',
    'Ekurhuleni Metro' => 'assets/images/Ekurhuleni Metro.png',
    'Transnet' => 'assets/images/Transnet.jpeg',
    'Eskom' => 'assets/images/Eskom.jpg',
    'SANRAL (South African National Roads Agency)' => 'assets/images/SANRAL (South African National Roads Agency).jpg',
    'Water Affairs' => 'assets/images/Water Affairs.png',
];

echo "<h2>Client Logo Images Test</h2>";
echo "<style>
    .test-container { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
    .logo-test { display: inline-block; margin: 10px; text-align: center; }
    .logo-test img { width: 120px; height: 80px; object-fit: contain; border: 1px solid #ccc; }
    .status-ok { color: green; }
    .status-error { color: red; }
</style>";

foreach ($client_logos as $name => $path) {
    echo "<div class='test-container'>";
    echo "<h3>$name</h3>";
    echo "<p><strong>Path:</strong> $path</p>";
    
    if (file_exists($path)) {
        echo "<p class='status-ok'>✓ File exists</p>";
        echo "<div class='logo-test'>";
        echo "<img src='$path' alt='$name' />";
        echo "<br><small>$name</small>";
        echo "</div>";
    } else {
        echo "<p class='status-error'>✗ File not found</p>";
        echo "<p>Please check if the file exists at: " . realpath('.') . "/" . $path . "</p>";
    }
    echo "</div>";
}

echo "<hr>";
echo "<h3>Database Client Data</h3>";

// Check database client data
require_once 'config.php';

try {
    $stmt = $pdo->query("SELECT name, logo FROM clients WHERE is_featured = 1 ORDER BY display_order");
    $clients = $stmt->fetchAll();
    
    if (empty($clients)) {
        echo "<p class='status-error'>No clients found in database</p>";
    } else {
        echo "<p class='status-ok'>Found " . count($clients) . " clients in database</p>";
        foreach ($clients as $client) {
            echo "<div class='test-container'>";
            echo "<h4>" . htmlspecialchars($client['name']) . "</h4>";
            echo "<p><strong>Logo path:</strong> " . htmlspecialchars($client['logo']) . "</p>";
            
            if (file_exists($client['logo'])) {
                echo "<p class='status-ok'>✓ Logo file exists</p>";
                echo "<div class='logo-test'>";
                echo "<img src='" . htmlspecialchars($client['logo']) . "' alt='" . htmlspecialchars($client['name']) . "' />";
                echo "</div>";
            } else {
                echo "<p class='status-error'>✗ Logo file not found</p>";
            }
            echo "</div>";
        }
    }
} catch (PDOException $e) {
    echo "<p class='status-error'>Database error: " . htmlspecialchars($e->getMessage()) . "</p>";
}

echo "<p><a href='index.php'>Go to Website</a></p>";
?>