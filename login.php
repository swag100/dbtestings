<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("includes/db.php");
    $db = Database::getConnection("dbtestings");

    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    $result = $db->query("SELECT user_id, user_name, user_password FROM users WHERE user_name = '$username'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["user_password"])){
            //set session variabels
            $_SESSION['USER_ID'] = $row["user_id"];

            //alert
            $_SESSION["FORMSTATE"] = "SUCCESS";
            $_SESSION["FORMSTATE_MSG"] = "You have logged in as user " . $_SESSION['USER_ID'];
        }else{
            $_SESSION["FORMSTATE"] = "FAILURE";
            $_SESSION["FORMSTATE_MSG"] = "The password is wrong. Try again";
        }
    } else {
        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = "That user doesn't exist.";
    }
    
    header("Location: index.php");
    exit;   
}