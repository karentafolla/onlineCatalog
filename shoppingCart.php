<?php
<<<<<<< HEAD
session_start();
=======
    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 

>>>>>>> ec01b1f0441caff415c114b717ae3506a4940946
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
<<<<<<< HEAD
  
        The title passed from the first page is <?= $_SESSION["title"] ?> 
=======
        <div class="shoppingCart">
            Shopping Cart 
        </div>
        <div class="items">
            Items:
            
        </div>
        <?php
        
        ?>
        <div class="home">
        <button onclick="location.href = 'index.php';" id="HomePage">Main Page </button>
        </div>
>>>>>>> ec01b1f0441caff415c114b717ae3506a4940946
    </body>
</html>
