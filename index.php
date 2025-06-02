<?php
session_start();
?>
<!DOCTYPE html>
<head>
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Wow!</h1>
    <?php echo 'Oh man, This is a cool looking P.H.P. Web Page! aa' ?>

    <?php
        // THIS is a connection! WOWW!!
        require_once('db.php');
        $db = Database::getConnection();
        
        $sql = "SELECT id, username, email FROM users";
        $result = $db->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<br> id: " . $row["id"]. " - Name: " . $row["username"]. " - Email: " . $row["email"];
            }
        } else {
            echo "0 results";
        }

    ?>

    <form action="register.php" method="post">
        <h1>signup</h1>
        <label for="username">Username: </label>
        <input type="text" name="username"> <br>
        
        <label for="email">Email: </label>
        <input type="email" name="email"> <br>
        
        <label for="password">Password: </label>
        <input type="password" name="password"> <br>

        <input type="submit">
    </form>

    <?php

    $formState = $_SESSION["FORM_STATE"];
    $formStateMsg = $_SESSION["FORM_STATE_MSG"];
    $prettyClass = "'succeedNotif'";

    if($_SESSION["FORM_STATE"] == "FAILED"){
        $prettyClass = "'failNotif'";
    }
    
    if($_SESSION["FORM_STATE"] == "FAILED" || $_SESSION["FORM_STATE"] == "SUCCESS"){
        echo "
            <div class=$prettyClass>
                <h3>$formState</h3>
                <p>$formStateMsg</p>
                <button onclick='this.remove();'>close</button>
            </div>
        ";
    } 

    ?>
</body>
</html>