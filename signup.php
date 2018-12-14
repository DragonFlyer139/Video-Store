<html>
<head><title>Sign Up Page</title>
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

<h3>Enter Account Information</h3>
<br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  First Name: <input type="text" name = "FirstName"><br>
  Last Name: <input type="text" name = "LastName"><br>
	Card Number/User ID: <input type="text" name = "UserName"><br>
	Password: <input type = "password" name = "Password"><br>
	Re-enter Password: <input type = "password" name = "Password2"><br>
	
	<input type = "Submit" value = "Sign Up">
</form>
<br>
<a href="member_login.php">Back to login page</a>

<?php

  session_start();
  if(isset($_POST["FirstName"]) || isset($_POST["LastName"]) || isset($_POST["UserName"]) || isset($_POST["Password"]) )
  {
  $sql = "INSERT INTO MEMBER (membername, memberid, password) values ('";
  $sql .= $_POST["FirstName"]." ".$_POST["LastName"]."','".$_POST["UserName"]."','".$_POST["Password"]."');";
  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "video_store";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) 
  {
    die("Connection failed: " . $conn->connect_error);
  }
  //echo "Connected successfully<br>";
  //echo $sql;
  $result = $conn->query($sql);
  //echo $result;
  if($result)
  {
    echo "<br>User created successfully";
    $_SESSION["membername"] = $_POST["FirstName"]." ".$_POST["LastName"];
  }
  else
    echo "<br>Failed to create user!";
  }
  
  
?>
<!--STYLES STUFF START-->
</div>
		</div>
	</div>
<!--STYLES STUFF END-->
</body>
</html>