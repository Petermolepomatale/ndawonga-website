<?php
// includes/auth.php

// Check if config is loaded, if not load it
if (!isset($pdo)) {
    $config_path = __DIR__ . '/../config.php';
    if (file_exists($config_path)) {
        require_once $config_path;
    } else {
        die('Configuration file not found at: ' . $config_path);
    }
}

// Session management
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

class Auth {
    private $pdo;
    
    public function __construct() {
        global $pdo;
        if (isset($pdo)) {
            $this->pdo = $pdo;
        } else {
            die('Database connection not available in Auth class.');
        }
    }
    
    public function login($identifier, $password) {
        try {
            // Check if identifier is email or username
            $isEmail = filter_var($identifier, FILTER_VALIDATE_EMAIL);
            
            if ($isEmail) {
                $stmt = $this->pdo->prepare("SELECT * FROM admin_users WHERE email = ? AND is_locked = 0");
            } else {
                $stmt = $this->pdo->prepare("SELECT * FROM admin_users WHERE username = ? AND is_locked = 0");
            }
            
            $stmt->execute([$identifier]);
            $user = $stmt->fetch();
            
            if ($user) {
                // Check password - support both demo password and hashed passwords
                $password_valid = false;
                
                if ($password === 'Admin123') {
                    // Demo password for existing users
                    $password_valid = true;
                } elseif (!empty($user['password_hash']) && password_verify($password, $user['password_hash'])) {
                    // Proper password hash verification
                    $password_valid = true;
                }
                
                if ($password_valid) {
                    // Update last login
                    $updateStmt = $this->pdo->prepare("UPDATE admin_users SET last_login = NOW(), login_attempts = 0 WHERE id = ?");
                    $updateStmt->execute([$user['id']]);
                    
                    // Set session
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_user_id'] = $user['id'];
                    $_SESSION['admin_username'] = $user['username'];
                    $_SESSION['admin_email'] = $user['email'];
                    $_SESSION['admin_role'] = $user['role'];
                    $_SESSION['admin_full_name'] = $user['full_name'];
                    
                    return true;
                } else {
                    // Increment login attempts
                    $updateStmt = $this->pdo->prepare("UPDATE admin_users SET login_attempts = login_attempts + 1 WHERE id = ?");
                    $updateStmt->execute([$user['id']]);
                    return false;
                }
            }
            
            return false;
            
        } catch (PDOException $e) {
            error_log("Login error: " . $e->getMessage());
            return false;
        }
    }
    
    public function isLoggedIn() {
        return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
    }
    
    public function logout() {
        $_SESSION = array();
        if (session_status() == PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        return true;
    }
    
    public function getUser() {
        if ($this->isLoggedIn()) {
            return [
                'id' => $_SESSION['admin_user_id'],
                'username' => $_SESSION['admin_username'],
                'email' => $_SESSION['admin_email'],
                'role' => $_SESSION['admin_role'],
                'full_name' => $_SESSION['admin_full_name']
            ];
        }
        return null;
    }
}
?>