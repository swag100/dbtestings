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
    $result = $db->query("SELECT * FROM blurbs");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $content = $row["blurb_content"];
            $postdate = $row["blurb_postdate"];

            $authorId = $row["blurb_author"];
            $author = "unknown";

            //get author  name
            $newResult = $db->query("SELECT user_name FROM users WHERE user_id = $authorId");
            if ($newResult->num_rows > 0) {
                $row = $newResult->fetch_assoc();
                $author = $row["user_name"];
            }

            echo "<div class=\"BLURB\">
                <b>$content</b> —
                <i>posted by</i> <a href=\"users.php?id=$authorId\">$author</a>: <i>$postdate</i>
            </div>";
            //TODO. CREATE reply button/link. Idk which one it would be.
        }
    } else {
        echo "Looks like there are NO blurbs... Register an account and make one!";
    }

    ?>
</body>
</html>