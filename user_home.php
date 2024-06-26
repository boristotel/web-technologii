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

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM containers WHERE user_id='$user_id'";
$result = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Home</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
    <a href="logout.php">Logout</a>
    <h2>Your Containers</h2>
    <table border="1">
        <tr>
            <th>DNS Name</th>
            <th>Port</th>
            <th>DB Name</th>
            <th>Server IP</th>
            <th>Container IP</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['dns_name']."</td>
                    <td>".$row['port']."</td>
                    <td>".$row['db_name']."</td>
                    <td>".$row['server_ip']."</td>
                    <td>".$row['container_ip']."</td>
                    <td>
                        <a href='edit_container.php?id=".$row['id']."'>Edit</a> |
                        <a href='delete_container.php?id=".$row['id']."'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No containers found</td></tr>";
        }
        ?>
    </table>
    <a href="add_container.html">Add New Container</a>
</body>
</html>
