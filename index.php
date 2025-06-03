<?php session_start(); ?>
<!DOCTYPE html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="header">
        <h1>Dbtestings</h1><small>by Timothy Tripp</small>
        <ul class="nav">
            <li><a href="./">homne</a></li>
            <li><a href="./users.php">users</a></li>
        </ul>
    </div>
    <?php
    
    if(isset($_SESSION["USER_ID"])){
        //put logout button
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

        </form>

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
    </fieldset>
</body>
</html>