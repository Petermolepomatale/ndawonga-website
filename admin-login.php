<?php
session_start();

// Security headers
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");

// Database connection
require_once 'config.php';
require_once 'includes/database.php';

$database = new Database();
$db = $database->getConnection();

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // CSRF protection
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = 'Security validation failed';
    } else {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        
        if (empty($username) || empty($password)) {
            $error = 'Please enter both username and password';
        } else {
            // Rate limiting - simple implementation
            sleep(1);
            
            try {
                $stmt = $db->prepare("SELECT id, username, password_hash, is_locked, login_attempts FROM admin_users WHERE username = ?");
                $stmt->execute([$username]);
                $user = $stmt->fetch();
                
                if ($user) {
                    if ($user['is_locked']) {
                        $error = 'Account is locked. Contact administrator.';
                    } elseif ($username === 'admin' && $password === 'Admin123') {
                        // Successful login
                        $_SESSION['admin_logged_in'] = true;
                        $_SESSION['admin_user_id'] = $user['id'];
                        $_SESSION['admin_username'] = $user['username'];
                        $_SESSION['login_time'] = time();
                        
                        // Reset login attempts
                        $update_stmt = $db->prepare("UPDATE admin_users SET last_login = NOW(), login_attempts = 0 WHERE id = ?");
                        $update_stmt->execute([$user['id']]);
                        
                        // Log successful login
                        $log_stmt = $db->prepare("INSERT INTO security_logs (log_type, user_id, ip_address, description, severity) VALUES (?, ?, ?, ?, ?)");
                        $log_stmt->execute(['login_attempt', $user['id'], $_SERVER['REMOTE_ADDR'], 'Successful admin login', 'low']);
                        
                        header("Location: admin-dashboard.php");
                        exit;
                    } else {
                        // Failed login
                        $error = 'Invalid username or password';
                        
                        // Increment login attempts
                        $new_attempts = $user['login_attempts'] + 1;
                        $update_stmt = $db->prepare("UPDATE admin_users SET login_attempts = ? WHERE id = ?");
                        $update_stmt->execute([$new_attempts, $user['id']]);
                        
                        // Lock account after 5 failed attempts
                        if ($new_attempts >= 5) {
                            $lock_stmt = $db->prepare("UPDATE admin_users SET is_locked = 1 WHERE id = ?");
                            $lock_stmt->execute([$user['id']]);
                            $error = 'Account locked due to too many failed attempts';
                        }
                        
                        // Log failed login
                        $log_stmt = $db->prepare("INSERT INTO security_logs (log_type, user_id, ip_address, description, severity) VALUES (?, ?, ?, ?, ?)");
                        $log_stmt->execute(['failed_login', $user['id'], $_SERVER['REMOTE_ADDR'], 'Failed admin login attempt', 'medium']);
                    }
                } else {
                    $error = 'Invalid username or password';
                }
            } catch (PDOException $e) {
                error_log('Login error: ' . $e->getMessage());
                $error = 'System error. Please try again later.';
            }
        }
    }
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Ndawonga Trading & Projects</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
        }
        
        .login-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            padding: 3rem;
            max-width: 450px;
            width: 100%;
            margin: 2rem;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .login-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #d4af37 0%, #f7ef8a 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 2rem;
            color: #1a365d;
            font-weight: 700;
        }
        
        .login-title {
            color: #1a365d;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .login-subtitle {
            color: #666;
            font-size: 0.9rem;
        }
        
        .security-notice {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #1a365d;
            box-shadow: 0 0 0 3px rgba(26, 54, 93, 0.1);
        }
        
        .btn-login {
            background: linear-gradient(135deg, #1a365d 0%, #2d3748 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(26, 54, 93, 0.3);
            color: white;
        }
        
        .alert {
            border-radius: 10px;
            border: none;
        }
        
        .credentials-info {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-top: 1.5rem;
            text-align: center;
            font-size: 0.9rem;
            color: #666;
        }
        
        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e2e8f0;
            border-right: none;
            border-radius: 10px 0 0 10px;
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 10px 10px 0;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: #1a365d;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <div class="login-logo">N</div>
            <h2 class="login-title">Admin Login</h2>
            <p class="login-subtitle">Ndawonga Trading & Projects</p>
        </div>
        
        <div class="security-notice">
            <i class="fas fa-shield-alt me-2"></i>
            <strong>Security Notice:</strong> This area is restricted to authorized personnel only. All access attempts are logged and monitored.
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <?php echo htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" id="loginForm">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            
            <div class="mb-3">
                <label class="form-label fw-bold">Username</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="username" class="form-control" placeholder="Enter your username" required>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="form-label fw-bold">Password</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>
            </div>
            
            <button type="submit" class="btn btn-login">
                <i class="fas fa-sign-in-alt me-2"></i>
                Secure Login
            </button>
        </form>
        
        <div class="credentials-info">
            <i class="fas fa-info-circle me-2"></i>
            <strong>Default Credentials:</strong><br>
            Username: <code>admin</code><br>
            Password: <code>Admin123</code>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Session timeout warning
        let inactivityTime = function() {
            let time;
            window.onload = resetTimer;
            document.onmousemove = resetTimer;
            document.onkeypress = resetTimer;
            
            function logout() {
                alert('Session expired due to inactivity');
                window.location.href = 'index.php';
            }
            
            function resetTimer() {
                clearTimeout(time);
                time = setTimeout(logout, 1800000); // 30 minutes
            }
        };
        
        inactivityTime();
        
        // Form validation
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const username = this.querySelector('input[name="username"]').value.trim();
            const password = this.querySelector('input[name="password"]').value;
            
            if (!username || !password) {
                e.preventDefault();
                alert('Please enter both username and password');
            }
        });
    </script>
</body>
</html>