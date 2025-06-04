<!DOCTYPE html>
<?php 
session_start();
include("includes/head.php"); 
?>
<body>
    
    <?php 
    include("includes/header.php");

    //PREVENT this page from being accessed when not logged in
    if(!isset($_SESSION["USER_ID"])){
        header("Location: index.php");
        exit;
    }

    //get from database to put into fields
    $result = $db->query("SELECT * FROM users WHERE user_id = " . $_SESSION["USER_ID"]);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }else{
        header("Location: edit.php");
        exit;
    }
    $userstatus = $row["user_status"];
    $userdesc = $row["user_desc"];
    
    ?>

    <fieldset>
        <legend>Edit Your Profile;</legend>
        <form action="forms/changeprofile.php" method="post">
            <label for="status">Status: </label>
            <input 
            type="text" 
            name="status" 
            id="status" 
            placeholder="How am i feeling?" 
            value="<?php echo $userstatus?>"
            > <br>
            <label for="description">About Me: </label>
            <textarea 
                name="description" 
                id="description" 
                placeholder="Write some HTML here and customize your profile!"
                rows="8"
                cols="64"
            ><?php echo $userdesc?></textarea> <br> <br>
            <input type="submit">
        </form>
    </fieldset>
    <a href="users.php?id=<?php echo $_SESSION["USER_ID"]; ?>">⇐ back to my profile</a>

    <!--TODO: fill form data with whats already in DB.-->
</body>
</html>