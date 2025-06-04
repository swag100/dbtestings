<!DOCTYPE html>
<?php 
session_start();
include("includes/head.php"); 
?>
<body>
    
    <?php 
    include("includes/header.php"); 
    include("includes/notification.php"); 

    //PREVENT this page from being accessed when not logged in
    if(!isset($_SESSION["USER_ID"])){
        header("Location: index.php");
        exit;
    }
    
    ?>

    <fieldset>
        <legend>Edit Your Profile;</legend>
        <form action="forms/changeprofile.php" method="post">
            <label for="blurb">Blurb: </label>
            <input type="text" name="blurb" id="blurb" placeholder="How am i feeling?"> <br>
            <label for="description">About Me: </label>
            <textarea 
                name="description" 
                id="description" 
                placeholder="Write some HTML here and customize your profile!"
                rows="8"
                cols="64"
            ></textarea> <br> <br>
            <input type="submit">
        </form>
    </fieldset>
    <a href="users.php?id=<?php echo $_SESSION["USER_ID"]; ?>">⇐ back to my profile</a>

    <!--TODO: fill form data with whats already in DB.-->
</body>
</html>