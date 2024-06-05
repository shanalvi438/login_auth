<?php
session_start();
require 'config.php'; 
require 'PHPMailerConfig.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $otp = rand(100000, 999999);
    $otp_expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        echo "Email already exists.";
    } else {
        
        $stmt = $pdo->prepare("INSERT INTO users (name, username, email, password, otp, otp_expiry) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$name, $username, $email, $password, $otp, $otp_expiry])) {
            
            if (sendOTPEmail($email, $otp)) {
                $_SESSION['email'] = $email;
                header('Location: otp.php');
            } else {
                echo "Failed to send OTP.";
            }
        } else {
            echo "Registration failed.";
        }
    }
}
?>
