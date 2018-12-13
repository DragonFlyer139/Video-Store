<html>
<head></head>
<body><hr>

<?php

  session_start();
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
  
  
    $id = isset($_POST["memberid"]) ? $_POST["memberid"] : "ID NOT FOUND";
	$password = isset($_POST["password"]) ? $_POST["password"] : "PASSWORD NOT FOUND";
	
	$_SESSION["memberid"] = $id;
	
	
    $sql = "select membername from member where memberid='" . $id ."'";
	$sql .= " and " . "password='" . $password . "';";
    $result = $conn->query($sql);
	
	
    if (null == $result or $result->num_rows == 0){
		echo "Card number and/or password incorrect. Please go back and try again." . "<br>";
		echo "<a href=\"member_login.php\">Member Login</a>";
	}
    else
    {
      $row = $result->fetch_assoc();
      $name = $row["membername"];
      $_SESSION["membername"] = $name;
      header("Location: member_menu.php");
    }
 
  
?>

<hr>
</body>
</html>