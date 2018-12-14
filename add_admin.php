<html>
<head><title>Add Admin</title>
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

<h3>Enter New Admin Information</h3>
<br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  First Name: <input type="text" name = "FirstName"><br>
  Last Name: <input type="text" name = "LastName"><br>
  Address: <input type="text" name = "Address"><br>
  Phone Number: <input type="text" name = "Phone"><br>
	Password: <input type = "password" name = "Password"><br>
	Re-enter Password: <input type = "password" name = "Password2"><br>
	
	<button type = "Submit" value = "Add User" class="btn">ADD USER</button>
</form>
<br>

<?php

  session_start();
  if (!isset($_SESSION["adminid"]))
{
		header("Location: login_check_admin.php");
}
  if(isset($_POST["FirstName"]) && isset($_POST["LastName"]) && isset($_POST["Address"]) && 
	isset($_POST["Phone"]) && isset($_POST["Password"]) && isset($_POST["Password2"]))
  {
  $sql = "insert into employee (name, address, phone, password) values ('";
  $sql .= $_POST["FirstName"]." ".$_POST["LastName"]."','".$_POST["Address"]."','".$_POST["Phone"]."','".$_POST["Password"]."');";
  
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
  }
  else
    echo "<br>Failed to create user!";
  
  
  //get adminid and echo it
		$employeeid = 0;
		//$sql = "select * from movie where title='".$_POST["Title"]."' and employeeid='".$_POST["employeeid"]."');";
		$sql = "select max(employeeid), employeeid, name
				from (
					select max(employeeid), employeeid, name
					from employee
					where name='".$_POST["FirstName"]." ".$_POST["LastName"]."' and address='".$_POST["Address"]."'
						and phone='".$_POST["Phone"]."' and password='".$_POST["Password"]."'
					group by employeeid
					having max(employeeid)=employeeid) as ids
				order by employeeid desc";
		$result = $conn->query($sql);
		if ($result->num_rows == 0) 
			echo "Admin not found." . "<br>";
		else{
		while($row = $result->fetch_assoc()) {
			$employeeid = isset($row["employeeid"]) ? $row["employeeid"] : 'NO_ADMINID_SET';
		}
		}
	echo "<br>Admin ID: ".$employeeid."<br>Employee Name: ".$_POST["FirstName"]." ".$_POST["LastName"];
  }
?>
<a href="admin_menu.php">Back</a>

<!--STYLES STUFF START-->
</div>
		</div>
	</div>
<!--STYLES STUFF END-->

</body>
</html>