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

// Fetch containers
$containers_sql = "SELECT * FROM containers WHERE user_id='$user_id'";
$containers_result = $conn->query($containers_sql);

// Fetch websites
$websites_sql = "SELECT * FROM websites WHERE user_id='$user_id'";
$websites_result = $conn->query($websites_sql);

// Fetch virtual machines
$vms_sql = "SELECT * FROM virtual_machines WHERE user_id='$user_id'";
$vms_result = $conn->query($vms_sql);

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
        if ($containers_result->num_rows > 0) {
            while($row = $containers_result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['dns_name']."</td>
                    <td>".$row['port']."</td>
                    <td>".$row['db_name']."</td>
                    <td>".$row['server_ip']."</td>
                    <td>".$row['container_ip']."</td>
                    <td>
                        <a href='edit_container.php?id=".$row['id']."'>Edit</a> |
                        <a href='delete_container.php?id=".$row['id']."'>Delete</a> |
                        <a href='generate_dockerfile.php?id=".$row['id']."'>Generate Dockerfile</a> |
                        <a href='run_container.php?id=".$row['id']."'>Run</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No containers found</td></tr>";
        }
        ?>
    </table>
    <a href="add_container.html">Add New Container</a>

    <h2>Your Websites</h2>
    <table border="1">
        <tr>
            <th>DNS Name</th>
            <th>Port</th>
            <th>DB Name</th>
            <th>VHost IP</th>
            <th>VHost Path</th>
            <th>Settings</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($websites_result->num_rows > 0) {
            while($row = $websites_result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['dns_name']."</td>
                    <td>".$row['port']."</td>
                    <td>".$row['db_name']."</td>
                    <td>".$row['vhost_ip']."</td>
                    <td>".$row['vhost_path']."</td>
                    <td>".$row['settings']."</td>
                    <td>
                        <a href='edit_website.php?id=".$row['id']."'>Edit</a> |
                        <a href='delete_website.php?id=".$row['id']."'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No websites found</td></tr>";
        }
        ?>
    </table>
    <a href="add_website.html">Add New Website</a>

    <h2>Your Virtual Machines</h2>
    <table border="1">
        <tr>
            <th>IP Address</th>
            <th>Data</th>
            <th>Actions</th>
        </tr>
        <?php
        if ($vms_result->num_rows > 0) {
            while($row = $vms_result->fetch_assoc()) {
                echo "<tr>
                    <td>".$row['ip']."</td>
                    <td>".$row['data']."</td>
                    <td>
                        <a href='edit_virtual_machine.php?id=".$row['id']."'>Edit</a> |
                        <a href='delete_virtual_machine.php?id=".$row['id']."'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No virtual machines found</td></tr>";
        }
        ?>
    </table>
    <a href="add_virtual_machine.html">Add New Virtual Machine</a>

    <h2>Install Docker</h2>
    <form method="POST" action="install_docker_windows.php">
        <button type="submit">Install Docker for Windows</button>
    </form>
    <form method="POST" action="install_docker_linux.php">
        <button type="submit">Install Docker for Linux</button>
    </form>
</body>
</html>
