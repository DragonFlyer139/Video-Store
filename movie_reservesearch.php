<html>
<head></head>
<body>
<?php

//You need to add some security statements to make
//sure things only appear
session_start();
//echo "session started<br>";
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

    $name = $_SESSION["membername"];
	$id = $_SESSION["memberid"];

	echo "Hey there " . $name;

	echo "<h3>Reserved Movies</h3>";
?>

<hr>
<?php

	echo "<h3> Your Reserved Movies: </h3>";

	$sql = "select title, director, copyno from movie, copy where copy.movieid=movie.movieid and stat=". $id .";";

	$result = $conn->query($sql);

	if ($result->num_rows == 0)
	  echo "No results found." . "<br>";
	else
	{
		echo "<table style=\"width: 100%\">";
		echo "<th>Title</th>
			  <th>Director</th>
			  <th>Copy Number</th>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>".implode("</td><td>", $row) . "</td><tr>";
			//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
	}
					echo "</table>";

}
?>
<a href="member_menu.php">Back</a>
</body>
</html>
