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
	
	echo "Here you say hi to the person if you want" . "<br>";
	echo "Hey there " . $name;
	
	echo "<h3>Movie Checkout</h3>";
?>

<form action="<?=$_SERVER['PHP_SELF'];?>" method="post">
	Search by Title: <input name="title" type="text">
	<input name="submit" type="submit">
</form>

<hr>
<?php    
if(isset($_POST['submit'])){ //check if form was submitted
	
	echo "<h3> Select Movie to Checkout </h3>";
	
	$input = $_POST['title']; //get input text
	$sql = "select * from movie where title = " . "\"".$_POST["title"]. "\";";

	$result = $conn->query($sql);

	if ($result->num_rows == 0) 
	  echo "No results found." . "<br>";
	else
	{
		while($row = $result->fetch_assoc()) {
			echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">";
			
			echo "<input type=\"radio\" name=\"selection\" value=";
			echo "\"" . $row["MOVIEID"] . "\"";
			echo ">";
			echo implode(" | ", $row) . "<br><br>";//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
			echo "<input name=\"checkout_submit\" type=\"submit\">";
			echo "</form>";
		}
	}
}

if(isset($_POST['checkout_submit'])){
	echo "congrats, you checked out a movie, but not really<br>";
	echo "You checked out movie with ID #: ". $_POST["selection"]."<br>";
}    
?>
</body>
</html>
