<html>
<head></head>
<body>

<?php 

//You need to add some security statements to make 
//sure things only 
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
?>
<h3>Customer Functions</h3>
<ul>
		<li><a>Movie Search</a></li>
		<li><a>Movie Checkout</a></li>
		<li><a>Movie Return</a></li>
		<li><a>Movie Reserve</a></li>
		<li><a>Movie Fines</a></li>
		<li><a>Reserved Movies</a></li>
		<li><a>Movies by Director</a></li>
		<li><a href="quit.php">Quit(Log Out)</a></li>
		
</ul>
</body>
</html>