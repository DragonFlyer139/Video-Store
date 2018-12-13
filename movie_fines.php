<html>
<head><title>Your Fines</title></head>
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

	echo "<h3>Movie Return</h3>";
?>

<hr>
<?php

	echo "<h3> Fines </h3>";

	$sql = "select balance from member where memberid = " . "\"".$id. "\";";

	$result = $conn->query($sql);
	if ($result->num_rows == 0)
	  echo "No balance found." . "<br>";
	else
	{
		while($row = $result->fetch_assoc()) {
      $title = $row["balance"];
			echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">";
			//echo "<input type=\"radio\" name=\"selection\" value=";
			//echo "\"" . $row["COPYNO"] . "\"";
			//echo ">";
			echo $row["balance"];
			//echo implode(" | ", $row) . "<br><br>";//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
			//echo "<input name=\"return_submit\" type=\"submit\">";
			echo "</form>";
		}
}

if(isset($_POST['return_submit'])){
	echo "Thanks for telling us you will be returning ". $title .". Please come to the store soon and return it.<br>";
  mysqli_query($conn,"
  UPDATE copy SET STAT = 'In-Store' WHERE copy.COPYNO = ". $_POST["selection"].";");
  mysqli_close($conn);

}
?>
<a href="member_menu.php">Back</a>

</body>
</html>