<!DOCTYPE html>
<?php 
session_start();
include("includes/head.php"); 
?>
<body>
    <?php include("includes/header.php"); ?>
    <fieldset>
        <legend>Edit Your Profile;</legend>
        <form action="forms/changeprofile.php">
            <label for="blurb">Blurb: </label>
            <input type="text" name="blurb" id="blurb" placeholder="How am i feeling?"> <br>
            <label for="blurb">About Me: </label>
            <textarea 
                name="description" 
                id="description" 
                placeholder="Write some inline CSS here and customize your profile!"
                rows="8"
                cols="64"
            ></textarea> <br> <br>
            <input type="submit">
        </form>
    </fieldset>
    <a href="users.php?id=<?php echo $_SESSION["USER_ID"]; ?>">⇐ back to my profile</a>
</body>
</html>

<?php

//Page to edit profile info!