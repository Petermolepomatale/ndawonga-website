<?php
// admin/dashboard.php - SIMPLE WORKING VERSION

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

// Redirect to login if not authenticated
if (!$auth->isLoggedIn()) {
    header('Location: login.php');
    exit;
}

$user = $auth->getUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Ndawonga</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background: #f5f5f5;
        }
        
        .admin-header {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .admin-content {
            padding: 30px;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .welcome-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .btn {
            background: #1a5276;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
        }
        
        .btn-logout {
            background: #dc3545;
        }
        
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <h2>Ndawonga Admin Panel</h2>
        <div>
            <span>Welcome, <?php echo htmlspecialchars($user['full_name']); ?></span>
            <a href="logout.php" class="btn btn-logout" style="margin-left: 15px;">Logout</a>
        </div>
    </header>
    
    <div class="admin-content">
        <div class="welcome-section">
            <h1>Dashboard</h1>
            <p>Welcome to your admin dashboard, <?php echo htmlspecialchars($user['full_name']); ?>!</p>
            <p>Your role: <strong><?php echo htmlspecialchars($user['role']); ?></strong></p>
            
            <div style="margin-top: 20px;">
                <a href="projects.php" class="btn">Manage Projects</a>
                <a href="team.php" class="btn">Manage Team</a>
                <a href="messages.php" class="btn">View Messages</a>
            </div>
        </div>
        
        <div style="background: white; padding: 20px; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
            <h3>Quick Stats</h3>
            <p>Your admin panel is working correctly!</p>
            <p>You can now start adding your projects, team members, and managing your website content.</p>
        </div>
    </div>
</body>
</html>