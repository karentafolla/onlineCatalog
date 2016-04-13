<?php

    session_start();

    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    
    $title = isset($_GET['title']) ? $_GET['title'] : "Something else";
    $counter = isset($_GET['counter']) ? $_GET['counter'] : 5;
    
    print_r($_SESSION['cart_items']);
    
    function printArray(){
        foreach($_SESSION['cart_items'] as $counter => $title){
            echo $title;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body class="bg">

  
        The title passed from the first page is <?= printArray(); ?> 

        <div class="shoppingCart">
            Shopping Cart 
        </div>
        <div class="items">
            Items:<br>
            <!--// <=?php-->
            <!--// //$_SESSION["title"]-->

            <!--// while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){-->
            <!--// extract($row);-->
            <!--// echo "<table>";-->
            <!--//     echo "<tr>";-->
            <!--//         echo "<td>{$title}</td>";-->
            <!--//     echo "</tr>";-->
            <!--// echo "</table>";-->
            <!--// }-->
            <!--// ?>-->
        </div>

        <div class="home">
        <button onclick="location.href = 'index.php';" id="HomePage">Main Page </button>
        </div>

    </body>
</html>
<?php
    session_destroy();
?>