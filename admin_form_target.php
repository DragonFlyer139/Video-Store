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
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    //echo "Connected successfully<br>";

    $id = isset($_POST["Username"]) ? $_POST["Username"] : "ID NOT FOUND";
	$_SESSION["adminid"] = $id;
	echo "ID NUMBER: ".$id."<br>";
	$password = isset($_POST["Password"]) ? $_POST["Password"] : "PASSWORD NOT FOUND";
	
    $sql = "select name from employee where employeeid='" . $id ."' and password = '" . $password . "'";
    //echo($sql);
    $result = $conn->query($sql);
    
    if ($result->num_rows == 0) 
      header("Location: error.html");
    else
    {
      $row = $result->fetch_assoc();
      $name = $row["name"];
      $_SESSION["adminname"] = $name;
      header("Location: admin_menu.php");
    }
?>
<hr>
</body>
</html>