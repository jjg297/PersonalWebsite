<?php
	session_start();
	// Setup connection
	$db = mysqli_connect("tund.cefns.nau.edu", "jjg297", "xbcEPfAfFBhpxPUL", "jjg297");
	$user = $_SESSION['user'];
	// Get count of messages for the user
	$query = "SELECT COUNT(*) FROM messages WHERE receiver='$user'";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_row($result);
    $num = $row[0];
	
	echo "<body style='background-color:#F4A460'><h1>You have $num messages, $user.</h1><hr>";
	echo "<a href='home.php'>Return to Home</a><br><a href='message.php'>Create Message</a><br>";
	if($num != 0){
		// Display messages
		$connection = @mysqli_query($db, "SELECT * FROM messages WHERE receiver='$user'");
    // If the query executed properly proceed
		if($connection){

			echo '<body style="background-color:#F4A460"><table align="left"
			cellspacing="3" cellpadding="5">

			<tr><td align="left"><b>From</b></td>
			<td align="left"><b>Subject</b></td>
			<td align="left"><b>Message</b></td></tr>';

			// mysqli_fetch_array will return a row of data from the query
			// until no further data is available
			while($entry = mysqli_fetch_array($connection)){
				if($entry['flagType'] == 0){
					echo '<tr><td bgcolor=#FF0000 align="left">' . 
					$entry['sender'] . '</td><td bgcolor=#FF0000 align="left">' .
					$entry['subject'] . '</td><td bgcolor=#FF0000 align="left">' .		
					$entry['message'] . '</td><td bgcolor=#FF0000 align="left">';
					
					echo '</tr>';
				} else {
					echo '<tr><td align="left">' . 
					$entry['sender'] . '</td><td align="left">' .
					$entry['subject'] . '</td><td align="left">' .		
					$entry['message'] . '</td><td align="left">';

					echo '</tr>';
				}
				
			}
		echo '</table>';
		$update = "UPDATE messages SET flagType='1'";
		mysqli_query($db, $update);
		}
	} else {
		// Do nothing.
		echo "<h3> You have no messages. </h3>";
	}
	
	
?>
	
<html>
	<head>
		<title>
			Project 8 Inbox
		</title>
		<meta NAME= "AUTHOR" CONTENT= "Jesus Garcia - CS212" >
		<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
</html>