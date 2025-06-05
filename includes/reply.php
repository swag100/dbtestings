<div class="BLURB">
    <b><?php echo $content?></b> —
    <i>posted by <a href="users.php?id=<?php echo $authorId?>"><?php echo $author?></a> on <?php echo $postdate?></i> — 

    <form method="post" style="display:inline;">
        <button name="REPLYTO" value="<?php echo $blurbId?>" type="submit">överlämna</button>
    </form>
</div>