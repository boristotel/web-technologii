<?php
function checkWebsiteStatus($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpcode >= 200 && $httpcode < 300) {
        return true;
    } else {
        return false;
    }
}

function ping($host, $timeout = 1) {
    $output = [];
    $status = -1;
    $result = exec("ping -n 1 -w {$timeout} {$host}", $output, $status);
    return $status === 0;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $address = $_POST['address'];

    if ($type == 'website') {
        if (checkWebsiteStatus($address)) {
            echo "The website is online.";
        } else {
            echo "The website is offline.";
        }
    } elseif ($type == 'container') {
        if (ping($address)) {
            echo "The container is online.";
        } else {
            echo "The container is offline.";
        }
    }
}
?>
