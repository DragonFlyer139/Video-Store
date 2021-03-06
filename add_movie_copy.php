<html>
<head><title>Add Movie Copy | Video Store</title>
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
  session_start();
    if (!isset($_SESSION["adminid"]))
{
		header("Location: login_check_admin.php");
}
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
  //echo "Connected successfully<br>";
  
  $name = $_SESSION["adminname"];
  $id = $_SESSION["adminid"];
  echo '<div class="text-top">
		Hello, <span class="name-tag">' . $name;  
	echo '</span></div>';
?>

<div class="main-section">
			<div class="modal-content">
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

<h3>Add a copy of Existing Movie</h3>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<div class="input-group mb-3">
		<select class="custom-select" id="inputGroupSelect01">
			<option selected>Search by:</option>
			<option value="Category">Category</option>
			<option value="Title">Title</option>
			<option value="Director">Director</option>
		</select>
	</div>
	<div class="form-group">
		<input name="Search" type="text" placeholder="Search">
	</div>
	<button type="submit" value="Search" class="btn button">Search</button>
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
	
	


<h3>Add a copy of a New Movie</h3>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<div class="form-group">
    <input type="text" name = "Title" placeholder="Title">
    </div>
	<div class="form-group">
    <input type="text" name = "Director" placeholder="Director">
		</div>
	<div class="form-group">
    <input type="text" name = "Producer" placeholder="Producer">
		</div>
	<div class="form-group">
    <input type = "text" name = "Actor1" placeholder="Actor 1">
		</div>
	<div class="form-group">
    <input type = "text" name = "Actor2" placeholder="Actor 2">
		</div>
	<div class="form-group">
		<input type = "text" name = "Category" placeholder="Category">
	</div>
	<div class="input-group mb-3">
		<select name="Type" class="custom-select" id="inputGroupSelect01">
			<option selected>Copy Type:</option>	
			<option value="DVD">DVD</option>
			<option value="Blu-Ray">Blu-ray</option>
		</select>
	</div>
	<div class="form-group">
		<input type = "number" name = "Charge" step="0.01" placeholder="Daily Charge">
	</div>
	<button type = "Submit" value = "Create Copy" class="btn button">Submit</button>
</form>
<br>
<a href="admin_menu.php">Back</a>

<!--STYLES STUFF START-->
</div>
		</div>
	</div>
<!--STYLES STUFF END-->


</body>
</html>