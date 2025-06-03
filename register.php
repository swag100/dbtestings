<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("includes/db.php");
    $db = Database::getConnection();

    //Make sure the table exists.
    $result = $db->query("CREATE DATABASE IF NOT EXISTS my_new_database;");
    if(!$result){
        echo "WHAT";
        echo "Error creating table: " . $db->error;
        exit;
    }

    $result = $db->query("CREATE TABLE users
        (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(32) NOT NULL,
            email VARCHAR(64),
            joindate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        );
    ");
    if(!$result){
        echo "i failed early";
        echo "Error creating table: " . $db->error;
        exit;
    }

    $username = $_POST["username"];
    $email = $_POST["email"];

    if (empty($username)) {
        $_SESSION["FORM_STATE"] = "FAILED";
        $_SESSION["FORM_STATE_MSG"] = "Please enter a username!";
        header("Location: index.php");
        exit;
    }

    //check for beautiful  -- cannot signup if username taken
    $result = $db->query("SELECT id FROM users WHERE username = '$username'");
    if ($result->num_rows > 0) {
        $_SESSION["FORM_STATE"] = "FAILED";
        $_SESSION["FORM_STATE_MSG"] = "Username taken!";
        header("Location: index.php");
        exit;   
    }
    //cannot signup if email already registered!
    $result = $db->query("SELECT id FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $_SESSION["FORM_STATE"] = "FAILED";
        $_SESSION["FORM_STATE_MSG"] = "Email already being used! try another";
        header("Location: index.php");
        exit;   
    }

    //okay, we CAN make an account
    $result = $db->query("INSERT INTO users (username, email) VALUES ('$username', '$email')");
    if(!$result){
        exit;
    }

    $_SESSION["FORM_STATE"] = "SUCCESS";
    $_SESSION["FORM_STATE_MSG"] = "Account created!!!!!! thanks";
    header("Location: index.php");
    exit;

}