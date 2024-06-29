<?php

include 'config.php';


$conn = new mysqli($servername, $username, $password);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";

if ($conn->query($sql_create_db) === TRUE) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}


$conn->select_db($dbname);


$sql_file = 'db.sql';
$sql = file_get_contents($sql_file);


if ($conn->multi_query($sql) === TRUE) {
    echo "SQL script executed successfully";
} else {
    echo "Error executing SQL script: " . $conn->error;
}

$conn->close();
?>
