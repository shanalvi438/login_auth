</php
session_start();
require 'config.php';

if (!isAdmin()) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
if ($stmt->execute([$id])) {
    header('Location: admin_dashboard.php');
} else {
    echo "Failed to delete user.";
}
