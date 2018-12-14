<html>
<head><title>Average Fine Report</title>
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
<body><hr>


<!--STYLES STUFF START-->
<div class="modal-dialog text-center">
		<div class="main-section">
			<div class="modal-content">
<!--STYLES STUFF END-->

<h3>Average Fine Per User Report</h3>
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



<!--STYLES STUFF START-->
</div>
		</div>
	</div>
<!--STYLES STUFF END-->
<hr>
</body>
</html>