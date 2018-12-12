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
  echo "Connected successfully<br>";
  
  
  $id = isset($_POST["memberid"]) ? $_POST["memberid"] : "ID NOT FOUND";
	$_SESSION["memberid"] = $id;
	
	echo "ID NUMBER: " . $id . "<br>";
	
    $sql = "select membername from member where memberid='" . $id ."'";
	echo $sql . "<br>";
    $result = $conn->query($sql);
	
    if ($result->num_rows == 0) 
      header("Location: error.html");
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