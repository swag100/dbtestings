<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("../classes/db.php");
    $db = Database::getConnection();

    $dbName = "dbtestings";

    function failure($msg){
        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = $msg;
        
        header("Location: ../index.php");
        exit;
    }
    function success($msg){
        $_SESSION["FORMSTATE"] = "SUCCESS";
        $_SESSION["FORMSTATE_MSG"] = $msg;
    }

    //Make sure the database + table exists.
    $result = $db->query("CREATE DATABASE IF NOT EXISTS $dbName");
    if(!$result){ failure($db->error); }

    require_once("../classes/db.php");
    $db = Database::getConnection($dbName);
    $db->query("USE $dbName");

    $result = $db->query("CREATE TABLE IF NOT EXISTS users
        (
            user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            user_name VARCHAR(32) NOT NULL,
            user_email VARCHAR(64),
            user_password VARCHAR(255),
            user_blurb VARCHAR(64),
            user_desc VARCHAR(255),
            user_joindate TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");
    if(!$result){ failure($db->error); }

    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    if (empty($username)) { failure("Please enter a username!"); }
    if (empty($password)) { failure("Please enter a password!"); }
    if (strlen($username) < 3) { failure("Your username must be atleast 3 letters long!"); }
    if (strlen($password) < 6) { failure("Your password must be atleast 6 letters long!"); }
    
    //cannot signup if username taken
    $result = $db->query("SELECT user_id FROM users WHERE user_name = '$username'");
    if ($result->num_rows > 0) {
        failure("Username taken!");
    }
    //cannot signup if email already registered!
    $emailResult = $db->query("SELECT user_id FROM users WHERE user_email = '$email'");
    if ($emailResult->num_rows > 0 && !empty($email)) {
        failure("Email already being used! try another");
    }
    //verify email makes sense
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        failure("Email invalid format");
    }

    //okay, we CAN make an account
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $result = $db->query("INSERT INTO users (user_name, user_email, user_password) 
        VALUES ('$username', '$email', '$hash')
    ");
    if($result){
        success("Account created!!!!!! thanks");

        //LOG IN too, this is done by setting USER_ID
        $result = $db->query("SELECT user_id FROM users WHERE user_name = '$username'");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION["USER_ID"] = $row["user_id"];
        }
    }else{
        failure($db->error);
    }
}

header("Location: ../index.php");
exit;