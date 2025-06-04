<?php
session_start();

//CREATE a blurb record.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("../classes/db.php");
    $db = Database::getConnection("dbtestings");

    $author = $_SESSION["USER_ID"];
    $content = $_POST["content"];

    //okay, we CAN make an account
    $result = $db->query("INSERT INTO blurbs (blurb_author, blurb_content) 
        VALUES ('$author', '$content')
    ");
    // BLURBS also has BLURB_PREDECESSOR ; USE FOR REPLIES ; It is the ID of post being REPLIED to
    if($result){
        $_SESSION["FORMSTATE"] = "SUCCESS";
        $_SESSION["FORMSTATE_MSG"] = "Blurb shared!";
    }else{
        $_SESSION["FORMSTATE"] = "FAILURE";
        $_SESSION["FORMSTATE_MSG"] = $db->error;
    }
}

header("Location: ../users.php?id=" . $_SESSION["USER_ID"]);
exit;