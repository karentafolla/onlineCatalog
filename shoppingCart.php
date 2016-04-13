<?php

session_start();

    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    
    $title = isset($_GET['title']) ? $_GET['title'] : "Something else";
    $counter = isset($_GET['counter']) ? $_GET['counter'] : 5;

    function printArray(){
        if($counter==0)
        {
            echo "Your cart is empty";
        }
        else{
            foreach($_SESSION['cart_items'] as $counter => $title){
                echo $title . "</ br>";
            }
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
            <div class="buy">
                <!--doesn't do anything -->
                <input type ="button" value="Buy Now"> 
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