<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); 
    exit;
}


require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role']; 

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
    <style>
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
        }
        header h1, header h2 {
            margin: 0;
        }
        header a, header button {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #007bff;
            border: none;
            cursor: pointer;
        }
        header a:hover, header button:hover {
            background-color: #0056b3;
        }
        header form {
            margin: 0;
        }
        header form button {
            padding: 5px 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        header form button:hover {
            background-color: #218838;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            margin: 20px;
        }
        h1 {
            margin-bottom: 20px;
            text-align: center;
        }
        h2 {
            margin-top: 40px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            background-color: #fff;
        }
        td a {
            text-decoration: none;
            padding: 4px 8px;
            margin-right: 4px;
            color: #007bff;
        }
        td a:hover {
            background-color: #007bff;
            color: #fff;
        }
        .container-links {
            margin-bottom: 20px;
        }
        .container-links a {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .container-links a:hover {
            background-color: #0056b3;
        }
        form {
            margin-top: 10px;
        }
        form button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #218838;
        }
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 18px;
            text-decoration: none;
            color: black;
            background-color: white;
            border: 2px solid black;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background-color: black;
            color: white;
        }
    </style>
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