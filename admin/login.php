<?php
// admin/login.php - WITH BETTER ERROR HANDLING

// Display all errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!-- Starting login.php -->";

// Get the absolute path to config.php
$config_path = __DIR__ . '/../config.php';
echo "<!-- Config path: " . $config_path . " -->";

// Check if config.php exists
if (!file_exists($config_path)) {
    die('<div style="text-align: center; padding: 50px; font-family: Arial, sans-serif;">
        <h2>Configuration Error</h2>
        <p>config.php file not found!</p>
        <p><strong>Expected location:</strong> ' . $config_path . '</p>
        <p>Please make sure the config.php file exists in your root directory.</p>
    </div>');
}

// Include config.php
require_once $config_path;
echo "<!-- Config.php included successfully -->";

// Check if auth.php exists
$auth_path = __DIR__ . '/../includes/auth.php';
echo "<!-- Auth path: " . $auth_path . " -->";

if (!file_exists($auth_path)) {
    die('<div style="text-align: center; padding: 50px; font-family: Arial, sans-serif;">
        <h2>Auth File Error</h2>
        <p>auth.php file not found!</p>
        <p><strong>Expected location:</strong> ' . $auth_path . '</p>
        <p>Please make sure the includes/auth.php file exists.</p>
    </div>');
}

// Include auth.php
require_once $auth_path;
echo "<!-- Auth.php included successfully -->";

$auth = new Auth();

// Redirect if already logged in
if ($auth->isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = trim($_POST['identifier']);
    $password = $_POST['password'];
    
    if (empty($identifier) || empty($password)) {
        $error = "Please enter both username/email and password";
    } else {
        if ($auth->login($identifier, $password)) {
            header('Location: dashboard.php');
            exit;
        } else {
            $error = "Invalid username/email or password";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Ndawonga</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        
        body {
            background: linear-gradient(135deg, #1a5276, #2980b9);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            width: 100%;
            max-width: 400px;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header h1 {
            color: #1a5276;
            margin-bottom: 10px;
            font-size: 24px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #333;
        }
        
        .form-control {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        
        .form-control:focus {
            border-color: #1a5276;
            outline: none;
        }
        
        .btn {
            background: #1a5276;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            width: 100%;
            transition: background 0.3s;
        }
        
        .btn:hover {
            background: #144260;
        }
        
        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            border: 1px solid #f5c6cb;
        }
        
        .demo-credentials {
            background: #d1ecf1;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 14px;
        }
        
        .demo-credentials h4 {
            color: #0c5460;
            margin-bottom: 10px;
        }
        
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        
        .back-link a {
            color: #1a5276;
            text-decoration: none;
        }
        
        .back-link a:hover {
            text-decoration: underline;
        }
        
        .file-check {
            background: #d4edda;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 12px;
            color: #155724;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="file-check">
            ✓ Config files loaded successfully
        </div>
        
        <div class="login-header">
            <h1>Admin Login</h1>
            <p>Ndawonga Trading and Projects</p>
        </div>
        
        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label class="form-label" for="identifier">Username or Email</label>
                <input type="text" id="identifier" name="identifier" class="form-control" required
                       value="<?php echo isset($_POST['identifier']) ? htmlspecialchars($_POST['identifier']) : ''; ?>">
            </div>
            
            <div class="form-group">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            
            <button type="submit" class="btn">Login to Admin Panel</button>
        </form>
        
        <div class="demo-credentials">
            <h4>Demo Credentials:</h4>
            <p><strong>Username:</strong> superadmin</p>
            <p><strong>Email:</strong> admin@ndawonga.co.za</p>
            <p><strong>Password:</strong> Admin123</p>
        </div>
        
        <div class="back-link">
            <a href="register.php">Create New Admin Account</a>
            <a href="../index.php">← Back to Main Website</a>
        </div>
    </div>
</body>
</html>