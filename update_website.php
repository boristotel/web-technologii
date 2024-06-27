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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $dns_name = $_POST['dns_name'];
    $port = $_POST['port'];
    $db_name = $_POST['db_name'];
    $vhost_ip = $_POST['vhost_ip'];
    $vhost_path = $_POST['vhost_path'];
    $settings = $_POST['settings'];

    $sql = "UPDATE websites SET dns_name='$dns_name', port='$port', db_name='$db_name', vhost_ip='$vhost_ip', vhost_path='$vhost_path', settings='$settings' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: user_home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
