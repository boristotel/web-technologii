<?php
function dockerRequest($method, $endpoint, $data = null) {
    $url = 'http://localhost:2375' . $endpoint;
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    if ($data) {
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
    }

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

function startContainer($containerId) {
    return dockerRequest('POST', "/containers/$containerId/start");
}

function stopContainer($containerId) {
    return dockerRequest('POST', "/containers/$containerId/stop");
}

function restartContainer($containerId) {
    return dockerRequest('POST', "/containers/$containerId/restart");
}

function createContainer($name, $image, $ports = []) {
    $data = [
        'Image' => $image,
        'HostConfig' => [
            'PortBindings' => $ports
        ],
        'name' => $name
    ];

    return dockerRequest('POST', '/containers/create', $data);
}
?>
