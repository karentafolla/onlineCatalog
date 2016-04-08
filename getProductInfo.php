<?php

    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    
    function getProductInfo(){;
        global $dbConn;
        $sql = "SELECT director FROM movie WHERE title=:productTitle";
        $nameParameter = array(":productTitle" => $_GET['productTitle']);
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
            //echo var_dump($productInfo);
            echo $productInfo['director'];
        ?>

    </body>
</html>