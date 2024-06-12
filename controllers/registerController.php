<?php
require_once "../models/Database.php";

// session_start();

function register()
{
    $db = new Database();

    $isSuccessful = $db->registerUser(
        $_POST["email"],
        $_POST["password"],
        $_POST["name"]
    );

    if ($isSuccessful) {
        header("Location: ../pages/login.php");

        exit();
    } else {
        header("Location: ../pages/error.php");
    }
}

register();