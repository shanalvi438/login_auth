<?php
session_start();

require 'config.php'; 

$email = $_POST['email'];
$password = $_POST['password'];


$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
$user = $stmt->fetch();


if ($user && password_verify($password, $user['password'])) {
    
    $_SESSION['email'] = $email;
    header('Location: register.php'); 
    exit();
} else {
    echo "Invalid email or password.";
}
?>
