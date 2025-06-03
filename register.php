<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("includes/db.php");
    $db = Database::getConnection();

    $dbName = "dbtestings";

    //Make sure the database + table exists.
    $result = $db->query("CREATE DATABASE IF NOT EXISTS $dbName");
    if(!$result){
        echo "WHAT";
        echo "Error creating table: " . $db->error;
        exit;
    }

    require_once("includes/db.php");
    $db = Database::getConnection($dbName);
    $db->query("USE $dbName");

    $result = $db->query("CREATE TABLE IF NOT EXISTS users
        (
            user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_name VARCHAR(32) NOT NULL,
            user_email VARCHAR(64),
            user_password VARCHAR(255),
            user_joindate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");
    if(!$result){
        echo "Error creating table: " . $db->error;
        exit;
    }

    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    if (empty($username) || empty($password)) {
        $problem = empty($username) ? "username" : "password";

        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = "Please enter a $problem!";
        
        header("Location: index.php");
        exit;
    }

    if (strlen($username) < 3) {
        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = "Your username must be atleast 3 letters long!";
        
        header("Location: index.php");
        exit;
    }
    if (strlen($password) < 6) {
        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = "Your password must be atleast 6 letters long!";
        
        header("Location: index.php");
        exit;
    }
    
    //cannot signup if username taken
    $result = $db->query("SELECT user_id FROM users WHERE user_name = '$username'");
    if ($result->num_rows > 0) {
        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = "Username taken!";
        header("Location: index.php");
        exit;   
    }
    //cannot signup if email already registered!
    $result = $db->query("SELECT user_id FROM users WHERE user_email = '$email'");
    if ($result->num_rows > 0 && !empty($email)) {
        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = "Email already being used! try another";
        header("Location: index.php");
        exit;   
    }

    //okay, we CAN make an account
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $result = $db->query("INSERT INTO users (user_name, user_email, user_password) 
        VALUES ('$username', '$email', '$hash')
    ");
    if($result){
        $_SESSION["FORMSTATE"] = "SUCCESS";
        $_SESSION["FORMSTATE_MSG"] = "Account created!!!!!! thanks";
    }else{
        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = $db->error;
    }

    header("Location: index.php");
    exit;

}