<?php
    
    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    
    // need this to start session tracking IN EVERY PHP page using session
    session_start();
    
    //$variable = $_GET["title"];
    //$_SESSION["title"] = $_GET["title"];
    // $_SESSION['arr'] = $_POST["title"];

    $title = isset($_GET['title']) ? $_GET['title'] : "Something else";
    $counter = isset($_GET['counter']) ? $_GET['counter'] : 5;
    
    $counter++;
    echo $counter;
    //if empty
    if(!isset($_SESSION['cart_items'])){
    $_SESSION['cart_items'] = array();
    }
    
    $_SESSION['cart_items'][$counter] = $title;
    //echo $title;

        //print_r($_SESSION['cart_items']);
        
        //var_dump($_SESSION['cart_items']);
        //header('Location: index.php');
        //header('Location: index.php?action=added&title' . $title);
        header('Location: index.php?action=added&title=' . $title . '&counter=' . $counter);

?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

        <!--The title posted is <=?= $_POST["title"] ?> -->

        <!--The title posted is <=?= $_POST['cart_items'] ?> -->
        <!--<a href="shoppingCart.php?title=<=?= $_POST["title"] ?>">Please Buy Now!</a>-->
    </body>
</html>


