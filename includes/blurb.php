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

    include("includes/blurbrecursive.php");

    ?>
</div>