<?php
require_once "../models/Database.php";
require_once "../models/User.php";

session_start();

function login()
{
    // $userData = json_decode(file_get_contents("php://input"), true);

    //input data
    //echo $_POST["email"];

    //echo $_POST["pass"];

    //data in db

    $db = new Database();

    $dbUser = $db->loginUser($_POST["email"], $_POST["pass"]);

    if ($dbUser) {
        $user = new User($dbUser["name"], $dbUser["email"]);

        $_SESSION["user"] = $user;
        $_SESSION["userEmail"] = $user;

        header("Location: ../pages/home.php");

        exit();
    } else {
        header("Location: ../pages/error.php");
    }
}

login();