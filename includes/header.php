<div class="header">
    <h1>Dbtestings</h1><small>by Timothy Tripp</small>
    <ul class="nav">
        <li><a href="./">homne</a></li>
        <li><a href="./users.php">users</a></li>
    </ul>
    
    <?php
    
    require_once("classes/db.php");
    $db = Database::getConnection("dbtestings");

    $loggedIn = isset($_SESSION["USER_ID"]);

    if($loggedIn){
        $userId = $_SESSION["USER_ID"];

        $result = $db->query("SELECT user_name FROM users WHERE user_id = $userId");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $result = $row["user_name"];
        }
    }

    ?>

    <?php if($loggedIn): ?>
        <h1>Hello, <a href="users.php?id=<?php echo $userId?>"><?php echo $result?></a></h1>
        
        <form action="forms/logout.php" method="post">
            <input type="submit" name="LOGOUT" value="LOG out">
        </form>
    <?php endif; ?>

    <?php include("notification.php"); ?>

</div>