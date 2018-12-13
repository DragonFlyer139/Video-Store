<html>
<head><title>Store Information Report</title></head>
<body><hr>
<h3>List of Stores</h3>
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

    $id = isset($_SESSION["memberid"]) ? $_SESSION["memberid"] : "ID NOT FOUND";
	
    $sql = "select * from store;";	
    $result = $conn->query($sql);
	
    if ($result->num_rows == 0) 
      echo "No results found." . "<br>";
    else
    {
		echo "<table style=\"width: 100%\">";
		echo "<th>Store Number</th>
			  <th>Address</th>
			  <th>Phone Number</th>";
		while($row = $result->fetch_assoc()) {
			echo "<tr><td>".implode("</td><td>", $row) . "</td><tr>";
			//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
		}
				echo "</table>";

    }
	
?>
<br><a href="admin_menu.php">Back</a>
<hr>
</body>
</html>