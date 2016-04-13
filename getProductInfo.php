<?php

    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    
    session_start();
    
    
    function getProductInfo(){;
        global $dbConn;
        $sql = "SELECT summary FROM movie WHERE title=:productTitle";
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
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <title> </title>
    </head>
    <body>
        <div class=summary>
        <?php
            $productInfo = getProductInfo();   
            //echo var_dump($productInfo);
            echo $productInfo['summary'];
        ?>
        </div>

    </body>
</html>