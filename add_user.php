<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect to login page if not logged in or not admin
    exit;
}

// Include database configuration
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role']; // Assuming role is selected from a dropdown or radio button

    $stmt = $pdo->prepare("INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)");
    $stmt->execute([$username, $password, $email, $role]);

    header("Location: admin_panel.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
</head>
<body>
    <h2>Add New User</h2>
    <form method="POST" action="">
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br>
        <label>Role:</label><br>
        <select name="role">
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>
        <button type="submit">Add User</button>
    </form>
    <br>
    <a href="admin_panel.php">Back to Admin Panel</a>
</body>
</html>