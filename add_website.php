// add_website.php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "docker_management";

// Създаване на връзка
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка на връзката
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dns_name = $_POST['dns_name'];
    $port = $_POST['port'];
    $db_name = $_POST['db_name'];
    $server_ip = $_POST['server_ip'];
    $container_ip = $_POST['container_ip'];

    $sql = "INSERT INTO websites (dns_name, port, db_name, server_ip, container_ip) VALUES ('$dns_name', '$port', '$db_name', '$server_ip', '$container_ip')";

    if ($conn->query($sql) === TRUE) {
        echo "Website added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
