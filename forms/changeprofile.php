<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("../classes/db.php");
    $db = Database::getConnection("dbtestings");

    //PREVENT this page from being accessed when not logged in
    if(!isset($_SESSION["USER_ID"])){
        header("Location: ../index.php");
        exit;
    }

    $userId = $_SESSION["USER_ID"];
    $blurb = $_POST["blurb"];
    $desc = $_POST["description"];

    //edit our record
    $result = $db->query("UPDATE users SET user_blurb = '$blurb', user_desc = '$desc' WHERE user_id = $userId;");
    if(!$result){
        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = $db->error;
    }
}

$_SESSION["FORMSTATE"] = "SUCCESS";
$_SESSION["FORMSTATE_MSG"] = "Page updated!";
header("Location: ../users.php?id=$userId");
exit;