<?php
include 'docker_api.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $image = $_POST['image'];
    $ports = json_decode($_POST['ports'], true);

    $response = createContainer($name, $image, $ports);
    echo json_encode($response);
}
?>
