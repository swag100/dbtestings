<div class="BLURB">
    <b><?php echo $content?></b> —
    <i>posted by <a href="users.php?id=<?php echo $authorId?>"><?php echo $author?></a> on <?php echo $postdate?></i> — 

    <form method="post" style="display:inline;">
        <button name="REPLYTO" value="<?php echo $blurbId?>" type="submit">överlämna</button>
    </form>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['REPLYTO'])) { // we just tried to reply
            $_SESSION["BLURB_REPLYINGTO"] = $_POST['REPLYTO'];
            if(isset($_SESSION["BLURB_REPLYINGTO"]) && $_SESSION["BLURB_REPLYINGTO"] == $blurbId){
                include("blurbmodal.php");
            }
        }

        //get all replies to this blurb
        $replyResult = $db->query("SELECT * FROM blurbs WHERE blurb_predecessor = $blurbId");
        if ($replyResult->num_rows > 0) {
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
                include("includes/blurb.php");
            }
        }
    ?>
</div>