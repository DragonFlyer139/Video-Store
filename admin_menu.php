<html>
<head><title>Admin Homepage</title>
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
		<div class="main-section">
			<div class="modal-content">
<!--STYLES STUFF END-->

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

<!--STYLES STUFF START-->
</div>
		</div>
	</div>
<!--STYLES STUFF END-->

</body>
</html>
