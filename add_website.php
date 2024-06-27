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
    $user_id = $_SESSION['user_id'];
    $dns_name = $_POST['dns_name'];
    $port = $_POST['port'];
    $db_name = $_POST['db_name'];
    $vhost_ip = $_POST['vhost_ip'];
    $vhost_path = $_POST['vhost_path'];
    $settings = $_POST['settings'];

    $sql = "INSERT INTO websites (user_id, dns_name, port, db_name, vhost_ip, vhost_path, settings) VALUES ('$user_id', '$dns_name', '$port', '$db_name', '$vhost_ip', '$vhost_path', '$settings')";

    if ($conn->query($sql) === TRUE) {
        header("Location: user_home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
