<?php
session_start();

// Check if user is logged in and is admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php"); // Redirect to login page if not logged in or not admin
    exit;
}

// Include database configuration
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: admin_panel.php");
exit;
?>