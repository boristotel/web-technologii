<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Editor</title>
    <script src="scripts.js" defer></script>
</head>
<body>
    <h1>Data Editor</h1>
    <form id="insert_server_form" action="insert_server.php" method="POST">
        <label for="mac_address">MAC Address:</label>
        <input type="text" id="mac_address" name="mac_address"><br><br>

        <label for="physical_location">Physical Location:</label>
        <input type="text" id="physical_location" name="physical_location"><br><br>

        <label for="mgmt_type">Management Type:</label>
        <input type="text" id="mgmt_type" name="mgmt_type"><br><br>

        <label for="admin_email">Admin Email:</label>
        <input type="email" id="admin_email" name="admin_email"><br><br>

        <label for="ip">IP Address:</label>
        <input type="text" id="ip" name="ip"><br><br>

        <label for="web_url">Web URL:</label>
        <input type="text" id="web_url" name="web_url"><br><br>

        <label for="user">User:</label>
        <input type="text" id="user" name="user"><br><br>

        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass"><br><br>

        <input type="submit" value="Insert Server">
    </form>

    <form id="update_server_form" action="update_server.php" method="POST">
        <label for="id">Server ID:</label>
        <input type="text" id="id" name="id"><br><br>

        <label for="mac_address">MAC Address:</label>
        <input type="text" id="mac_address" name="mac_address"><br><br>

        <label for="physical_location">Physical Location:</label>
        <input type="text" id="physical_location" name="physical_location"><br><br>

        <label for="mgmt_type">Management Type:</label>
        <input type="text" id="mgmt_type" name="mgmt_type"><br><br>

        <label for="admin_email">Admin Email:</label>
        <input type="email" id="admin_email" name="admin_email"><br><br>

        <label for="ip">IP Address:</label>
        <input type="text" id="ip" name="ip"><br><br>

        <label for="web_url">Web URL:</label>
        <input type="text" id="web_url" name="web_url"><br><br>

        <label for="user">User:</label>
        <input type="text" id="user" name="user"><br><br>

        <label for="pass">Password:</label>
        <input type="password" id="pass" name="pass"><br><br>

        <input type="submit" value="Update Server">
    </form>

    <h2>Check Status</h2>
    <form id="check_status_form" action="check_status.php" method="POST">
        <label for="type">Type:</label>
        <select id="type" name="type">
            <option value="website">Website</option>
            <option value="container">Container</option>
        </select><br><br>

        <label for="address">Address (URL or IP):</label>
        <input type="text" id="address" name="address"><br><br>

        <input type="submit" value="Check Status">
    </form>

    <h2>Manage Docker Containers</h2>

    <h3>Start Container</h3>
    <form id="start_container_form" action="start_container.php" method="POST">
        <label for="start_container_id">Container ID:</label>
        <input type="text" id="start_container_id" name="container_id"><br><br>
        <input type="submit" value="Start Container">
    </form>

    <h3>Stop Container</h3>
    <form id="stop_container_form" action="stop_container.php" method="POST">
        <label for="stop_container_id">Container ID:</label>
        <input type="text" id="stop_container_id" name="container_id"><br><br>
        <input type="submit" value="Stop Container">
    </form>

    <h3>Restart Container</h3>
    <form id="restart_container_form" action="restart_container.php" method="POST">
        <label for="restart_container_id">Container ID:</label>
        <input type="text" id="restart_container_id" name="container_id"><br><br>
        <input type="submit" value="Restart Container">
    </form>

    <h3>Create New Container</h3>
    <form id="create_container_form" action="create_container.php" method="POST">
        <label for="container_name">Container Name:</label>
        <input type="text" id="container_name" name="name"><br><br>
        <label for="container_image">Container Image:</label>
        <input type="text" id="container_image" name="image"><br><br>
        <label for="container_ports">Container Ports (JSON format):</label>
        <textarea id="container_ports" name="ports"></textarea><br><br>
        <input type="submit" value="Create Container">
    </form>
</body>
</html>
