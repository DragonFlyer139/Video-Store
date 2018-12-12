<html>
<head><title>Sign Up Page</title></head>
<body>

<h3>Enter Account Information</h3>
<br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  First Name: <input type="text" name = "FirstName"><br>
  Last Name: <input type="text" name = "LastName"><br>
	Username: <input type="text" name = "UserName"><br>
	Password: <input type = "password" name = "Password"><br>
	Re-enter Password: <input type = "password" name = "Password2"><br>
	
	<input type = "Submit" value = "Sign Up">
</form>
<br>
Don't have an account? Sign up <a href="signup.php">here</a>

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
  echo "Connected successfully<br>";
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
</body>
</html>