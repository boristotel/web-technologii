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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $dns_name = $_POST['dns_name'];
    $port = $_POST['port'];
    $db_name = $_POST['db_name'];
    $server_ip = $_POST['server_ip'];
    $container_ip = $_POST['container_ip'];

    $sql = "UPDATE containers SET dns_name='$dns_name', port='$port', db_name='$db_name', server_ip='$server_ip', container_ip='$container_ip' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: user_home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>