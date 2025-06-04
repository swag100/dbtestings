<!DOCTYPE html>
<?php 
session_start();
include("includes/head.php"); 
?>
<body>
    <?php
    include("includes/header.php");
    include("includes/notification.php");
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

            <button onclick="this.parentElement.action = 'forms/login.php';">Log In</button>
            <button onclick="this.parentElement.action = 'forms/register.php';">Register!</button>

        </form>
    </fieldset>
</body>
</html>