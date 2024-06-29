<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}

include 'config.php';

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $ip = $_POST['ip'];
    $data = $_POST['data'];

    $sql = "UPDATE virtual_machines SET ip='$ip', data='$data' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: user_home.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
