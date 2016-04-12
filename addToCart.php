<?php
    
    
    
    // need this to start session tracking IN EVERY PHP page using session
    session_start();
    
    $_SESSION["title"] = $_POST["title"];
    
    
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