<html>
<head><title>Most Frequent Renters Report</title></head>
<body><hr>
<h3>Top 10 Most Frequent Renters</h3>
<?php 
session_start();
$servername = "localhost";
   if (!isset($_SESSION["adminid"]))
{
		header("Location: login_check_admin.php");
}
    $username = "root";
    $password = "";
    $dbname = "video_store"; 

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

	$sql = "select * from store;";
	$result = $conn->query($sql);
	
	if ($result->num_rows == 0) 
      echo "No stores found." . "<br>";
    else
    {
		echo "<form action=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"post\">";
		echo "<select name=\"Storeno\">";
		while($row = $result->fetch_assoc()) {
			echo "<option value=\"".$row["storeno"]."\">".$row["saddress"]."</option>";
			//echo implode(" | ", $row) . "<br><br>";//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
		}
		echo "<br><input type=\"submit\" value=\"Generate Report\">";
		echo "</select></form><br><br>";
    }
	
	
	if(isset($_POST["Storeno"])){
	$storeno = $_POST["Storeno"];
	//echo $storeno;
    $sql = "select i.memberid, m.membername, count(i.transaction_id)
			from member m, invoice_transaction i
			where m.memberid=i.memberid and i.type='checkout' and i.storeno='".$storeno."'
			group by i.memberid
			order by count(i.transaction_id) desc;";
	//echo $sql;
    $result = $conn->query($sql);
	
    if ($result->num_rows == 0) 
      echo "No results found." . "<br>";
    else
    {
		$count = 0;
		echo "<table style=\"width: 100%\">";
		echo "<th>MemberID</th>
			  <th>Name</th>
			  <th>Movies Rented</th>";
		while($row = $result->fetch_assoc() and $count<10) {
			echo "<tr><td>".implode("</td><td>", $row) . "</td><tr>";
			//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
			$count = $count+1;
		}
				echo "</table>";

    }
	}
?>
<br><a href="admin_menu.php">Back</a>
<hr>
</body>
</html>