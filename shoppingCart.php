<?php

    session_start();

    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    
    $title = isset($_GET['title']) ? $_GET['title'] : "Something else";
    $counter = isset($_GET['counter']) ? $_GET['counter'] : 5;

    function printArray(){
        global $counter;
        if($_SESSION['cart_items'] ==  '')
        {
            echo "Your cart is empty";
        }
        else{
            echo '<table border=1 solid>';
            echo '<tr>';
            echo '<td>' . 'Title' . '</td>';
            echo '<td>' . 'Quantity' . '</td>';
            echo '</tr>';
            foreach($_SESSION['cart_items'] as $counter => $title){
                echo '<tr>';
                echo '<td>' . $title . '</td>';
                echo '<td>' . $counter . '</td>';
                echo '</tr>';
            }
            echo '</table>';
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

        <div class="titlec">
            eMovie Shopping Cart 
        </div>
        <div class="cart">
            <div class="items">
                Items:<br>
            </div>
            <div class="itemList">
                <?= printArray(); ?> 
            </div>
        
        </div>

        <div class="home">
        <button onclick="location.href = 'index.php';" id="HomePage">Main Page </button>
        </div>

    </body>
</html>
<?php
    session_destroy();
?>