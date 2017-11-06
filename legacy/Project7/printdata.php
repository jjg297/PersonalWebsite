<?php

	// Create a query for the database


	// Get a response from the database by sending the connection
	// and the query
	$db = mysqli_connect("tund.cefns.nau.edu", "jjg297", "xbcEPfAfFBhpxPUL", "jjg297");
	$query = "SELECT user, email FROM users";
	$connection = @mysqli_query($db, $query);
	echo "<h1>Table data</h1><hr>";
	echo "<a href='home.php'>Return to Home</a><br>";

	// If the query executed properly proceed
	if($connection){

		echo '<body style="background-color:#F4A460"><table align="left"
		cellspacing="3" cellpadding="5">

		<tr><td align="left"><b>Username</b></td>
		<td align="left"><b>Email</b></td></tr>';

		// mysqli_fetch_array will return a row of data from the query
		// until no further data is available
		while($entry = mysqli_fetch_array($connection)){

		echo '<tr><td align="left">' . 
		$entry['user'] . '</td><td align="left">' . 
		$entry['email'] . '</td><td align="left">';

		echo '</tr>';
		}
	echo '</table>';
	}
?>

<html>
	<head>
		<title>
			Project 7 Data Table
		</title>
		<meta NAME= "AUTHOR" CONTENT= "Jesus Garcia - CS212" >
		<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
</html>