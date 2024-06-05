<?php
session_start();
require 'config.php';

// if (!isAdmin()) {
//     header('Location: login.php');
//     exit();
// }

$request_id = $_GET['id'];

$stmt = $pdo->prepare("UPDATE balance_requests SET approved = 1 WHERE id = ?");
if ($stmt->execute([$request_id])) {
    // Fetch user_id and amount from the request
    $stmt = $pdo->prepare("SELECT user_id, amount FROM balance_requests WHERE id = ?");
    $stmt->execute([$request_id]);
    $request = $stmt->fetch();

    // Update user balance
    $stmt = $pdo->prepare("UPDATE users SET balance = balance + ? WHERE id = ?");
    if ($stmt->execute([$request['amount'], $request['user_id']])) {
        echo "Balance request approved and updated in user account.";
    } else {
        echo "Failed to update user balance.";
    }
} else {
    echo "Failed to approve balance request.";
}
