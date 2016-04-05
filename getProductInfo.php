<?php
    $username = "mirandasaari";
    //$username="karentafolla";
    $password = "Susan150";
    //$password="";
    $hostname = "localhost";
    $dbname="online_catalong";
    //$dbname="online_catalog";
    $dbPort = "127.0.0.1";

    $dbConn = new PDO("mysql:host=$hostname;port=$dbPort;dbname=$dbname", $username, $password);
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
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