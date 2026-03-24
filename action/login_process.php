<?php
// login.php - Login Process
session_start();
require_once 'config/database.php';

class Login {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Check login attempts
    public function checkLoginAttempts($username) {
        $stmt = $this->conn->prepare("
            SELECT login_attempts, account_locked_until 
            FROM users 
            WHERE username = ? OR email = ?
        ");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if ($user) {
            // Check if account is locked
            if ($user['account_locked_until'] && strtotime($user['account_locked_until']) > time()) {
                return [
                    'locked' => true,
                    'message' => 'Account is temporarily locked. Please try again later.'
                ];
            }
            
            return [
                'locked' => false,
                'attempts' => $user['login_attempts']
            ];
        }
        
        return ['locked' => false, 'attempts' => 0];
    }
    
    // Update failed login attempt
    public function updateFailedAttempt($username) {
        $stmt = $this->conn->prepare("
            UPDATE users 
            SET login_attempts = login_attempts + 1,
                last_login_attempt = NOW(),
                account_locked_until = CASE 
                    WHEN login_attempts + 1 >= 5 THEN DATE_ADD(NOW(), INTERVAL 30 MINUTE)
                    ELSE NULL
                END
            WHERE username = ? OR email = ?
        ");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
    }
    
    // Reset login attempts on successful login
    public function resetLoginAttempts($user_id) {
        $stmt = $this->conn->prepare("
            UPDATE users 
            SET login_attempts = 0,
                last_login_attempt = NULL,
                account_locked_until = NULL,
                last_login = NOW()
            WHERE user_id = ?
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
    }
    
    // Authenticate user
    public function authenticate($username, $password) {
        // Check login attempts first
        $attemptCheck = $this->checkLoginAttempts($username);
        
        if ($attemptCheck['locked']) {
            return [
                'success' => false,
                'message' => $attemptCheck['message']
            ];
        }
        
        // Get user by username or email
        $stmt = $this->conn->prepare("
            SELECT user_id, username, email, password, first_name, last_name, 
                   account_type, is_active, is_verified
            FROM users 
            WHERE (username = ? OR email = ?) AND is_active = TRUE
        ");
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        
        if (!$user) {
            $this->updateFailedAttempt($username);
            return [
                'success' => false,
                'message' => 'Invalid username or password'
            ];
        }
        
        // Verify password
        if (!password_verify($password, $user['password'])) {
            $this->updateFailedAttempt($username);
            return [
                'success' => false,
                'message' => 'Invalid username or password'
            ];
        }
        
        // Check if email is verified
        if (!$user['is_verified']) {
            return [
                'success' => false,
                'message' => 'Please verify your email address before logging in'
            ];
        }
        
        // Reset login attempts
        $this->resetLoginAttempts($user['user_id']);
        
        // Create session
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['fullname'] = $user['first_name'] . ' ' . $user['last_name'];
        $_SESSION['account_type'] = $user['account_type'];
        $_SESSION['login_time'] = time();
        
        // Generate session token for database
        $session_token = bin2hex(random_bytes(32));
        $_SESSION['session_token'] = $session_token;
        
        // Save session to database
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        $stmt = $this->conn->prepare("
            INSERT INTO user_sessions (user_id, session_token, ip_address, user_agent)
            VALUES (?, ?, ?, ?)
        ");
        $stmt->bind_param("isss", $user['user_id'], $session_token, $ip_address, $user_agent);
        $stmt->execute();
        
        // Log successful login
        $audit_stmt = $this->conn->prepare("
            INSERT INTO audit_logs (user_id, action_type, action_description, ip_address, user_agent, status)
            VALUES (?, 'LOGIN', ?, ?, ?, 'SUCCESS')
        ");
        $action_desc = "User logged in successfully";
        $audit_stmt->bind_param("isss", $user['user_id'], $action_desc, $ip_address, $user_agent);
        $audit_stmt->execute();
        
        return [
            'success' => true,
            'user' => [
                'user_id' => $user['user_id'],
                'username' => $user['username'],
                'fullname' => $user['first_name'] . ' ' . $user['last_name'],
                'account_type' => $user['account_type']
            ],
            'redirect' => $user['account_type'] === 'admin' ? 'admin/dashboard.php' : 'dashboard.php'
        ];
    }
    
    // Logout function
    public function logout($user_id, $session_token) {
        // Invalidate session in database
        $stmt = $this->conn->prepare("
            UPDATE user_sessions 
            SET logout_time = NOW(), is_active = FALSE 
            WHERE user_id = ? AND session_token = ? AND is_active = TRUE
        ");
        $stmt->bind_param("is", $user_id, $session_token);
        $stmt->execute();
        
        // Log logout
        $ip_address = $_SERVER['REMOTE_ADDR'];
        $audit_stmt = $this->conn->prepare("
            INSERT INTO audit_logs (user_id, action_type, action_description, ip_address)
            VALUES (?, 'LOGOUT', ?, ?)
        ");
        $action_desc = "User logged out";
        $audit_stmt->bind_param("iss", $user_id, $action_desc, $ip_address);
        $audit_stmt->execute();
        
        // Clear session
        session_destroy();
        
        return true;
    }
}

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    require_once 'config/database.php';
    $database = new Database();
    $db = $database->getConnection();
    
    $login = new Login($db);
    
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($username) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Username and password are required']);
        exit;
    }
    
    $result = $login->authenticate($username, $password);
    echo json_encode($result);
}
?>