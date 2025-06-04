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
        <b>Blurb: </b>
        <?php echo $userblurb?>
        
        <span>[<a href="edit.php">edit</a>]</span>
    </span>
</fieldset>
<fieldset>
    <legend>Posts</legend>
    <i>Coming soon!</i>
</fieldset>