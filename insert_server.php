<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mac_address = $_POST['mac_address'];
    $physical_location = $_POST['physical_location'];
    $mgmt_type = $_POST['mgmt_type'];
    $admin_email = $_POST['admin_email'];
    $ip = $_POST['ip'];
    $web_url = $_POST['web_url'];
    $user = $_POST['user'];
    $pass = $_POST['pass'];

    $sql = "INSERT INTO servers (mac_address, physical_location, mgmt_type, admin_email, ip, web_url, user, pass)
            VALUES ('$mac_address', '$physical_location', '$mgmt_type', '$admin_email', '$ip', '$web_url', '$user', '$pass')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
