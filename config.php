<?php
// config.php - Place this in your ROOT directory (ndawonga-website folder)

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'ndawonga_db');
define('DB_USER', 'root'); // Default XAMPP username
define('DB_PASS', ''); // Default XAMPP password (empty)

// Website configuration
define('SITE_URL', 'http://localhost/ndawonga-website');
define('SITE_NAME', 'Ndawonga Trading and Projects Co-Operative Limited');

// Security settings
define('MAX_LOGIN_ATTEMPTS', 5);
define('SESSION_TIMEOUT', 1800);

// Create database connection
try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
} catch (PDOException $e) {
    die('<div style="text-align: center; padding: 50px; font-family: Arial, sans-serif;">
        <h2>Database Connection Error</h2>
        <p>We are experiencing technical difficulties. Please try again later.</p>
        <p><small>Error: ' . $e->getMessage() . '</small></p>
        <p><small>Make sure your database "ndawonga_db" exists and MySQL is running.</small></p>
    </div>');
}

// Session management
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Helper functions
if (!function_exists('safe_get')) {
    function safe_get($array, $key, $default = '') {
        return isset($array[$key]) ? $array[$key] : $default;
    }
}

if (!function_exists('get_project_image')) {
    function get_project_image($project, $default_image = 'assets/images/5.jpg') {
        $image_path = safe_get($project, 'featured_image', '');
        
        if (empty($image_path)) {
            return $default_image;
        }
        
        if (filter_var($image_path, FILTER_VALIDATE_URL)) {
            return $image_path;
        }
        
        if (file_exists($image_path)) {
            return $image_path;
        }
        
        $assets_path = 'assets/images/' . $image_path;
        if (file_exists($assets_path)) {
            return $assets_path;
        }
        
        return $default_image;
    }
}

?>