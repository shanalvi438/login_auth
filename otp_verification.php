<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOTP = $_POST['otp'];
    $storedOTP = $_SESSION['otp'];

    if ($enteredOTP == $storedOTP) {
        
        unset($_SESSION['otp']); 
        $_SESSION['email'] = $_SESSION['email']; 
        header('Location: dashboard.php'); 
        exit();
    } else {
        echo "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
</head>
<body>
    <h2>OTP Verification</h2>
    <form action="" method="POST">
        <label for="otp">Enter OTP:</label>
        <input type="text" name="otp" required><br>
        <button type="submit">Verify OTP</button>
    </form>
</body>
</html>
