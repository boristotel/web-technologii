<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect to login page if not logged in or not admin
    exit;
}

// Include database configuration
require_once 'config.php';

// Fetch all users from the database
$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - User Management</title>
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <h3>User Management</h3>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['id']); ?></td>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td>
                    <a href="edit_user.php?id=<?php echo urlencode($user['id']); ?>">Edit</a> |
                    <a href="delete_user.php?id=<?php echo urlencode($user['id']); ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <br>
    <a href="add_user.php">Add New User</a>
    <br>
    <br>
    <a href="logout.php">Logout</a>
</body>
</html>