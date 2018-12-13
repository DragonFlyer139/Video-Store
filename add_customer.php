<html>
<head><title>Add Customer</title></head>
<body>

<h3>Enter Customer Information</h3>
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
Customers can also create their own account <a href="signup.php">here</a>.<br>

<?php

  session_start();
  if(isset($_POST["FirstName"]) || isset($_POST["LastName"]) || isset($_POST["UserName"]) || isset($_POST["Password"]) )
  {
  $sql = "insert into member (membername, memberid, password) values ('";
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
    //$_SESSION["membername"] = $_POST["FirstName"]." ".$_POST["LastName"];
  }
  else
    echo "<br>Failed to create user!";
  }
  
  
?>
</body>
</html>