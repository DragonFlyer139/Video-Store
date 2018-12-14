<html>
<head><title>Reserve A Movie</title>
<!--STYLES STUFF START-->
<meta charset = "UTF-8">
	<meta keyword name = "viewport" content = "width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/icon.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css">
	<script src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script> -->
<!--STYLES STUFF END--></head>
<body>


<!--STYLES STUFF START-->
<div class="modal-dialog text-center">
		<div class="main-section">
			<div class="modal-content">
<!--STYLES STUFF END-->

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

	echo "<h3>Movie Reserve</h3>";
?>

<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
	Search by Title: <input name="title" type="text">
	<input name="submit" type="submit">
</form>

<hr>
<?php
if(isset($_POST['submit'])){ //check if form was submitted

	echo "<h3> Select Movie to Reserve </h3>";

	$input = $_POST['title']; //get input text
  $sql = "select title, director, COPYNO from movie, copy where title like " . "\"%".$_POST["title"]. "%\" and copy.movieid=movie.movieid and copy.stat='in-store';";
	$result = $conn->query($sql);
	if ($result->num_rows == 0)
	  echo "No results found." . "<br>";
	else
	{
		while($row = $result->fetch_assoc()) {
      $copy=$row["COPYNO"];
			echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">";
			echo "<input type=\"radio\" name=\"selection\" value=";
			echo "\"" . $row["COPYNO"] . "\"";
			echo ">";
			echo implode(" | ", $row) . "<br><br>";//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
			echo "<input name=\"reserve_submit\" type=\"submit\">";
			echo "</form>";
		}
	}
}
if(isset($_POST['reserve_submit'])){
	echo "congrats, you reserved a movie, but not really<br>";
	echo "You reserved copy ". $_POST["selection"]."<br>";
  mysqli_query($conn,"
  UPDATE copy SET STAT = ".$id." WHERE copy.COPYNO = ". $_POST["selection"].";");
  mysqli_close($conn);
}
?>
<a href="member_menu.php">Back</a>


<!--STYLES STUFF START-->
</div>
		</div>
	</div>
<!--STYLES STUFF END-->

</body>
</html>
