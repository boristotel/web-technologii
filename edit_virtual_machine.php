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
    $sql = "SELECT * FROM virtual_machines WHERE id='$id'";
    $result = $conn->query($sql);
    $vm = $result->fetch_assoc();
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
    <title>Edit Virtual Machine</title>
</head>
<body>
    <h1>Edit Virtual Machine</h1>
    <form action="update_virtual_machine.php" method="post">
        <input type="hidden" name="id" value="<?php echo $vm['id']; ?>">
        <label for="ip">IP Address:</label>
        <input type="text" id="ip" name="ip" value="<?php echo $vm['ip']; ?>" required><br>
        <label for="data">Data:</label>
        <textarea id="data" name="data"><?php echo $vm['data']; ?></textarea><br>
        <button type="submit">Update Virtual Machine</button>
    </form>
</body>
</html>
