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

// Construct the Docker run command
$container_name_safe = preg_replace('/[^a-zA-Z0-9_-]/', '_', $container['dns_name']);
$command = "docker run -d --name $container_name_safe -p " . $container['port'] . ":" . $container['port'] . " ";

// Add environment variables if present
if (!empty($container['vhost_ip'])) {
    $command .= "-e VHOST_IP=" . $container['vhost_ip'] . " ";
}
if (!empty($container['vhost_path'])) {
    $command .= "-e VHOST_PATH=" . $container['vhost_path'] . " ";
}
if (!empty($container['settings'])) {
    $command .= "-e SETTINGS=\"" . $container['settings'] . "\" ";
}

// Add the image name (for simplicity, assume it's the same as the container name)
$command .= $container_name_safe;

// Execute the command
$output = shell_exec($command);

// Debug output
echo "<pre>$command\n$output</pre>";

// Redirect back to the user home page
header("Location: user_home.php");
exit();
?>
