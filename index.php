<!DOCTYPE html>
<?php 
session_start();
include("includes/head.php"); 
?>
<body>
    <?php
    include("includes/header.php");
    ?>
    <!--<h1>Blurble</h1>-->

    <fieldset>
        <legend>Get into an account</legend>
        <form id="accountForm" method="post">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" autocomplete="off" placeholder="Creative name"> <br>
            
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" autocomplete="off" placeholder="Creative email"> <br>
            
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" autocomplete="off" placeholder="Creative password"> <br>

            <button onclick="this.parentElement.action = 'forms/login.php';">Log In</button>
            <button onclick="this.parentElement.action = 'forms/register.php';">Register!</button>

        </form>
    </fieldset>

    <!--view all blurbs-->
    <h1>Recently Posted blurbs</h1>
    <?php
    
    // SHOW USER'S BLURBS
    $result = $db->query("SELECT * FROM blurbs WHERE blurb_predecessor IS NULL");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $blurbId = $row["blurb_id"];
            $content = $row["blurb_content"];
            $postdate = $row["blurb_postdate"];

            $authorId = $row["blurb_author"];
            $author = "unknown";

            //get author  name
            $nameResult = $db->query("SELECT user_name FROM users WHERE user_id = $authorId");
            if ($nameResult->num_rows > 0) {
                $row = $nameResult->fetch_assoc();
                $author = $row["user_name"];
            }

            include("includes/blurb.php");
            
            //TODO. CREATE reply button/link. Idk which one it would be.
        }
    } else {
        echo "Looks like there are NO blurbs... Register an account and make one!";
    }

    ?>
</body>
</html>