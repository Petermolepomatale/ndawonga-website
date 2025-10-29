<?php
// admin/logout.php - SIMPLE WORKING VERSION

// Include config first
$config_path = __DIR__ . '/../config.php';
if (file_exists($config_path)) {
    require_once $config_path;
} else {
    die('Config file not found at: ' . $config_path);
}

// Include auth
$auth_path = __DIR__ . '/../includes/auth.php';
if (file_exists($auth_path)) {
    require_once $auth_path;
} else {
    die('Auth file not found at: ' . $auth_path);
}

$auth = new Auth();
$auth->logout();

header('Location: login.php');
exit;
?>