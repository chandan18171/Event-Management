<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type']; // 'user' or 'organizer'
    
    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            $_SESSION['error'] = "Email already exists!";
            header("Location: signup.php");
            exit();
        }

        // Insert new user
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $user_type]);
        
        $_SESSION['success'] = "Registration successful! Your account has been created. Please login to continue.";
        $_SESSION['animation'] = "success";
        header("Location: signin.php");
        exit();
    } catch(PDOException $e) {
        $_SESSION['error'] = "Registration failed: " . $e->getMessage();
        $_SESSION['animation'] = "error";
        header("Location: signup.php");
        exit();
    }
}
?> 