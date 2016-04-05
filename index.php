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
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <title>Online Catalog</title>
    </head>
    <body>
        <div class = "title">
            <h1> Welcome to eMovies</h1>
        </div>
        <div class = "radioSelections">
            <div class="filter">
            <form  action="" method="POST">
                <fieldset id="Title">
                    Sort by Title: <br>
                    <input type="radio" value="Yes" name="Title"> Yes <br>
                    <input type="radio" value="No" name="Title"> No <br>
                </fieldset>
            </div>
            <div class="filter">
                <fieldset id="Genre">
                    Refine by Genre: <br>
                    <input type="radio" value="Horror" name="Genre"> Horror <br>
                    <input type="radio" value="Action" name="Genre"> Action <br>
                    <input type="radio" value="Thriller" name="Genre"> Thriller <br>
                    <input type="radio" value="Drama" name="Genre"> Drama <br>
                    <input type="radio" value="Experimental" name="Genre"> Experimental <br>
                    <input type="radio" value="Crime" name="Genre"> Crime <br>
                </fieldset>
            </div>
            <div class="filter">
                <fieldset id="Length">
                    Refine by Length: <br>
                    <input type="radio" value="84" name="Length"> 1 hour 24 mins <br>
                    <input type="radio" value="100" name="Length"> 1 hour 40 mins <br>
                    <input type="radio" value="106" name="Length"> 1 hour 46 mins <br>
                </fieldset>
            </div>
            <div class="filter">
                <fieldset id="Rating">
                    Refine by Rating: <br>
                    <input type="radio" value="PG" name="Rating"> PG <br>
                    <input type="radio" value="PG-13" name="Rating"> PG-13 <br>
                    <input type="radio" value="NC-17" name="Rating"> NC-17 <br>
                    <input type="radio" value="R" name="Rating"> R <br>
                </fieldset>
            </div>
            <div class="filter">
                <fieldset id="Director">
                    Refine by Director: <br>
                    <input type="radio" value="Christopher Nolan" name="Director"> Christopher Nolan <br>
                    <input type="radio" value="David Silverman" name="Director"> David Silverman <br>
                    <input type="radio" value="Guillermo Del Toro" name="Director"> Guillermo Del Toro <br>
                </fieldset>
            </div>   
                <fieldset id="submit">
                    <input type="submit" value="Search Movies" name="searchMovies"> 
                </fieldset>
                
            </form>
        </div>
        <div class = "information">
        
        <?php
            if(isset($_POST['Title'])){
                if($_POST['Title'] == "Yes")
                    sortTitle();
            }
            else if(isset($_POST['Director'])){
                $directorName = $_POST['Director'];
                echo $directorName;
                sortDirector($directorName);
            }
        ?>
            
        </div>
        <div>
            <iframe name="productInfoiFrame" width="250" height="315" src="getProductInfo.php" frameborder="0"></iframe>
        </div>
        <div class = "shopping cart">
            
        </div>
    </body>
</html>
<?php
    
//sorts the movie by title in ASC order
    function sortTitle(){
        global $dbConn;
        $sql = "SELECT * FROM movie ORDER BY title ASC";
        $stmt = $dbConn->prepare($sql);
                        
        $stmt -> execute ();
        echo '<table border=1>';                 
        while ($row = $stmt -> fetch()){
            echo '<tr><a href=getProductInfo.php?productID="'.$row['title'] .'"target="productInfoiFrame">';
                echo '<td>';
                    echo $row['title'];
                echo '</td>';
                echo '<td>';
                    echo $row['rating'];
                echo '</td>';
            echo '</tr>';
        }
        echo '<table>';
    }
//sorts by director
    function sortDirector($directorName){
        global $dbConn;
        $sql = "SELECT * FROM movie WHERE director = '". $directorName. "'  BY title ASC ";
        $stmt = $dbConn->prepare($sql);
                        
        $stmt -> execute ();
                         
        while ($row = $stmt -> fetch()){
            echo $row['title'] . " - " . $row['rating'];
            echo "<br/>";
            
        }
    }
//sorts by rating
    function sortRating($rating){
        global $dbConn;
        $sql = "SELECT * FROM movie WHERE rating = '". $rating. "'  BY title ASC ";
        $stmt = $dbConn->prepare($sql);
        
        $stmt -> execute ();
        
        while ($row = $stmt -> fetch()){
            echo $row['title'] . " - " . $row['rating'];
            echo "<br/>";
        }
    }
 //sorts by length of movie   
    function sortLength($length){
       global $dbConn;
        $sql = "SELECT * FROM movie WHERE rating = '". $length. "' BY title ASC ";
        $stmt = $dbConn->prepare($sql);
        
        $stmt -> execute ();
        
        while ($row = $stmt -> fetch()){
            echo $row['title'] . " - " . $row['rating'];
            echo "<br/>";
        } 
    }
 //sorts by genre of movie   
    function sortGenre($genre){
       global $dbConn;
        $sql = "SELECT * FROM movie WHERE rating = '". $genre. "' BY title ASC ";
        $stmt = $dbConn->prepare($sql);
        
        $stmt -> execute ();
        
        while ($row = $stmt -> fetch()){
            echo $row['title'] . " - " . $row['rating'];
            echo "<br/>";
        } 
    }

?>