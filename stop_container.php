<?php
include 'docker_api.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $containerId = $_POST['container_id'];

    $response = stopContainer($containerId);
    echo json_encode($response);
}
?>
