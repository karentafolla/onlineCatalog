<?php

    
    include '../team_project_database/database.php'; 
    
    $dbConn = getDatabaseConnection(); 
    
    function getProductInfo(){
        global $dbConn;
        $sql = "SELECT title FROM movie WHERE title=:productID";
        $nameParameter = array(":productID" => $_GET['title']);
        $stmt = $dbConn->prepare($sql);
                        
        $stmt -> execute ($nameParameter);                
        $product = $stmt->fetch(PDO::FETCH_ASSOC);
        return $product;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
        <?php
            $productInfo = getProductInfo();   
            echo $productInfo['movie'];
        ?>

    </body>
</html>