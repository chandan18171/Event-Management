<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['user_type'] = $user['user_type'];
            $_SESSION['animation'] = "login_success";
            
            // Redirect based on user type
            if ($user['user_type'] == 'organizer') {
                header("Location: organizer_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {
            $_SESSION['error'] = "Invalid email or password! Please try again.";
            $_SESSION['animation'] = "error";
            header("Location: signin.php");
            exit();
        }
    } catch(PDOException $e) {
        $_SESSION['error'] = "Login failed: " . $e->getMessage();
        $_SESSION['animation'] = "error";
        header("Location: signin.php");
        exit();
    }
}
?> 