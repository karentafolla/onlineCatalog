<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <title> </title>
    </head>
    <body>
  
        The title passed from the first page is <?= $_SESSION["title"] ?> 
    </body>
</html>