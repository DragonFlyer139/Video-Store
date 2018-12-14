<html>
<head><title>Most Popular Movies Report</title></head>
<body><hr>
<h3>Top 10 Most Rented Movies This Year</h3>
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

	//get most rented movies from this year
	
    $sql = "select m.movieid, m.title, count(i.transaction_id)
			from movie m, invoice_transaction i, copy c
			where m.movieid=c.movieid and c.copyno=i.copyno
				and i.type='checkout' and i.stamp like '".date("Y")."%'
			group by m.movieid
			order by count(i.transaction_id) desc;";
	//echo $sql;
    $result = $conn->query($sql);
	
    if ($result->num_rows == 0) 
      echo "No results found." . "<br>";
    else
    {
		$count = 0;
		echo "<table style=\"width: 100%\">";
		echo "<th>Movie ID</th>
			  <th>Title</th>
			  <th>Number of Times Rented</th>";
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
	
?>
<br><a href="admin_menu.php">Back</a>
<hr>
</body>
</html>