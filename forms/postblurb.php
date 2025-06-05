<?php
session_start();

//CREATE a blurb record.

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once("../classes/db.php");
    $db = Database::getConnection("dbtestings");

    $author = $_SESSION["USER_ID"];
    $content = $_POST["content"];

    //remove script tag from description
    $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);

    $sql = "INSERT INTO blurbs (blurb_author, blurb_content) VALUES ('$author', '$content')";
    if(isset($_SESSION["BLURB_REPLYINGTO"])){
        $blurbId = $_SESSION["BLURB_REPLYINGTO"];
        $sql = "INSERT INTO blurbs (blurb_author, blurb_content, blurb_predecessor) VALUES ('$author', '$content', $blurbId)";
    }

    //okay, we CAN make an account
    $result = $db->query($sql);
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