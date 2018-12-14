<html>
<head></head>
<body>
<?php

//You need to add some security statements to make
//sure things only appear
session_start();
//echo "session started<br>";
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


      echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">";
			echo "<tr><td> <input type=\"radio\" name=\"selection\" value=";
			echo "\"" . $row["copyno"] . "\"";
			echo ">";
			echo "" .implode("</td><td>", $row) . "";
      echo "</td><tr>";
			//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
	}

					echo "</table>";
          echo "<input name=\"return\" type=\"submit\" value=\"Cancel reservation\">";
          echo "</form>";
          echo"<br> <br>";
}
?>
<<?php

if(isset($_POST['return'])){
	echo "You have canceled your reservation<br>";

	/*Charge $7 at checkout*/

	mysqli_query($conn,"UPDATE copy SET STAT = 'in-store' WHERE copy.COPYNO = ". $_POST["selection"].";");

	//echo $sql;
	//echo $result;
	mysqli_close($conn);
}

 ?>
<a href="member_menu.php">Back</a>
</body>
</html>
