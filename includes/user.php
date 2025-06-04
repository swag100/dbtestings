<h1><?php echo $username?>'s Page</h1>

<?php if($canEdit): ?>
    <div class="NOTIF">
        <i>This is your page!</i>
    </div>
<?php endif; ?>

<small>id: <?php echo $pageId?></small>
<fieldset>
    <legend>User Information</legend>
    <span><b>Register date: </b><?php echo $joindate?></span><br>
    <span>
        <b>Status: </b><?php echo $userstatus?>

        <?php if($canEdit): ?>
            <span>[<a href="edit.php">edit</a>]</span>
        <?php endif; ?>
    </span> <br>
    <span>
        <b>About <?php echo $username?>: </b><?php echo $userdesc?>
        
        <?php if($canEdit): ?>
            <span>[<a href="edit.php">edit</a>]</span>
        <?php endif; ?>
    </span>
</fieldset>
<fieldset>
    <legend>Blurbs</legend>

    <?php if($canEdit): ?>
        <div class="BLURB">
            <h3>Create a Blurb</h3>
            <form action="forms/postblurb.php" method="post">
                <label for="content">Content: </label>
                <textarea 
                    name="content" 
                    id="content" 
                    rows="8"
                    cols="64"
                    placeholder="What are you up to.."
                ></textarea><br>
                <input type="submit">
            </form>
        </div>
    <?php endif; ?>

    <h3><?php echo $username?>'s Blurbs</h3>
    <?php
    // SHOW USER'S BLURBS
    $result = $db->query("SELECT * FROM blurbs WHERE blurb_author = $pageId");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $content = $row["blurb_content"];
            $postdate = $row["blurb_postdate"];

            echo "<div class=\"BLURB\">
            <b>$content</b> —
                <i>posted: $postdate</i>
            </div>";
        }
    } else {
        echo "User has not posted any blurbs yet!";
    }
    
    ?>
</fieldset>