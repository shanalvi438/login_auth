<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $amount = $_POST['amount'];

    $stmt = $pdo->prepare("INSERT INTO balance_requests (user_id, amount) VALUES (?, ?)");
    if ($stmt->execute([$user_id, $amount])) {
        echo "Balance request sent for approval.";
    } else {
        echo "Failed to send balance request.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Request Balance</title>
</head>
<body>
    <h1>Request Balance Update</h1>
    <form method="POST">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" step="0.01" required><br>
        <input type="submit" value="Request">
    </form>
</body>
</html>
