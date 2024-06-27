<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "docker_management";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM websites WHERE id='$id'";
    $result = $conn->query($sql);
    $website = $result->fetch_assoc();
} else {
    header("Location: user_home.php");
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #555;
        }
        input[type="text"],
        textarea {
            width: calc(100% - 20px);
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }
        textarea {
            height: 100px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 4px;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Edit Website</h1>
    <form action="update_website.php" method="post">
        <input type="hidden" name="id" value="<?php echo $website['id']; ?>">
        <label for="dns_name">DNS Name:</label>
        <input type="text" id="dns_name" name="dns_name" value="<?php echo $website['dns_name']; ?>" required><br>
        <label for="port">Port:</label>
        <input type="text" id="port" name="port" value="<?php echo $website['port']; ?>" required><br>
        <label for="db_name">DB Name:</label>
        <input type="text" id="db_name" name="db_name" value="<?php echo $website['db_name']; ?>" required><br>
        <label for="vhost_ip">VHost IP:</label>
        <input type="text" id="vhost_ip" name="vhost_ip" value="<?php echo $website['vhost_ip']; ?>"><br>
        <label for="vhost_path">VHost Path:</label>
        <input type="text" id="vhost_path" name="vhost_path" value="<?php echo $website['vhost_path']; ?>"><br>
        <label for="settings">Settings:</label>
        <textarea id="settings" name="settings"><?php echo $website['settings']; ?></textarea><br>
        <button type="submit">Update Website</button>
    </form>
</body>
</html>
