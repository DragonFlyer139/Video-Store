<html>
<head><title>Admin Movie Search</title></head>
<body><hr>

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
	if(isset($_POST["search_by"]) && isset($_POST["search"])) {
    $id = isset($_SESSION["memberid"]) ? $_SESSION["memberid"] : "ID NOT FOUND";
	
	//get all the basic movie info, then the total number of copies, number of instore copies,
    $sql = "select m.movieid, m.title, m.director, m.producer, m.actor1, m.actor2, m.category, count(*) TotalCopies,
				sum(case c.stat when 'in-store' then 1 else 0 end) Available
			from movie m, copy c
			where m.movieid=c.movieid and " . $_POST["search_by"] . " LIKE " . "\"%".$_POST["search"]. "%\"
			group by m.movieid;";
	
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
			  <th>Category</th>
			  <th>Total Copies</th>
			  <th>In-Store Copies</th>";
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
		echo "Please do not reload the search results page. Return to the <a href=\"admin_movie_search.php\">search page</a> if you wish to run a new movie search.";
	}
?>
<br><a href="admin_movie_search.php">Back</a>
<hr>
</body>
</html>