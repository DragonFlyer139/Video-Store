<html>
<head><title>Movie Search Results | Video Store</title>
<!--STYLES STUFF START-->
<meta charset = "UTF-8">
	<meta keyword name = "viewport" content = "width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/icon.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>	
<div class="modal-dialog text-center">
	<div class="main-section">
		<div class="modal-content">
<h2>Search Results</h2>
<?php 
session_start();
if (!isset($_SESSION["memberid"]))
{
		header("Location: login_check.php");
}
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
		echo "<table style=\"width: 100%\">";
		echo "<th>Movie ID</th>
			  <th>Title</th>
			  <th>Director</th>
			  <th>Producer</th>
			  <th>Actor 1</th>
			  <th>Actor 2</th>
			  <th>Category</th>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>".implode("</td><td>", $row) . "</td><tr>";
			//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
		}
				echo "</table>";

    }
	}
	else {
		echo 'No results found. <span class="lt-text">Please do not reload this page.</span>
		<a href="movie_search.php"><button class="btn button">Search Again</button></a>';
		// echo "Please do not reload the search results page. Return to the <a href=\"movie_search.php\">search page</a> if you wish to run a new movie search.";
	}
?>
<br><a href="movie_search.php">Back</a>
</body>
</html>