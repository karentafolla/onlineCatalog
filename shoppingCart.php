<?php
session_start();

    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    $sql = "SELECT title, rating, genre FROM movie WHERE title IN ({$titles}) ORDER BY title";
    $values = getDataBySQL($dbonn, $sql);
    
    $title = isset($_GET['title']) ? $_GET['title'] : "";
    
    $titles="";
    foreach($_SESSION['cart_items'] as $values){
        //$titles = $counter . $title . ",";
        echo $values['title'];
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body class="bg">
        <div class="shoppingCart">
            Shopping Cart 
        </div>
        <div class="items">
            Items:<br>
            <?php
            //$_SESSION["title"]

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            echo "<table>";
                echo "<tr>";
                    echo "<td>{$title}</td>";
                echo "</tr>";
            echo "</table>";
            }
            ?>
        </div>

        <div class="home">
        <button onclick="location.href = 'index.php';" id="HomePage">Main Page </button>
        </div>
    </body>
</html>
