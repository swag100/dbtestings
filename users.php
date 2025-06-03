<!DOCTYPE html>
<head>
    <title>Document</title>
</head>
<body>
    <h1>Users Page, View Users</h1>
    <?php
        require_once('includes/db.php');
        $db = Database::getConnection("dbtestings");
        
        $result = $db->query("SELECT user_id, user_name, user_joindate FROM users");
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["user_id"] . " - Name: " . $row["user_name"]. " - Registered on: " . $row["user_joindate"] . "<br>";
            }
        } else {
            echo "No users";
        }
    ?>
</body>
</html>