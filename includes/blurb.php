<div class="BLURB">
    <b><?php echo $content?></b> —
    <i>posted by <a href="users.php?id=<?php echo $authorId?>"><?php echo $author?></a> on <?php echo $postdate?></i> — 

    <form action="" method="post" style="display:inline;">
        <input type="submit" name="REPLY" value="reply">
    </form>
    <?php
        function display() {
            echo "hello ".$_POST["studentname"];
        }
        if(isset($_POST['REPLY'])) {
            if(!isset($_SESSION["BLURB_REPLYINGTO"])){//if not set
                $_SESSION["BLURB_REPLYINGTO"] = $blurbId; //set and show modal
                include("blurbmodal.php");
            }else{
                unset($_SESSION["BLURB_REPLYINGTO"]); //unset and hide modal
            }
        } 
    ?>
</div>