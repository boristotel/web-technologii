// login.php
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

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
        } else {
            echo "Invalid password";
        }
    } else {
        echo "No user found with this username";
    }
}

$conn->close();
?>
