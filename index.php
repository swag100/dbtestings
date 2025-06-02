<?php session_start(); ?>
<!DOCTYPE html>
<head>
    <title>Document</title>
</head>
<body>
    <?php

    require_once('includes/db.php');
    $db = Database::getConnection();
    
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

            $formState = $_SESSION["FORM_STATE"];
            $formStateMsg = $_SESSION["FORM_STATE_MSG"];

            $prettyClass = "\"succeedNotif\"";
            if($_SESSION["FORM_STATE"] == "FAILED"){
                $prettyClass = "\"failNotif\"";
            }
            
            if($_SESSION["FORM_STATE"] == "FAILED" || $_SESSION["FORM_STATE"] == "SUCCESS"){
                echo "
                    <div class=$prettyClass>
                        <span><b>$formState: </b>$formStateMsg</span>
                        <button onclick=\"this.parentElement.remove();\">close</button>
                    </div>
                ";
                unset($_SESSION["FORM_STATE"]);
                unset($_SESSION["FORM_STATE_MSG"]);
            }

            ?>
        </form>
    </fieldset>
</body>
</html>