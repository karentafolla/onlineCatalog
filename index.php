<?php
    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    $counter =0;
    session_start();
    
    $counter = isset($_GET['counter']) ? $_GET['counter'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : "index action";
    $passedTitle = isset($_GET['title']) ? $_GET['title'] : "Index Title";
    
    if($action == "added"){
        echo "You added " . $passedTitle . " to your shopping cart";
    }
    if($action == "not added"){
        echo "you did not add";
    }
  
    //$_SESSION["title"] = $_POST["Title"];
    // Natural join sql look at all different types of joins
    // SQL to get things from different tables that have same EmployeeID
    //$whereSql = "SELECT * FROM Employee e INNER JOIN EmployeePay ep ON e.EmployeeID = ep.EmployeeID WHERE ep.HourlyAmount = :hourly";
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <title>Online Catalog</title>
    </head>
    <body class="bg">
        <div class = "title">
            <h1> Welcome to eMovies</h1>
        </div>
        <div>
            <h3> Please Select one of the Following: </h3>
        </div>
        <div class = "radioSelections">
            <div class="filter">
            <form  action="" method="POST">
                <!--<fieldset id="Title">-->
                    <b>Sort by Title:</b> <br>
                    <input type="radio" value="Yes" name="Title"> Yes <br>
                    <input type="radio" value="No" name="Title"> No <br>
                <!--</fieldset>-->
            </div>
            <div class="filter">
                <!--<fieldset id="Genre">-->
                    <b>Refine by Genre: </b> <br>
                    <input type="radio" value="Horror" name="Genre"> Horror <br>
                    <input type="radio" value="Action" name="Genre"> Action <br>
                    <input type="radio" value="Thriller" name="Genre"> Thriller <br>
                    <input type="radio" value="Drama" name="Genre"> Drama <br>
                    <input type="radio" value="Experimental" name="Genre"> Experimental <br>
                    <input type="radio" value="Crime" name="Genre"> Crime <br>
                <!--</fieldset>-->
            </div>
            <div class="filter">
                <!--<fieldset id="Length">-->
                    <b>Refine by Length:</b> <br>
                    <input type="radio" value="84" name="Length"> 1 hour 24 mins <br>
                    <input type="radio" value="100" name="Length"> 1 hour 40 mins <br>
                    <input type="radio" value="106" name="Length"> 1 hour 46 mins <br>
                    <input type="radio" value="112" name="Length"> 1 hour 52 mins <br>
                    <input type="radio" value="129" name="Length"> 2 hours 9 mins <br>
                    <input type="radio" value="132" name="Length"> 2 hours 12 mins <br>

                <!--</fieldset>-->
            </div>
            <div class="filter">
                <!--<fieldset id="Rating">-->
                    <b>Refine by Rating:</b> <br>
                    <input type="radio" value="PG" name="Rating"> PG <br>
                    <input type="radio" value="PG-13" name="Rating"> PG-13 <br>
                    <input type="radio" value="NC-17" name="Rating"> NC-17 <br>
                    <input type="radio" value="R" name="Rating"> R <br>
                <!--</fieldset>-->
            </div>
            <div class="filter">
                <!--<fieldset id="Director">-->
                    <b>Refine by Director:</b> <br>
                    <input type="radio" value="Christopher Nolan" name="Director"> Christopher Nolan <br>
                    <input type="radio" value="David Silverman" name="Director"> David Silverman <br>
                    <input type="radio" value="Guillermo Del Toro" name="Director"> Guillermo Del Toro <br>
                    <input type="radio" value="Chris Miller" name="Director"> Chris Miller <br>
                    <input type="radio" value="Matt Reeves" name="Director"> Matt Reeves<br>
                    <input type="radio" value="Tim Burton" name="Director"> Tim Burton <br>
                <!--</fieldset>-->
            </div> 
            <div class="search">
                <!--<fieldset id="submit">-->
                    <input type="submit" value="Search Movies" name="searchMovies"> 
                <!--</fieldset>-->
            </div>
                
            </form>
        </div>
        <div class = "information">
        <?php
            if(isset($_POST['Title'])){
                if($_POST['Title'] == "Yes"){
                    sortTitle();   
                }
                else{
                    sortTitleNoOrder();
                }
            }
            else if(isset($_POST['Genre'])){
                $Genre = $_POST['Genre'];
                sortGenre($Genre);
            }
            else if(isset($_POST['Length'])){
                $Length = $_POST['Length'];
                sortLength($Length);
            }
            else if(isset($_POST['Rating'])){
                $Rating = $_POST['Rating'];
                sortRating($Rating);
            }
            else if(isset($_POST['Director'])){
                $directorName = $_POST['Director'];
                sortDirector($directorName);
            }
        ?>
            
        </div>
        <div class="iframeWindow">
            <iframe name="productInfoiFrame" align="right" width="250" height="315" src="getProductInfo.php" frameborder="0"></iframe>
        </div>
        <div class = "shoppingcCart">
            
            <form action="shoppingCart.php" method="POST" id="nameform">

                <button type="submit" value="Submit">View Shopping Cart: <?php global $counter; echo $counter ?> item(s)</button>

            </form>

        </div>
    </body>
</html>


<?php

    $_SESSION["title"] = $_POST["title"];

//sorts the movie by title in ASC order
    function sortTitle(){
        
        global $dbConn;
        global $counter;
        $sql = "SELECT * FROM movie ORDER BY title ASC";
        $stmt = $dbConn->prepare($sql);
                        
        $stmt -> execute ();
        
        echo '<table border=1>';                 
        while ($row = $stmt -> fetch()){
            $title = $row['title'];
            echo '<tr>';
                echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
                    echo $row['title'];
                echo "</a></td>";  
                echo '<td>';
                    echo $row['rating'];
                echo '</td>';
                echo '<td>';
                    echo "<a href='addToCart.php?title={$title}&counter={$counter}' class='btn btn-primary'>";
                    echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
                    echo "</a>";
                echo '</a></td>';
                
            echo '</tr>';
        }
        echo '</table>';
        
     }
     
 
    function sortTitleNoOrder(){
        global $dbConn;
        global $counter;
        $sql = "SELECT * FROM movie";
        $stmt = $dbConn->prepare($sql);
                        
        $stmt -> execute ();
        echo '<table border=1>';                 
        while ($row = $stmt -> fetch()){
            $title =$row['title'];
            echo '<tr>';
                echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
                    echo $row['title'];
                echo "</a></td>";  
                echo '<td>';
                    echo $row['rating'];
                echo '</td>';
                echo '<td>';
                    echo "<a href='addToCart.php?title={$title}&counter={$counter}' class='btn btn-primary'>";
                    echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
                    echo "</a>";
                echo '</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
//sorts by director
    function sortDirector($directorName){
        global $dbConn;
        global $counter;
        $sql = "SELECT * FROM movie WHERE director = '". $directorName. "' ORDER BY title ASC ";
        $stmt = $dbConn->prepare($sql);
                        
        $stmt -> execute ();
         echo '<table border=1>';                 
        while ($row = $stmt -> fetch()){
                $title = $row['title'];
            echo '<tr>';
                echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
                echo $row['title'];
                echo "</a></td>";  
                echo '<td>';
                    echo $row['director'];
                echo '</td>';
                echo '<td>';
                    echo "<a href='addToCart.php?title={$title}&counter={$counter}' class='btn btn-primary'>";
                    echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
                    echo "</a>";
                echo '</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
//sorts by rating
    function sortRating($rating){
        global $dbConn;
        global $counter;
        $sql = "SELECT * FROM movie WHERE rating = '". $rating. "' ORDER BY title ASC ";
        $stmt = $dbConn->prepare($sql);

        $stmt -> execute ();
        
         echo '<table border=1>';                 
        while ($row = $stmt -> fetch()){
            $title = $row['title'];
            echo '<tr>';
                echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
                    echo $row['title'];
                echo "</a></td>";  
                echo '<td>';
                    echo $row['rating'];
                echo '</td>';
                echo '<td>';
                    echo "<a href='addToCart.php?title={$title}&counter={$counter}' class='btn btn-primary'>";
                    echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
                    echo "</a>";
                echo '</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
 //sorts by length of movie   
    function sortLength($length){
      global $dbConn;
      global $counter;
        $sql = "SELECT * FROM movie WHERE length = '". $length. "' ORDER BY title ASC ";
        $stmt = $dbConn->prepare($sql);
        
        $stmt -> execute ();
        
         echo '<table border=1>';                 
        while ($row = $stmt -> fetch()){
            $title = $row['title'];
            echo '<tr>';
                echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
                    echo $row['title'];
                echo "</a></td>";  
                echo '<td>';
                    echo $row['length'] . " minutes";
                echo '</td>';
                echo '<td>';
                    echo "<a href='addToCart.php?title={$title}&counter={$counter}' class='btn btn-primary'>";
                    echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
                    echo "</a>";
                echo '</a></td>';
            echo '</tr>';
        }
        echo '</table>'; 
    }
 //sorts by genre of movie   
    function sortGenre($genre){
      global $dbConn;
      global $counter;
        $sql = "SELECT * FROM movie WHERE genre = '". $genre. "' ORDER BY title ASC";
        $stmt = $dbConn->prepare($sql);
        $stmt->execute();
        echo '<table border=1>';                 
        while ($row = $stmt -> fetch()){
            $title = $row['title'];
            echo '<tr>';
                echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
                    echo $row['title'];
                echo "</a></td>";  
                echo '<td>';
                    echo $row['genre'];
                echo '</td>';
                echo '<td>';
                    echo "<a href='addToCart.php?title={$title}&counter={$counter}' class='btn btn-primary'>";
                    echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
                    echo "</a>";
                echo '</a></td>';
            echo '</tr>';
        }
        echo '</table>';
    }
?>
