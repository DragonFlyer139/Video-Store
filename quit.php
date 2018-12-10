<html>
<head><title>Video Store Software</title></head>
<body>

<h3>Quit</h3>
<p>
Apparently you decided to exit the program.
</p>
<?php
	session_start();
	session_unset();
	session_destroy();
?>

</body>
</html>