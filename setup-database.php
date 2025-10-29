<?php
// Database Setup Script for Ndawonga Website
// Run once: http://localhost/ndawonga-website/setup-database.php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'ndawonga_db';

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");
    $pdo->exec("USE `$dbname`");

    $sql = file_get_contents(__DIR__ . '/schema.sql');
    $pdo->exec($sql);

    echo '<p>Database and tables created. Seed data inserted.</p>';
    echo '<p><a href="index.php">Go to Website</a> | <a href="admin/login.php">Go to Admin Panel</a></p>';
} catch (PDOException $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}
?>

