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

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM containers WHERE id='$id'";
    $result = $conn->query($sql);
    $container = $result->fetch_assoc();
} else {
    header("Location: user_home.php");
    exit();
}

$conn->close();

$dockerfile = "FROM alpine:latest\n";
$dockerfile .= "RUN apk add --no-cache bash\n";
$dockerfile .= "EXPOSE " . $container['port'] . "\n";
if ($container['vhost_ip']) {
    $dockerfile .= "ENV VHOST_IP=" . $container['vhost_ip'] . "\n";
}
if ($container['vhost_path']) {
    $dockerfile .= "ENV VHOST_PATH=" . $container['vhost_path'] . "\n";
}
if ($container['settings']) {
    $dockerfile .= "ENV SETTINGS=\"" . $container['settings'] . "\"\n";
}
if ($container['vhost_ip']) {
    $dockerfile .= "ENTRYPOINT [\"sh\", \"-c\", \"echo \\\"Hello from \$VHOST_IP with arguments \$@\\\"; while true; do sleep 3600; done\"]\n";
}





$container_name_safe = preg_replace('/[^a-zA-Z0-9_-]/', '_', $container['dns_name']);
$directory = 'dockerfiles/' . $container_name_safe;
if (!is_dir($directory)) {
    mkdir($directory, 0777, true);
}

$filepath = $directory . '/Dockerfile';
file_put_contents($filepath, $dockerfile);

header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="Dockerfile"');
echo $dockerfile;
exit();
?>
