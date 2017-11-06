<?php
	// Setup variables and connect to database
	$user = $_SESSION['user'];
	$db = mysqli_connect("tund.cefns.nau.edu", "jjg297", "xbcEPfAfFBhpxPUL", "jjg297");
	$date = date("Y-m-d H:i:s");
	$sqllog = "INSERT INTO log(action, date, user) VALUES('logout', '$date', '$user')";
	mysqli_query($db, $sqllog);
	session_destroy();
	session_start();
	
	// Unlink Session
	unset($_SESSION['user']);
	unset($_SESSION['password']);
	
	header("location: home.php"); // Return to home screen
?>