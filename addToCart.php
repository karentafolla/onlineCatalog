<?php
    
    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    
    // need this to start session tracking IN EVERY PHP page using session
    session_start();
    
    $title = isset($_GET['title']) ? $_GET['title'] : "";
    
    //if empty
    if(!isset($_SESSION['cart_items'])){
    $_SESSION['cart_items'] = array();
    }
    else {
    $_SESSION["cart_items"] = $title;
    header('Location: getProductInfo.php?action=added&title' . $title . '&name=' . $name);
    }
     
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        The title posted is <?= $_POST["title"] ?> 
        
        <a href="shoppingCart.php?title=<?= $_POST["title"] ?>">Please Buy Now!</a>
    </body>
</html>


