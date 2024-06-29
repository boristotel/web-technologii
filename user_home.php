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

$user_id = $_SESSION['user_id'];


$containers_sql = "SELECT * FROM containers WHERE user_id='$user_id'";
$containers_result = $conn->query($containers_sql);

$websites_sql = "SELECT * FROM websites WHERE user_id='$user_id'";
$websites_result = $conn->query($websites_sql);

$vms_sql = "SELECT * FROM virtual_machines WHERE user_id='$user_id'";
$vms_result = $conn->query($vms_sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Home</title>
    <style>
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
        }
        header h1, header h2 {
            margin: 0;
        }
        header a, header button {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #007bff;
            border: none;
            cursor: pointer;
        }
        header a:hover, header button:hover {
            background-color: #0056b3;
        }
        header form {
            margin: 0;
        }
        header form button {
            padding: 5px 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        header form button:hover {
            background-color: #218838;
        }
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            margin: 20px;
        }
        h1 {
            margin-bottom: 20px;
            text-align: center;
        }
        h2 {
            margin-top: 40px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            background-color: #fff;
        }
        td a {
            text-decoration: none;
            padding: 4px 8px;
            margin-right: 4px;
            color: #007bff;
        }
        td a:hover {
            background-color: #007bff;
            color: #fff;
        }
        .container-links {
            margin-bottom: 20px;
        }
        .container-links a {
            display: inline-block;
            margin-right: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        .container-links a:hover {
            background-color: #0056b3;
        }
        form {
            margin-top: 10px;
        }
        form button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        form button:hover {
            background-color: #218838;
        }
        .logout-btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 18px;
            text-decoration: none;
            color: black;
            background-color: white;
            border: 2px solid black;
            border-radius: 5px;
        }

        .logout-btn:hover {
            background-color: black;
            color: white;
        }
    </style>
    <script>
        function confirmLogout() {
            var confirmLogout = confirm("Are you sure you want to log out from your profile?");
            if (confirmLogout) {
                window.location.href = "logout.php"; 
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $_SESSION['username']; ?></h1>
        <div>
            <button onclick="confirmLogout()" class="logout-btn">Logout</button>
            <h2>Install Docker</h2>
            <form method="POST" action="install_docker_windows.php">
                <button type="submit">Install Docker for Windows</button>
            </form>
            <form method="POST" action="install_docker_linux.php">
                <button type="submit">Install Docker for Linux</button>
            </form>
        </div>
    </header>

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
                        <a href='generate_dockerfile.php?id=".$row['id']."'>Generate Dockerfile</a>
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
                $port = strlen($row['port']) > 5 ? substr($row['port'], 0, 5) . '...' : $row['port']; // Limit port to 5 characters
                echo "<tr>
                    <td>".$row['dns_name']."</td>
                    <td>".$port."</td>
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

</body>
</html>
