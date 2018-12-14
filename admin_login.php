<html>
<head>
	<title>Admin Login | Video Store</title>
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
	<div class="modal-dialog text-center">
		<div class="main-section">
			<div class="modal-content">
				<h2>Admin Login</h2>
				<!-- <h5>Enter Login Information</h5> -->
				<form action="admin_form_target.php" method="post">
					<div class="form-group">
						<input type="text" name = "Username" placeholder="Username"><br>
					</div>
					<div class="form-group">
						<input type = "password" name = "Password" placeholder="Password"><br>
					</div>
					<button type = "Submit" value = "Login" class="btn">LOGIN</button>
				</form>
				<div class="quiet-link">
					<a href="member_login.php">Member Login</a>
				</div>
			</div>
		</div>
	</div>
</body>
</html>