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

$dockerfile = "FROM php:7.4-apache\n";
$dockerfile .= "COPY . /var/www/html/\n";
$dockerfile .= "EXPOSE " . $container['port'] . "\n";
if ($container['vhost_ip']) {
    $dockerfile .= "ENV VHOST_IP=" . $container['vhost_ip'] . "\n";
}
if ($container['vhost_path']) {
    $dockerfile .= "ENV VHOST_PATH=" . $container['vhost_path'] . "\n";
}
if ($container['settings']) {
    $dockerfile .= "ENV SETTINGS=\"" . $container['settings'] . "\"\n";
}

// Create a directory for the container
$directory = 'dockerfiles/' . $container['id'];
if (!is_dir($directory)) {
    mkdir($directory, 0777, true);
}

// Save Dockerfile to a file
$filepath = $directory . '/Dockerfile';
file_put_contents($filepath, $dockerfile);

header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="Dockerfile"');
echo $dockerfile;
exit();
?>
