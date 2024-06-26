<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "docker_management";  

// Create connection
$conn = new mysqli($host, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read the SQL file
$sql = file_get_contents('db.sql');

// Split the SQL file into individual queries
$queries = explode(';', $sql);

// Execute each query
foreach ($queries as $query) {
    $trimmedQuery = trim($query);
    if (!empty($trimmedQuery)) {
        if ($conn->query($trimmedQuery) === FALSE) {
            echo "Error executing query: " . $conn->error . "<br>";
        }
    }
}

echo "Database setup completed successfully.";

// Close connection
$conn->close();
?>