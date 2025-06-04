<!DOCTYPE html>
<?php include("includes/head.php"); ?>
<body>
    <?php
        session_start();

        include("includes/header.php");
        include("includes/notification.php"); 

        require_once('classes/db.php');
        $db = Database::getConnection("dbtestings");

        $pageId = $_GET["id"];
        $userId = $_SESSION["USER_ID"];

        $canEdit = $pageId == $userId;

        if(isset($pageId)){
            echo "<a href=\"users.php\">⇐ back to users list</a>";

            if(!$pageId){
                header("Location: users.php");
                exit;
            }

            $result = $db->query("SELECT * FROM users WHERE user_id = $pageId");
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
            }else{
                header("Location: users.php");
                exit;
            }
            
            $username = $row["user_name"];
            $joindate = $row["user_joindate"];

            $userblurb = $row["user_blurb"];
            if(!$userblurb){
                $userblurb = "none";
            }

            //TODO: make user blurb editable.


            //load html since vars are set
            include("includes/user.php");
        }else{
            echo "<h1>Users Page, View Users</h1>";
            $result = $db->query("SELECT user_id, user_name FROM users");
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row["user_id"];
                    $username = $row["user_name"];
                    $joindate = $row["user_joindate"];
                    echo "<a href=\"users.php?id=$id\">$username's profile</a>" . "<br>";
                }
            } else {
                echo "No users";
            }
        }
    ?>
</body>
</html>