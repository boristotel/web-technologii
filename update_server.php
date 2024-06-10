<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $mac_address = $_POST['mac_address'];
    $physical_location = $_POST['physical_location'];
    $mgmt_type = $_POST['mgmt_type'];
    $admin_email = $_POST['admin_email'];
    $ip = $_POST['ip'];
    $web_url = $_POST['web_url'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "UPDATE servers SET mac_address='$mac_address', physical_location='$physical_location', mgmt_type='$mgmt_type', admin_email='$admin_email', ip='$ip', web_url='$web_url', user='$user', pass='$pass' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>
