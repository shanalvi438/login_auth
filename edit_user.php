session_start();
require 'config.php';

if (!isAdmin()) {
    header('Location: login.php');
    exit();
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $is_admin = isset($_POST['is_admin']) ? 1 : 0;

    $stmt = $pdo->prepare("UPDATE users SET name = ?, username = ?, email = ?, is_admin = ? WHERE id = ?");
    if ($stmt->execute([$name, $username, $email, $is_admin, $id])) {
        header('Location: admin_dashboard.php');
    } else {
        echo "Failed to update user.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>
    <h1>Edit User</h1>
    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $user['name']; ?>" required><br>
        <label for="username">Username:</label>
        <input type="text" name="username" value="<?php echo $user['username']; ?>" required><br>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>" required><br>
        <label for="is_admin">Is Admin:</label>
        <input type="checkbox" name="is_admin" value="1" <?php if ($user['is_admin']) echo 'checked'; ?>><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
