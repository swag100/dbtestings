<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("db.php");
    $db = Database::getConnection();

    $username = $_POST["username"];
    $email = $_POST["email"];

    if (empty($username)) {
        $_SESSION["FORM_STATE"] = "FAILED";
        $_SESSION["FORM_STATE_MSG"] = "Please enter a username!";
        header("Location: index.php");
        exit;
    }

    //check for beautiful  -- cannot signup if username taken
    $result = mysqli_query($db, "SELECT id FROM users WHERE username = '$username'");
    if ($result->num_rows > 0) {
        $_SESSION["FORM_STATE"] = "FAILED";
        $_SESSION["FORM_STATE_MSG"] = "Username taken!";
        header("Location: index.php");
        exit;   
    }
    //cannot signup if email already registered!
    $result = mysqli_query($db, "SELECT id FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $_SESSION["FORM_STATE"] = "FAILED";
        $_SESSION["FORM_STATE_MSG"] = "Email already being used! try another";
        header("Location: index.php");
        exit;   
    }

    //okay, we CAN make an account
    $result = mysqli_query($db, "INSERT INTO users (username, email) VALUES ('$username', '$email')");
    if(!$result){
        echo mysqli_error($db);
        exit;
    }

    $_SESSION["FORM_STATE"] = "SUCCESS";
    $_SESSION["FORM_STATE_MSG"] = "Account created!!!!!! thanks";
    header("Location: index.php");
    exit;

}