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

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function check_status($ip, $port) {
    $connection = @fsockopen($ip, $port);
    if (is_resource($connection)) {
        fclose($connection);
        return 'Running';
    } else {
        return 'Down';
    }
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM containers WHERE user_id='$user_id'";
$result = $conn->query($sql);

$status_report = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $status = check_status($row['container_ip'], $row['port']);
        $status_report[] = [
            'name' => $row['dns_name'],
            'status' => $status
        ];
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Status Report</title>
</head>
<body>
    <h1>Status Report</h1>
    <table border="1">
        <tr>
            <th>Container Name</th>
            <th>Status</th>
        </tr>
        <?php
        foreach ($status_report as $report) {
            echo "<tr>
                <td>".$report['name']."</td>
                <td>".$report['status']."</td>
            </tr>";
        }
        ?>
    </table>
    <a href="user_home.php">Back to Home</a>
</body>
</html>
