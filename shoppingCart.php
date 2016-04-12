<?php
    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Shopping Cart</title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
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
    </body>
</html>
