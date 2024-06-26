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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM containers WHERE id='$id'";
    $result = $conn->query($sql);
    $container = $result->fetch_assoc();
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
    <title>Edit Container</title>
</head>
<body>
    <h1>Edit Container</h1>
    <form action="update_container.php" method="post">
        <input type="hidden" name="id" value="<?php echo $container['id']; ?>">
        <label for="dns_name">DNS Name:</label>
        <input type="text" id="dns_name" name="dns_name" value="<?php echo $container['dns_name']; ?>" required><br>
        <label for="port">Port:</label>
        <input type="text" id="port" name="port" value="<?php echo $container['port']; ?>" required><br>
        <label for="db_name">DB Name:</label>
        <input type="text" id="db_name" name="db_name" value="<?php echo $container['db_name']; ?>" required><br>
        <label for="server_ip">Server IP:</label>
        <input type="text" id="server_ip" name="server_ip" value="<?php echo $container['server_ip']; ?>" required><br>
        <label for="container_ip">Container IP:</label>
        <input type="text" id="container_ip" name="container_ip" value="<?php echo $container['container_ip']; ?>" required><br>
        <button type="submit">Update Container</button>
    </form>
</body>
</html>
