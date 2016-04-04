<?php
    $username = "karentafolla";
    $password = "";
    $hostname = "localhost";
    $dbname="online_catalog";
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
            <form  action="" method="POST">
                <fieldset id="Title">
                    Sort by Title:
                    <input type="radio" value="Yes" name="Title"> Yes
                    <input type="radio" value="No" name="Title"> No
                </fieldset>
                
                <fieldset id="Genre">
                    Refine by Genre:
                    <input type="radio" value="Horror" name="Genre"> Horror
                    <input type="radio" value="Action" name="Genre"> Action
                    <input type="radio" value="Thriller" name="Genre"> Thriller
                    <input type="radio" value="Drama" name="Genre"> Drama
                    <input type="radio" value="Experimental" name="Genre"> Experimental
                    <input type="radio" value="Crime" name="Genre"> Crime
                </fieldset>
            
                <fieldset id="Length">
                    Refine by Length:
                    <input type="radio" value="84" name="Length"> 1 hour 24 mins
                    <input type="radio" value="100" name="Length"> 1 hour 40 mins
                    <input type="radio" value="106" name="Length"> 1 hour 46 mins
                </fieldset>
                
                <fieldset id="Rating">
                    Refine by Rating:
                    <input type="radio" value="PG" name="Rating"> PG
                    <input type="radio" value="PG-13" name="Rating"> PG-13
                    <input type="radio" value="NC-17" name="Rating"> NC-17
                    <input type="radio" value="R" name="Rating"> R
                </fieldset>
                
                <fieldset id="Director">
                    Refine by Director:
                    <input type="radio" value="Christopher Nolan" name="Director"> Christopher Nolan
                    <input type="radio" value="David Silverman" name="Director"> David Silverman
                    <input type="radio" value="Guillermo Del Toro" name="Director"> Guillermo Del Toro
                </fieldset>
                
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