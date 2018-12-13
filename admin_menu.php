<html>
<head><title>Admin Homepage</title></head>
<body>

<?php


session_start();

//check to make sure someone is logged in
if (isset($_SESSION["adminid"]))
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

    $name = $_SESSION["adminname"];
	$id = $_SESSION["adminid"];

	echo "Hey there " . $name;

	echo "<h3>Admin Functions</h3>
<ul>
		<li><a href=\"add_movie_copy.php\">Add a Movie Copy</a></li>
		<li><a href=\"#\">Search Movie/Check Copy Status</a></li>
		<li><a href=\"add_customer.php\">Add New Customer</a></li>
		<li><a href=\"add_admin.php\">Add New Admin</a></li>
		<li><a href=\"store_information.php\">Store Information Report</a></li>
		<li><a href=\"frequent_renters.php\">Top 10 Renters Report</a></li>
		<li><a href=\"#\">Top 10 Rented Movies Report</a></li>
		<li><a href=\"#\">Top 10 Popular Movies Report</a></li>
		<li><a href=\"#\">Average Fine Paid Per Customer</a></li>
		<li><a href=\"quit.php\">Quit(Log Out)</a></li>

</ul>";
}
//if no one is logged in
else
{
	echo "You are not logged in. Please <a href=\"admin_login.php\">log in</a>.";
}
?>

</body>
</html>
