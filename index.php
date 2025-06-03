<?php session_start(); ?>
<!DOCTYPE html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        require_once('includes/db.php');
        $db = Database::getConnection("dbtestings");
        
        $result = $db->query("SELECT user_id, user_name, user_joindate FROM users");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["user_id"] . " - Name: " . $row["user_name"]. " - Registered on: " . $row["user_joindate"] . "<br>";
            }
        } else {
            echo "0 results";
        }
    ?>

    <fieldset>
        <legend>Get into an account</legend>
        <form id="accountForm" method="post">
            <label for="username">Username: </label>
            <input type="text" id="username" name="username" autocomplete="off" placeholder="Creative name"> <br>
            
            <label for="email">Email: </label>
            <input type="email" id="email" name="email" autocomplete="off" placeholder="Creative email"> <br>
            
            <label for="password">Password: </label>
            <input type="password" id="password" name="password" autocomplete="off" placeholder="Creative password"> <br>

            <button onclick="this.parentElement.action = 'login.php';">Log In</button>
            <button onclick="this.parentElement.action = 'register.php';">Register!</button>

            <!--create our wonderful pop up-->
            <?php

            $formState = $_SESSION["FORMSTATE"];
            $formStateMsg = $_SESSION["FORMSTATE_MSG"];

            $prettyClass = "\"succeedNotif\"";
            if($formState == "FAILED"){
                $prettyClass = "\"failNotif\"";
            }
            
            if($formState == "FAILURE" || $formState == "SUCCESS"){
                echo "
                    <div class=\"NOTIF NOTIF_$formState\">
                        <span><b>$formState: </b>$formStateMsg</span>
                        <button onclick=\"this.parentElement.remove();\">close</button>
                    </div>
                ";
                unset($_SESSION["FORMSTATE"]);
                unset($_SESSION["FORMSTATE_MSG"]);
            }

            ?>
        </form>
    </fieldset>
</body>
</html>