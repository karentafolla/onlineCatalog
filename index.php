<?php
    include '../team_project_database/database.php'; 
    $dbConn = getDatabaseConnection(); 
    $counter =0;
    session_start();
    //session_destroy();
    
    $counter = isset($_GET['counter']) ? $_GET['counter'] : 0;
    $action = isset($_GET['action']) ? $_GET['action'] : "index action";
    $passedTitle = isset($_GET['title']) ? $_GET['title'] : "Index Title";
    
    // if(!NULL == $_SESSION('cart_items'))
    //     print_r($_SESSION('cart_items'));
    // foreach($_SESSION['cart_items'] as $counter=>$value){
    //     $value = $counter . $value . ",";
    // }
    
    echo $counter;
    
    
    if($action == "added"){
        echo "you added " . $passedTitle;
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
        <div class = "shopping cart">
            
            <form action="shoppingCart.php" method="POST" id="nameform">
                <!--<button type="submit" value="Submit">Shopping Cart</button>-->
            <!--<form action="shoppingCart.php" method="POST" id="nameform">-->
            <!--    php?php -->
            <!--        //$cartCount=count($_SESSION['cart_items'])-->
            <!--    ?>-->
             <button type="submit" value="Submit">View Shopping Cart <?php echo $cartCount; ?></button>

            </form>
            

         <!--//<button onclick="location.href = 'shoppingCart.php';" id="shoppingCart">Shopping Cart </button>-->

        </div>
    </body>
</html>


<?php
    //session_start();
    $_SESSION["title"] = $_POST["title"];
    $_SESSION['arr'];
    //$_SESSION['cart_items'] = $_SESSION['title'];
    
//counts items in cart
    $itemCounter=0;
    function clickCounter(){
        $itemCounter +=1;
        return $itemCounter;
    }

    
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
                    
                    //echo  '<form action="addToCart.php" method="GET">';
                        //<input type="text" id="name" name="name" class="form-control" placeholder="Full Name">
                        
                       echo "<a href='addToCart.php?title={$title}&counter={$counter}' class='btn btn-primary'>";
                        //echo '<a name="' .$title. '"}';
                        echo "<span class='glyphicon glyphicon-shopping-cart'></span> Add to cart";
                        echo "</a>";
                        
                        //echo '<button type="submit" id="name" name="title" class="form-control" value="' . $title . '"> Add to Cart </button>';
       
                        
                    //  echo "<a href='addToCart.php?title=$title'> ";
                    //  echo "Add to Cart";
                    //  echo "</a>";
                    //echo  '<form action="addToCart.php" method="POST">';
                   // echo '<button type="submit" id="name" name="title" class="form-control" value="' . $title . '">Buy</button>';

                        // using JS
                        //echo '<button onclick="itemClicked()" type="button" name='.$title .'>Add to Cart</button>';
                        //echo '<button type="button" name='.$title .'>Add to Cart</button>';
                   // echo '</form>';
                echo '</a></td>';
                echo '<td>' . $counter. '</td>';
            echo '</tr>';
        }
        echo '</table>';
        
     }
     
    //  function addData(){
    //      $_SESSION['cart_items'][$title] = array('Quantity' => $quantity, 'Total' => $total);
    //  }
     
//     function sortTitleNoOrder(){
//         global $dbConn;
//         $sql = "SELECT * FROM movie";
//         $stmt = $dbConn->prepare($sql);
                        
//         $stmt -> execute ();
//         echo '<table border=1>';                 
//         while ($row = $stmt -> fetch()){
//             echo '<tr>';
//                 echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
//                     echo $row['title'];
//                 echo "</a></td>";  
//                 echo '<td>';
//                     echo $row['rating'];
//                 echo '</td>';
//                 echo '<td>';
//                     echo '<button onclick="clickCounter()" type="button">Add to Cart</button>';
//                 echo '</td>';
//             echo '</tr>';
//         }
//         echo '</table>';
//     }
// //sorts by director
//     function sortDirector($directorName){
//         global $dbConn;
//         $sql = "SELECT * FROM movie WHERE director = '". $directorName. "' ORDER BY title ASC ";
//         $stmt = $dbConn->prepare($sql);
                        
//         $stmt -> execute ();
//          echo '<table border=1>';                 
//         while ($row = $stmt -> fetch()){
//             echo '<tr>';
//                 echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
//                 echo $row['title'];
//                 echo "</a></td>";  
//                 echo '<td>';
//                     echo $row['director'];
//                 echo '</td>';
//                 echo '<td>';
//                     echo '<button onclick="clickCounter()" type="button">Add to Cart</button>';
//                 echo '</td>';
//             echo '</tr>';
//         }
//         echo '</table>';
//     }
// //sorts by rating
//     function sortRating($rating){
//         global $dbConn;
//         $sql = "SELECT * FROM movie WHERE rating = '". $rating. "' ORDER BY title ASC ";
//         $stmt = $dbConn->prepare($sql);

//         $stmt -> execute ();
        
//          echo '<table border=1>';                 
//         while ($row = $stmt -> fetch()){
//             echo '<tr>';
//                 echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
//                     echo $row['title'];
//                 echo "</a></td>";  
//                 echo '<td>';
//                     echo $row['rating'];
//                 echo '</td>';
//                 echo '<td>';
//                     echo '<button onclick="clickCounter()" type="button">Add to Cart</button>';
//                 echo '</td>';
//             echo '</tr>';
//         }
//         echo '</table>';
//     }
//  //sorts by length of movie   
//     function sortLength($length){
//       global $dbConn;
//         $sql = "SELECT * FROM movie WHERE length = '". $length. "' ORDER BY title ASC ";
//         $stmt = $dbConn->prepare($sql);
        
//         $stmt -> execute ();
        
//          echo '<table border=1>';                 
//         while ($row = $stmt -> fetch()){
//             echo '<tr>';
//                 echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
//                     echo $row['title'];
//                 echo "</a></td>";  
//                 echo '<td>';
//                     echo $row['length'];
//                 echo '</td>';
//                 echo '<td>';
//                     echo '<button onclick="clickCounter()" type="button">Add to Cart</button>';
//                 echo '</td>';
//             echo '</tr>';
//         }
//         echo '</table>'; 
//     }
//  //sorts by genre of movie   
//     function sortGenre($genre){
//       global $dbConn;
//         $sql = "SELECT * FROM movie WHERE genre = '". $genre. "' ORDER BY title ASC";
//         $stmt = $dbConn->prepare($sql);
//         $stmt->execute();
//         echo '<table border=1>';                 
//         while ($row = $stmt -> fetch()){
//             echo '<tr>';
//                 echo "<td id='product'><a href='getProductInfo.php?productTitle=" .$row['title']."' target='productInfoiFrame'> ";
//                     echo $row['title'];
//                 echo "</a></td>";  
//                 echo '<td>';
//                     echo $row['genre'];
//                 echo '</td>';
//                 echo '<td>';
//                     // using js
//                     // echo '<button onclick="clickCounter()" type="button">Add to Cart</button>';
//                 echo '</td>';
//             echo '</tr>';
//         }
//         echo '</table>';
//     }
?>
<script>
    
    function itemClicked(){
        var counter = 10;
        document.write(counter);
        
    }
</script>
