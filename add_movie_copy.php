<html>
<head><title>Add Movie Copy</title></head>
<body>
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
  
  $name = $_SESSION["adminname"];
  $id = $_SESSION["adminid"];
  echo "Hey there " . $name."<br>";
?>

<?php

	//if a copy has been created from an existing movie, put the copy in COPY and the daily price in STORE_CHARGE
	if(isset($_POST["movieid"])){
		$sql = "insert into copy(type,stat,movieid) values('".$_POST["Type"]."','In-Store','".$_POST["movieid"]."');";
		$result = $conn->query($sql);
		if ($result) 
			echo "Successfully added copy.<br>";
		//get copyno for the copy you just inserted
		$copyno = 0;
		$sql = "select * from copy where type='".$_POST["Type"]."' and movieid='".$_POST["movieid"]."');";
		$sql = "select max(copyno), type, copyno, movieid
				from (
					select max(copyno), type, copyno, movieid
					from copy
					where type='".$_POST["Type"]."' and movieid='".$_POST["movieid"]."'
					group by copyno
					having max(copyno)=copyno) as ids
				order by copyno desc";
		$result = $conn->query($sql);
		if ($result->num_rows == 0) 
			echo "Copy not found." . "<br>";
		else{
		while($row = $result->fetch_assoc()) {
			$copyno = isset($row["copyno"]) ? $row["copyno"] : 'NO_COPYNO_SET';
		}
		}
		$sql = "insert into store_charge(dailycharge,copyno) values('".$_POST["Charge"]."','".$copyno."');";
		$result = $conn->query($sql);
		if ($result) 
			echo "Successfully added rental fee amount.<br>";
		//echo $copyno;
		//echo $sql;
	}
	//if a copy has been created from a new movie, put the movie in MOVIE and the copy in COPY and the daily price in STORE_CHARGE
	else if(isset($_POST["Title"]) && isset($_POST["Director"]) && isset($_POST["Producer"]) &&
		isset($_POST["Actor1"]) && isset($_POST["Actor2"]) && isset($_POST["Category"])){
		$sql = "insert into movie(title,director,producer,actor1,actor2,category) 
			values('".$_POST["Title"]."','".$_POST["Director"]."','".$_POST["Producer"]."','"
			.$_POST["Actor1"]."','".$_POST["Actor2"]."','".$_POST["Category"]."');";
		$result = $conn->query($sql);
		if ($result) 
			echo "Successfully added movie.<br>";
		
		//get movieid
		$movieid = 0;
		//$sql = "select * from movie where title='".$_POST["Title"]."' and movieid='".$_POST["movieid"]."');";
		$sql = "select max(movieid), movieid, title
				from (
					select max(movieid), movieid, title
					from movie
					where title='".$_POST["Title"]."' and director='".$_POST["Director"]."'
						and producer='".$_POST["Producer"]."' and actor1='".$_POST["Actor1"]."' 
						and actor2='".$_POST["Actor2"]."' and category='".$_POST["Category"]."'
					group by movieid
					having max(movieid)=movieid) as ids
				order by movieid desc";
		$result = $conn->query($sql);
		if ($result->num_rows == 0) 
			echo "Movie not found." . "<br>";
		else{
		while($row = $result->fetch_assoc()) {
			$movieid = isset($row["movieid"]) ? $row["movieid"] : 'NO_MOVIEID_SET';
		}
		}
		
		//insert copy
		$sql = "insert into copy(type,stat,movieid) values('".$_POST["Type"]."','In-Store','".$movieid."');";
		$result = $conn->query($sql);
		if ($result) 
			echo "Successfully added copy.<br>";
		
		//get copyno for the copy you just inserted
		$copyno = 0;
		$sql = "select * from copy where type='".$_POST["Type"]."' and movieid='".$movieid."');";
		$sql = "select max(copyno), type, copyno, movieid
				from (
					select max(copyno), type, copyno, movieid
					from copy
					where type='".$_POST["Type"]."' and movieid='".$movieid."'
					group by copyno
					having max(copyno)=copyno) as ids
				order by copyno desc";
		$result = $conn->query($sql);
		if ($result->num_rows == 0) 
			echo "Copy not found." . "<br>";
		else{
		while($row = $result->fetch_assoc()) {
			$copyno = isset($row["copyno"]) ? $row["copyno"] : 'NO_COPYNO_SET';
		}
		}
		$sql = "insert into store_charge(dailycharge,copyno) values('".$_POST["Charge"]."','".$copyno."');";
		$result = $conn->query($sql);
		if ($result) 
			echo "Successfully added rental fee amount.<br>";
}
?>

<h3>Add a Copy of an Existing Movie</h3>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	Search by: <select name="Search_by">
		<option value="Category">Category</option>
		<option value="Title">Title</option>
		<option value="Director">Director</option>
	</select>
	<br>
	Search: <input name="Search" type="text">
	<input type="submit" value="Search"><br>
	</form> 
	
	<?php
	//display movies if a search has been entered
	if(isset($_POST["Search_by"]) && isset($_POST["Search"])){
	$sql = "select * from movie where " . $_POST["Search_by"] . " LIKE " . "\"%".$_POST["Search"]. "%\";";
    $result = $conn->query($sql);
	
    if ($result->num_rows == 0) 
      echo "No results found." . "<br>";
    else
    {
		echo "<form action=\"".htmlspecialchars($_SERVER["PHP_SELF"])."\" method=\"post\">";
		while($row = $result->fetch_assoc()) {
			$movieid = isset($row["movieid"]) ? $row["movieid"] : 'NO_ID_SET';
			echo "<input type=\"radio\" name=\"movieid\" value=\"".$movieid."\">";
			echo implode(" | ", $row) . "<br><br>";
			//. " - Title: " . $row["title"]. " ";
			//echo " - Director: " . $row["director"] . " - Producer: " . $row["producer"];
			//echo " - Actor1: " . $row["actor1"] . " - Actor2: " . $row["actor2"];
			//echo " - Category: " . $row["category"];
			echo "<br>";
		}
		echo "Copy Type: <select name=\"Type\">
				<option value=\"DVD\">DVD</option>
				<option value=\"Blu-Ray\">Blu-ray</option>
			   </select><br>";
		echo "Daily Charge: <input type = \"number\" name = \"Charge\" step=\"0.01\"><br>";
		echo "<input type=\"submit\" value=\"Create Copy\"><br>";
		echo "</form>";
    }
	}

	?>
	
	


<h3>Add a Copy of a New Movie</h3>
<br>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    Title: <input type="text" name = "Title"><br>
    Director: <input type="text" name = "Director"><br>
	Producer: <input type="text" name = "Producer"><br>
	Actor1: <input type = "text" name = "Actor1"><br>
	Actor2: <input type = "text" name = "Actor2"><br>
	Category: <input type = "text" name = "Category"><br>
	Copy Type: <select name="Type">
				<option value="DVD">DVD</option>
				<option value="Blu-Ray">Blu-ray</option>
			   </select><br>
	Daily Charge: <input type = "number" name = "Charge" step="0.01"><br>
	<input type = "Submit" value = "Create Copy">
</form>
<br>
<a href="admin_menu.php">Back</a>


</body>
</html>