<?php

//TODO: There is an ERROR; only showing FIRST reply.
//using RETURN; has something to do with it!
//It DOES go through all 6, but including Blurb.php will not work.

//get all replies to this blurb
$replyResult = $db->query("SELECT * FROM blurbs WHERE blurb_predecessor = $blurbId");
if ($replyResult) {
    echo "<small>$replyResult->num_rows replies</small>";
    while($row = $replyResult->fetch_assoc()) {
        $blurbId = $row["blurb_id"];
        $content = $row["blurb_content"];
        $postdate = $row["blurb_postdate"];

        $authorId = $row["blurb_author"];
        $author = "unknown";

        //get author  name
        $newReplyResult = $db->query("SELECT user_name FROM users WHERE user_id = $authorId");
        if ($newReplyResult->num_rows > 0) {
            $row = $newReplyResult->fetch_assoc();
            $author = $row["user_name"];
        }

        //include this html just like a user
        if ($replyResult->num_rows > 0) {
            include("includes/blurb.php"); // recursive and will only echo first reply
        }else{
            include("includes/reply.php"); // not recursive and echoes every reply
        }
    }
}
