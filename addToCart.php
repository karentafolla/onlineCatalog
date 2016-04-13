<?php
    
    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    
    // need this to start session tracking IN EVERY PHP page using session
    session_start();

    $title = isset($_GET['title']) ? $_GET['title'] : "Something else";
    $counter = isset($_GET['counter']) ? $_GET['counter'] : 0;
    
    $counter++;
    echo $counter;
    //if empty
    if(!isset($_SESSION['cart_items'])){
        $_SESSION['cart_items'] = array();
    }
    
    $_SESSION['cart_items'][$counter] = $title;
    header('Location: index.php?action=added&title=' . $title . '&counter=' . $counter);

?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>

    </body>
</html>


