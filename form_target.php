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

    $uname = isset($_GET["Username"]) ? $_GET["Username"] : "";
	  $password = isset($_GET["Password"]) ? $_GET["Password"] : "";
	
    $sql = "select fname, lname from user where username='" . $uname ."'";
    $sql .= " and password = '" . $password . "'";
    //echo($sql);
    $result = $conn->query($sql);
    
    if ($result->num_rows == 0) 
      header("Location: error.html");
    else
    {
      $row = $result->fetch_assoc();
      $fname = $row["fname"];
      $lname = $row["lname"];
      $_SESSION["FirstName"] = $fname;
      $_SESSION["LastName"] = $lname;
      header("Location: menu.php");
    }
?>
<hr>
</body>
</html>