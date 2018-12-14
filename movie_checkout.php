<html>
<head><title>Check Out A Movie</title>
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
<!--STYLES STUFF END-->

</head>
<body>

<!--STYLES STUFF START-->
<div class="modal-dialog text-center">
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

	echo '<div class="text-top">
		Hello, <span class="name-tag">' . $name;  
	echo '</span></div>';
?>
<div class="main-section">
	<div class="modal-content">
		<h3>Movie Checkout</h3>
		<div class="lt-text">
			NOTE: You will be charged $7 to rent a movie and can keep this movie for seven days. If you keep it for longer, you will be charged an additional fine.
		</div>
		<br/>
		<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
			<div class="form-group">
				<input name="title" type="text" placeholder="Search by Title">
			</div>
			<button name="submit" type="submit" class="btn button">Search</button>
		</form>

<hr>
<?php
if(isset($_POST['submit'])){ //check if form was submitted

	echo "<h3> Select Movie to Checkout </h3>";

	$input = $_POST['title']; //get input text

	$sql = "select title, director, copyno from movie, copy where title LIKE " . "\"%".$_POST["title"]. "%\" and copy.movieid=movie.movieid and (copy.stat='in-store' or copy.stat=" .$id. ");";
	$result = $conn->query($sql);

	if ($result->num_rows == 0)
	  echo "No results found." . "<br>";
	else
	{
		while($row = $result->fetch_assoc()) {
			
			
			echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">";

			echo '<div class="upper-names">';
			echo "<input type=\"radio\" name=\"selection\" value=";
			echo "\"" . $row["copyno"] . "\"";
			echo ">";
			echo $row["copyno"] . " | ";
			echo implode(" | ", $row) . "<br><br>";
			//echo " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
			echo '</div><input name="checkout_submit" type="submit" class="button">';
			echo "</form>";
		}
	}
}

?>
<?php
if(isset($_POST['checkout_submit'])){
	// echo "congrats, you checked out a movie, but not really<br>";
	echo "You checked out copy ". $_POST["selection"]."<br>";
  
	/*Charge $7 at checkout*/
  
	mysqli_query($conn,"UPDATE copy SET STAT = 'Checkout' WHERE copy.COPYNO = ". $_POST["selection"].";");
	$date_rented = date("Y-m-d h:i:s");
	$sql="insert into invoice_transaction(stamp,amount,type,copyno,memberid) values('".$date_rented."','7','Checkout','". $_POST["selection"]."','".$_SESSION["memberid"]."');";
	$result = $conn->query($sql);
	
	//echo $sql;
	//echo $result;
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
