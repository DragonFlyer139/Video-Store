<html>
<head><title>Member Homepage</title>
<!--STYLES STUFF START-->
<meta charset = "UTF-8">
	<meta keyword name = "viewport" content = "width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="img/icon.png">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles/main.css">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
	
<?php
	session_start();
	//check to make sure someone is logged in
	if (isset($_SESSION["memberid"])) {
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

		echo '<div class="modal-dialog text-center">
			<div class="text-top">
				Hello, <span class="name-tag">' . $name .	
			'</span></div>
			<div class="main-section">
				<div class="modal-content">
					<h2>Member Menu</h2>
					<div class="menu">
						<a href="movie_search.php"><div class="menu-item" >Movie Search</div></a>
						<a href="movie_checkout.php"><div class="menu-item" >Movie Checkout</div></a>
						<a href="movie_return.php"><div class="menu-item" >Movie Return</div></a>
						<a href="movie_reserve.php"><div class="menu-item" >Movie Reserve</div></a>
						<a href="movie_fines.php"><div class="menu-item" >Movie Fines</div></a>
						<a href="movie_reservesearch.php"><div class="menu-item" >Reserved Movies</div></a>
						<a href="quit.php"><div class="menu-item quit" >Log Out</div></a>
					</div>
				</div>
			</div>';
			}
			//if no one is logged in
			else
			{
				echo '<div class="main-section">
					<div class="modal-content">
						You are not logged in. 
						<div class="menu">
							<a href="member_login.php"><div class="menu-item quit" >Login</div></a>
							<a href="signup.php"><div class="menu-item loud" >Sign Up</div></a>
							<a href="index.php"><div class="menu-item">Return Home</div></a>
						</div>
					</div>
				</div>';
			}
	?>
			</div>
</body>
</html>
