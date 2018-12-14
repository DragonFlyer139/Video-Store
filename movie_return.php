<html>
<head></head>
<body>
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

	echo "Hey there " . $name;

	echo "<h3>Movie Return</h3>";
?>

<hr>
<?php

	echo "<h3> Select Movie to Return </h3>";

	$sql = "select distinct TITLE, copy.COPYNO from invoice_transaction, copy, movie where MEMBERID = " . "\"".$id. "\" AND invoice_transaction.COPYNO=copy.COPYNO and copy.MOVIEID=movie.MOVIEID and copy.stat='Checkout';";

	$result = $conn->query($sql);
	if ($result->num_rows == 0)
	  echo "No results found." . "<br>";
	else
	{
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
			echo "<input name=\"return_submit\" type=\"submit\">";
			echo "</form>";
		}
}

if(isset($_POST['return_submit'])){
	echo "Thanks for telling us you will be returning ". $title .". Please come to the store soon and return it.<br>";
  mysqli_query($conn,"UPDATE copy SET STAT = 'In-Store' WHERE copy.COPYNO = ". $_POST["selection"].";");
  
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
  
  //TODO: create a fine entry for the returned item in invoice_transaction
  $sql = "insert into invoice_transaction(stamp,amount,type,storeno,copyno,memberid) values('"
  .$date_returned."','".$amount."','Fine',".$storeno."','".$copyno."','".$memberid."');";
  $result = $conn->query($sql);
  
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
  
  
  //10 percent discount on weekday rentals
  function isWeekend($date) {
    return (date('N', strtotime($date)) >= 6);
}
  if (isWeekend($date_rented)){
	  $fee = $price_per_day*(1+floor($diff_days));
  }
  else {
	  $fee = $price_per_day*(1+.9*floor($diff_days));
  }
  
  echo "The total amount owed for this rental is $".$fee.". See your <a href=\"movie_fines.php\">fines</a> page for your updated balance due.";
  
  $sql = "update member set balance=balance+".$fee." where memberid='".$_SESSION["memberid"]."';";
  mysqli_query($conn,$sql);
  
  mysqli_close($conn);

}
}
?>
<a href="member_menu.php">Back</a>
</body>
</html>
