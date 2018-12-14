<html>
<head><title>Movie Search</title>
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
//sure things only
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
		<form action="movie_search_target.php" method="post">
			<div class="input-group mb-3">
				<!-- <div class="input-group-prepend">
					<label class="input-group-text" for="inputGroupSelect01">Search by:</label>
				</div> -->
				<select name="search_by" class="custom-select" id="inputGroupSelect01">
					<option selected>Search by:</option>
					<option value="Category">Category</option>
					<option value="Title">Title</option>
					<option value="Director">Director</option>
				</select>
			</div>
		<!-- <form action="movie_search_target.php" method="post">
			Search by: <select name="search_by">
				<option value="Category">Category</option>
				<option value="Title">Title</option>
				<option value="Director">Director</option>
			</select> -->
			<div class="form-group">
				<input name="search" type="text" placeholder="Search">
			</div>
			<button type="submit" class="btn button">Search</button>
		</form>
<a href="member_menu.php">Back</a>

<!--STYLES STUFF START-->
</div>
		</div>
	</div>
<!--STYLES STUFF END-->

</body>
</html>
