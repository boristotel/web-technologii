<?php

use \PDO;

class Database
{
    private $connection;

    public function __construct()
    {
        $host = 'localhost';
        $db = 'test_si';
        $user = 'hwtbmAdmin';
        $pass = 'admin';

        try {
            $this->connection = new PDO("mysql:host={$host};dbname={$db}", $user, $pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function registerUser($email, $password, $name)
    {
        $queryString = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";

        try {
            $stmt = $this->connection->prepare($queryString);
            $success = $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);

            return $success;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it or return false)
            return false;
        }
    }

    public function loginUser($email, $password)
    {
        $queryString = "SELECT email,password,name FROM users WHERE email = ?";

        try {
            $stmt = $this->connection->prepare($queryString);
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            if ($user["password"] == $password) {
                return $user;
            } else {
                return false;
            }

        } catch (PDOException $e) {
            // Handle the exception (e.g., log it or return false)
            return false;
        }
    }
}