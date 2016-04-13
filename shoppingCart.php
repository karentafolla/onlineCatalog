<?php

session_start();

    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    
    $title = isset($_GET['title']) ? $_GET['title'] : "";
    
    $titles="";
    foreach($_SESSION['cart_items'] as $counter=>$value){
        $titles = $counter . $title . ",";
    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
  
        The title passed from the first page is <?= $_SESSION['title'] ?> 
        <div class="shoppingCart">
            Shopping Cart 
        </div>
        <div class="items">
            Items:<br>
            <?php
            //$_SESSION["title"] 
            $query = "SELECT title, rating, genre FROM movie WHERE title IN ({$titles}) ORDER BY title";
            $stmt = $con->prepare( $query );
            $stmt->execute();

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
