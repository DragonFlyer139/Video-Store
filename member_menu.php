<html>
<head></head>
<body>

<?php


session_start();

//check to make sure someone is logged in
if (isset($_SESSION["memberid"]))
{
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

	echo "<h3>Customer Functions</h3>
<ul>
		<li><a href=\"movie_search.php\">Movie Search</a></li>
		<li><a href=\"movie_checkout.php\">Movie Checkout</a></li>
		<li><a href=\"movie_return.php\">Movie Return</a></li>
		<li><a href=\"movie_reserve.php\">Movie Reserve</a></li>
		<li><a>Movie Fines</a></li>
		<li><a href=\"movie_reservesearch.php\">Reserved Movies</a></li>
		<li><a>Movies by Director</a></li>
		<li><a href=\"quit.php\">Quit(Log Out)</a></li>

</ul>";
}
//if no one is logged in
else
{
	echo "You are not logged in. Please <a href=\"member_login.php\">log in</a> or <a href=\"signup.php\">sign up</a>.";
}
?>

</body>
</html>
