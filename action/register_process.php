<?php
// register.php - Registration Process
session_start();
require_once 'config/db.php';

class Registration {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }
    
    // Validate registration input
    public function validateInput($data) {
        $errors = [];
        
        // Validate first name
        if (empty($data['first_name'])) {
            $errors[] = "First name is required";
        }
        
        // Validate last name
        if (empty($data['last_name'])) {
            $errors[] = "Last name is required";
        }
        
        // Validate email
        if (empty($data['email'])) {
            $errors[] = "Email is required";
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format";
        }
        
        // Validate username
        if (empty($data['username'])) {
            $errors[] = "Username is required";
        } elseif (strlen($data['username']) < 3) {
            $errors[] = "Username must be at least 3 characters";
        }
        
        // Validate password
        if (empty($data['password'])) {
            $errors[] = "Password is required";
        } elseif (strlen($data['password']) < 6) {
            $errors[] = "Password must be at least 6 characters";
        }
        
        // Validate confirm password
        if ($data['password'] !== $data['confirm_password']) {
            $errors[] = "Passwords do not match";
        }
        
        // Validate contact number (optional)
        if (!empty($data['contact']) && !preg_match('/^(09|\+639)\d{9}$/', $data['contact'])) {
            $errors[] = "Invalid Philippine mobile number";
        }
        
        return $errors;
    }
    
    // Check if username exists
    public function isUsernameTaken($username) {
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    
    // Check if email exists
    public function isEmailTaken($email) {
        $stmt = $this->conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    
    // Check registration attempts (prevent spam)
    public function checkRegistrationAttempts($email, $ip) {
        $stmt = $this->conn->prepare("
            SELECT COUNT(*) as attempts 
            FROM registration_attempts 
            WHERE (email = ? OR ip_address = ?) 
            AND attempt_time > DATE_SUB(NOW(), INTERVAL 1 HOUR)
        ");
        $stmt->bind_param("ss", $email, $ip);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        return $row['attempts'] < 5; // Max 5 attempts per hour
    }
    
    // Generate verification token
    private function generateVerificationToken() {
        return bin2hex(random_bytes(32));
    }
    
    // Register new user
    public function registerUser($data) {
        // Start transaction
        $this->conn->begin_transaction();
        
        try {
            $ip_address = $_SERVER['REMOTE_ADDR'];
            
            // Check registration attempts
            if (!$this->checkRegistrationAttempts($data['email'], $ip_address)) {
                throw new Exception("Too many registration attempts. Please try again later.");
            }
            
            // Hash password
            $hashed_password = password_hash($data['password'], PASSWORD_DEFAULT);
            
            // Generate verification token
            $verification_token = $this->generateVerificationToken();
            $token_expiry = date('Y-m-d H:i:s', strtotime('+24 hours'));
            
            // Insert user
            $stmt = $this->conn->prepare("
                INSERT INTO users (
                    username, password, email, first_name, last_name, 
                    contact_number, organization, account_type, 
                    verification_token, verification_token_expiry
                ) VALUES (?, ?, ?, ?, ?, ?, ?, 'user', ?, ?)
            ");
            
            $stmt->bind_param(
                "sssssssss",
                $data['username'],
                $hashed_password,
                $data['email'],
                $data['first_name'],
                $data['last_name'],
                $data['contact'],
                $data['organization'],
                $verification_token,
                $token_expiry
            );
            
            if (!$stmt->execute()) {
                throw new Exception("Failed to register user");
            }
            
            $user_id = $stmt->insert_id;
            
            // Log registration attempt
            $log_stmt = $this->conn->prepare("
                INSERT INTO registration_attempts (email, ip_address, is_successful) 
                VALUES (?, ?, TRUE)
            ");
            $log_stmt->bind_param("ss", $data['email'], $ip_address);
            $log_stmt->execute();
            
            // Log to audit
            $audit_stmt = $this->conn->prepare("
                INSERT INTO audit_logs (user_id, action_type, action_description, ip_address) 
                VALUES (?, 'REGISTER', ?, ?)
            ");
            $audit_desc = "New user registration: " . $data['username'];
            $audit_stmt->bind_param("iss", $user_id, $audit_desc, $ip_address);
            $audit_stmt->execute();
            
            // Commit transaction
            $this->conn->commit();
            
            // Send verification email (implement your email function)
            // $this->sendVerificationEmail($data['email'], $verification_token);
            
            return [
                'success' => true,
                'user_id' => $user_id,
                'message' => 'Registration successful! Please verify your email.'
            ];
            
        } catch (Exception $e) {
            $this->conn->rollback();
            
            // Log failed attempt
            $log_stmt = $this->conn->prepare("
                INSERT INTO registration_attempts (email, ip_address, is_successful) 
                VALUES (?, ?, FALSE)
            ");
            $log_stmt->bind_param("ss", $data['email'], $ip_address);
            $log_stmt->execute();
            
            return [
                'success' => false,
                'message' => $e->getMessage()
            ];
        }
    }
}

// Handle AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    
    require_once 'config/db.php';
    $database = new Database();
    $db = $database->getConnection();
    
    $registration = new Registration($db);
    
    // Validate input
    $errors = $registration->validateInput($_POST);
    
    if (!empty($errors)) {
        echo json_encode(['success' => false, 'errors' => $errors]);
        exit;
    }
    
    // Check if username exists
    if ($registration->isUsernameTaken($_POST['username'])) {
        echo json_encode(['success' => false, 'errors' => ['Username already exists']]);
        exit;
    }
    
    // Check if email exists
    if ($registration->isEmailTaken($_POST['email'])) {
        echo json_encode(['success' => false, 'errors' => ['Email already registered']]);
        exit;
    }
    
    // Register user
    $result = $registration->registerUser($_POST);
    echo json_encode($result);
}
?>