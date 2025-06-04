<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("../classes/db.php");
    $db = Database::getConnection("dbtestings");

    $username = htmlspecialchars($_POST["username"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    //get record of requested user
    $result = $db->query("SELECT user_id, user_name, user_password FROM users 
    WHERE user_name = '$username'"); // user_name = '$username' OR user_email = '$email'
    //if user tries to login with email
    if(!empty($email)){
        $result = $db->query("SELECT user_id, user_name, user_password FROM users 
        WHERE user_email = '$email'");
    }

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
            $_SESSION["FORMSTATE_MSG"] = "The password is wrong. Try again" . $row["user_password"];
        }
    } else {
        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = "That user doesn't exist.";
    }
    
}

header("Location: ../index.php");
exit;   