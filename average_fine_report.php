<html>
<head><title>Average Fine Report</title></head>
<body><hr>
<h3>Average Fine Per User Report</h3>
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

	//choose the store
	$sql = "select * from member;";
	$result = $conn->query($sql);
	
	if ($result->num_rows == 0) 
      echo "No customers found." . "<br>";
    else
    {
		echo "<form action=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"post\">";
		echo "<select name=\"Memberid\">";
		while($row = $result->fetch_assoc()) {
			echo "<option value=\"".$row["memberid"]."\">".$row["membername"]."</option>";
			//echo implode(" | ", $row) . "<br><br>";//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
		}
		echo "<br><input type=\"submit\" value=\"Generate Report\">";
		echo "</select></form><br><br>";
    }
	
	//get average fines for that user
	if(isset($_POST["Memberid"])){
	$memberid = $_POST["Memberid"];
	
	
    $sql = "select m.memberid, m.membername, avg(i.amount)
			from member m, invoice_transaction i
			where m.memberid=i.memberid and m.memberid='".$memberid."'
			group by m.memberid, i.type
            having i.type='fine'
			order by count(i.transaction_id) desc;";
	//echo $sql;
    $result = $conn->query($sql);
	
    if ($result->num_rows == 0) 
      echo "No fines found for that user.<br>";
    else
    {
		$count = 0;
		while($row = $result->fetch_assoc() and $count<10) {
			echo "Average fine for ".$row["membername"]." is $".$row["avg(i.amount)"].".";
			//echo implode(" | ", $row) . "<br><br>";//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
			$count = $count+1;
		}
    }
	}
?>
<br><a href="admin_menu.php">Back</a>
<hr>
</body>
</html>