<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "docker_management";

// Create connection
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Start session
session_start();

// Error reporting settings
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>