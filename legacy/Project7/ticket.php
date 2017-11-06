<?php
	session_start();
	// Setup connection
	$db = mysqli_connect("tund.cefns.nau.edu", "jjg297", "xbcEPfAfFBhpxPUL", "jjg297");
	$user = $_SESSION['user'];
	
	if(isset($_POST['send_button'])){
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$date = date("Y-m-d H:i:s");
		$query = "INSERT INTO tickets(sentfrom, subject, message, flagType) VALUES('$user', '$subject', '$message', '2')";
		$_SESSION['message'] = "You have submitted a ticket.";
		$sqllog = "INSERT INTO log(action, date, user) VALUES('ticket_sent_in', '$date', '$user')";
		mysqli_query($db, $query);
		mysqli_query($db, $sqllog);
		header("location: home.php");
	}
	
?>
	
<html>
	<head>
		<title>
			Project 8 Ticket
		</title>
	<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body style="background-color:#F4A460">
		<div class="header">
			<h1> Send Ticket </h1><hr>
		</div>
		
		<?php
			$db = mysqli_connect("tund.cefns.nau.edu", "jjg297", "xbcEPfAfFBhpxPUL", "jjg297");
			$user = $_SESSION['user'];
			
			$check = "SELECT COUNT(*) FROM tickets WHERE sentfrom='$user'";
			$result = mysqli_query($db, $check);
			$row = mysqli_fetch_row($result);
			$num = $row[0];
			
			if($num != 0){
				// Display messages
				$connection = @mysqli_query($db, "SELECT * FROM tickets WHERE sentfrom='$user'");
				// If the query executed properly proceed
				if($connection){

					echo '<body style="background-color:#F4A460">Statuses -> 2 = open, 3 = closed<br><table align="left"
					cellspacing="3" cellpadding="5">

					<tr><td align="left"><b>Subject</b></td>
					<td align="left"><b>Message</b></td>
					<td align="left"><b>Status</b></td></tr>';

					// mysqli_fetch_array will return a row of data from the query
					// until no further data is available
					while($entry = mysqli_fetch_array($connection)){
						if($entry['flagType'] == 2){
							echo '<tr><td bgcolor=#00FF00 align="left">' . 
							$entry['subject'] . '</td><td bgcolor=#00FF00 align="left">' .
							$entry['message'] . '</td><td bgcolor=#00FF00 align="left">' .		
							$entry['flagType'];
							
							echo '</tr>';
						} else{
							echo '<tr><td bgcolor=#FF0000 align="left">' . 
							$entry['subject'] . '</td><td bgcolor=#FF0000 align="left">' .
							$entry['message'] . '</td><td bgcolor=#FF0000 align="left">' .		
							$entry['flagType'];
							
							echo '</tr>';
						}
					}
				echo '</table>';
				}
			} else {
				// Do nothing.
				echo "<h3> You have no tickets. </h3>";
			}
		?>
	
		<form method="post" action="ticket.php">
			<table><br><br><br><br><br><br><br><br><br>
				<tr>
					<td> Subject: </td>
					<td><input type="text" name="subject" class="textInput"></td>
				</tr>
				<tr>
					<td> Message: </td>
					<td><textarea name='message' rows='5' cols='40'></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="send_button" value="Send Ticket"></td>
				</tr>
			</table>
			<a href='home.php'>Return to Home</a>
		</form>
	</body>
</html>