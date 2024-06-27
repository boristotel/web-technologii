<?php
// Database connection parameters
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "docker_management"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it does not exist
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";

if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Select the database
$conn->select_db($dbname);

// SQL script file
$sql_file = 'db.sql';

// Read SQL file
$sql = file_get_contents($sql_file);

// Execute multiple queries (assuming db.sql contains multiple queries separated by ;)
if ($conn->multi_query($sql) === TRUE) {
    echo "SQL script executed successfully";
} else {
    echo "Error executing SQL script: " . $conn->error;
}

// Close connection
$conn->close();
?>
