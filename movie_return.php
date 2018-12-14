<html>
<head><title>Movie Return</title>
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
<!--STYLES STUFF END-->

<?php

//You need to add some security statements to make
//sure things only appear
session_start();
//echo "session started<br>";
if (!isset($_SESSION["memberid"]))
{
		header("Location: login_check.php");
}
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

    $name = $_SESSION["membername"];
	$id = $_SESSION["memberid"];

	echo '<div class="text-top">
		Hello, <span class="name-tag">' . $name;  
	echo '</span></div>';

	echo '<div class="main-section">
		<div class="modal-content">
			<h2>Movie Return</h2>';
	
	if(isset($_POST["selection"])){
	$sql = "select m.title from movie m, copy c where c.movieid=m.movieid and c.copyno='".$_POST["selection"]."';";
	$result = $conn->query($sql);
	if ($result->num_rows == 0)
	  echo "No results found." . "<br>";
	else
	{
		while($row = $result->fetch_assoc()) {
			$title = $row["title"];
		}
	}
	
	if(isset($_POST['return_submit'])){
		echo "Thanks for telling us you will be returning ". $title .". Please come to the store soon and return it.<br>";
		mysqli_query($conn,"UPDATE copy SET STAT = 'In-Store' WHERE copy.COPYNO = ". $_POST["selection"].";");
	}
	
	}
	
?>

<?php
	//form for selecting movie to return
	echo "";

	$sql = "select distinct TITLE, copy.COPYNO from invoice_transaction, copy, movie where MEMBERID = " . "\"".$id. "\" AND invoice_transaction.COPYNO=copy.COPYNO and copy.MOVIEID=movie.MOVIEID and copy.stat='Checkout';";

	$result = $conn->query($sql);
	if ($result->num_rows == 0)
	  echo "No results found." . "<br>";
	else
	{
		echo '<h4> Select a movie to return </h4>
		<div class="upper-names">';
		while($row = $result->fetch_assoc()) {
      $title = $row["TITLE"];
			echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"post\">";
			echo "<input type=\"radio\" name=\"selection\" value=";
			echo "\"" . $row["COPYNO"] . "\"";
			echo ">";
			echo implode(" | ", $row) . "<br><br>";//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
			echo "<button name=\"return_submit\" type=\"submit\" class=\"btn button\">Return</button>";
			echo "</form>";
		}
		echo '</div>';
}

if(isset($_POST['return_submit'])){
	/*echo "Thanks for telling us you will be returning ". $title .". Please come to the store soon and return it.<br>";
  mysqli_query($conn,"UPDATE copy SET STAT = 'In-Store' WHERE copy.COPYNO = ". $_POST["selection"].";");*/
  
  //get date rented out
  $sql = "SELECT max(stamp), amount, type, storeno, copyno, memberid
		FROM (
			SELECT max(stamp), stamp, amount, type, storeno, copyno, memberid
			FROM invoice_transaction
			WHERE type='Checkout' and MEMBERID='".$_SESSION["memberid"]."'
			GROUP BY copyno
			having min(stamp)=stamp) as ids
		ORDER BY COPYNO";
  $result = $conn->query($sql);
  
  if ($result->num_rows == 0)
	  echo "You have no rental on file for this movie." . "<br>";
	else
	{
		while($row = $result->fetch_assoc()) {
			$date_rented = $row["max(stamp)"];
			$amount = $row["amount"];
			$storeno = $row["storeno"];
			$copyno = $row["copyno"];
			$memberid = $row["memberid"];
			//echo("Rented on: ".$date_rented."<br>");
		}
  
  //get date returned
  $date_returned = date("Y-m-d h:i:sa");
  //echo "Returned on: ".$date_returned."<br>";
  
  
  
  //TODO: update the user's balance based on the days checked out
  $price_per_day = 1.75; //can change this as needed- get charge from store_charge table
  //new day starts at 8pm- count days it's been checked out
  $date1 = strtotime($date_returned);
  //echo $date1."<br>";
  $date2 = strtotime($date_rented);
  //echo $date2."<br>";
  $diff = $date1-$date2;
  //echo $diff."<br>";
  $diff_days = $diff/86400;//convert seconds to days
  //check if the last day was after 8 pm, if so, add one to day count
  function isAfter8pm($date) {
    return(stripos($date," 08:")&&stripos($date,"pm"));
}
  if(isAfter8pm($date_returned)){
	  $diff_days = $diff_days+1;
  }
  
  /*
  //10 percent discount on weekday rentals
  function isWeekend($date) {
    return (date('N', strtotime($date)) >= 6);
}
  if (isWeekend($date_rented)){
	  $fee = $price_per_day*(floor($diff_days));
  }
  else {
	  $fee = $price_per_day*(.9*floor($diff_days));
  }
  */
  
  //if a fee is due, create a fine transaction and add it to the member's balance
  if((floor($diff_days)-7)>0){
	$fee = $price_per_day*(floor($diff_days)-7);
	echo "The total amount owed for this rental is $".$fee.". <a href=\"movie_fines.php\"><button class=\"btn button\">Fines Due</button></a>";
	$sql = "update member set balance=balance+".$fee." where memberid='".$_SESSION["memberid"]."';";
    mysqli_query($conn,$sql);
	//create a fine entry for the returned item in invoice_transaction
    $sql = "insert into invoice_transaction(stamp,amount,type,storeno,copyno,memberid) values('"
		.$date_returned."','".$fee."','Fine',".$storeno."','".$copyno."','".$memberid."');";
    $result = $conn->query($sql);
  }
  else {
	 echo "No fee is due for this rental.";
	 //create a return entry in invoice_transaction
	 $sql = "insert into invoice_transaction(stamp,amount,type,storeno,copyno,memberid) values('"
		.$date_returned."','".'0'."','Return','".$storeno."','".$copyno."','".$memberid."');";
	//echo $sql;
    $result = $conn->query($sql);
  }
  
  
  mysqli_close($conn);

}
}
?>
<a href="member_menu.php">Back</a>
<!--STYLES STUFF START-->
</div>
		</div>
	</div>
<!--STYLES STUFF END-->

</body>
</html>
