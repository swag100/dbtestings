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
    <legend>Posts</legend>
    <i>Coming soon!</i>
</fieldset>