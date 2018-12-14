<html>
<head><title>Admin Homepage</title></head>
<body>

<?php


session_start();

//check to make sure someone is logged in
//echo "session started<br>";
$servername = "localhost";
   if (!isset($_SESSION["adminid"]))
{
		header("Location: login_check_admin.php");
}
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
		<li><a href=\"admin_movie_search.php\">Search Movie/Check Copy Status</a></li>
		<li><a href=\"add_customer.php\">Add New Customer</a></li>
		<li><a href=\"add_admin.php\">Add New Admin</a></li>
		<li><a href=\"store_information.php\">Store Information Report</a></li>
		<li><a href=\"frequent_renters.php\">Top 10 Renters Report</a></li>
		<li><a href=\"most_rented_movies.php\">Top 10 Rented Movies by Store Report</a></li>
		<li><a href=\"popular_movies_by_year.php\">Top 10 Rented Movies by Year Report</a></li>
		<li><a href=\"average_fine_report.php\">Average Fine Paid Per Customer</a></li>
		<li><a href=\"quit.php\">Quit(Log Out)</a></li>

</ul>";

//if no one is logged in
?>

</body>
</html>
