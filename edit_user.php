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
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role']; // Assuming role is selected from a dropdown or radio button

    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?");
    $stmt->execute([$username, $email, $role, $id]);

    header("Location: admin_panel.php");
    exit;
}

// Retrieve user details based on ID from URL parameter
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("User not found");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
</head>
<body>
    <h2>Edit User</h2>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($user['id']); ?>">
        <label>Username:</label><br>
        <input type="text" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required><br>
        <label>Email:</label><br>
        <input type="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required><br>
        <label>Role:</label><br>
        <select name="role">
            <option value="user" <?php if ($user['role'] == 'user') echo 'selected'; ?>>User</option>
            <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
        </select><br><br>
        <button type="submit">Update User</button>
    </form>
    <br>
    <a href="admin_panel.php">Back to Admin Panel</a>
</body>
</html>