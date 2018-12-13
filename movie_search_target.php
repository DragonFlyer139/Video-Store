<html>
<head></head>
<body><hr>

<h3>Movie Search Results</h3>
<?php 
session_start();
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "video_store"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $id = isset($_SESSION["memberid"]) ? $_SESSION["memberid"] : "ID NOT FOUND";
	
	if(isset($_POST["search_by"]) && isset($_POST["search"])) {
    $sql = "select * from movie where " . $_POST["search_by"] . " LIKE " . "\"%".$_POST["search"]. "%\";";
	
    $result = $conn->query($sql);
	
    if ($result->num_rows == 0) 
      echo "No results found." . "<br>";
    else
    {
		while($row = $result->fetch_assoc()) {
			echo implode(" | ", $row) . "<br><br>";//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
		}
    }
	}
	else {
		echo "Please do not reload the search results page. Return to the <a href=\"movie_search.php\">search page</a> if you wish to run a new movie search.";
	}
?>
<br><a href="movie_search.php">Back</a>
<hr>
</body>
</html>