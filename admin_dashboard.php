<?php
session_start();
require 'config.php';

// if (!isAdmin()) {
//     header('Location: login.php');
//     exit();
// }

// Fetch balance requests
$stmt = $pdo->query("SELECT * FROM balance_requests");
$requests = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>
<form action="logout.php" method="post">
    <button type="submit">Logout</button>
  </form></a>
    <h1>Admin Dashboard</h1>
    <h2>Balance Requests</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Amount</th>
            <th>Approved</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($requests as $request): ?>
            <tr>
                <td><?php echo $request['id']; ?></td>
                <td><?php echo $request['user_id']; ?></td>
                <td><?php echo $request['amount']; ?></td>
                <td><?php echo $request['approved'] ? 'Yes' : 'No'; ?></td>
                <td>
                    <?php if (!$request['approved']): ?>
                        <a href="approve_balance.php?id=<?php echo $request['id']; ?>">Approve</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
