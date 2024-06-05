<?php
session_start();
require 'config.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $otp = $_POST['otp'];
    $email = $_SESSION['email'];

    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? AND otp = ? AND otp_expiry > NOW()");
    $stmt->execute([$email, $otp]);

    if ($stmt->rowCount() > 0) {
        
        $stmt = $pdo->prepare("UPDATE users SET is_verified = 1, otp = NULL, otp_expiry = NULL WHERE email = ?");
        if ($stmt->execute([$email])) {
            header('Location: theme/index.php');
        } else {
            echo "Failed to verify email.";
        }
    } else {
        echo "Invalid OTP or OTP expired.";
    }
}
?>
