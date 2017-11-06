<?php
	session_start();
	// Setup connection
	$db = mysqli_connect("tund.cefns.nau.edu", "jjg297", "xbcEPfAfFBhpxPUL", "jjg297");
	$user = $_SESSION['user'];
	if(isset($_POST['send_button'])){
		$sendto = $_POST['sendto'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$date = date("Y-m-d H:i:s");
		$query = "INSERT INTO messages(receiver, sender, subject, message, flagType) VALUES('$sendto', '$user', '$subject', '$message', '0')";
		$_SESSION['message'] = "You have sent a message to $sendto";
		$sqllog = "INSERT INTO log(action, date, user) VALUES('msg_to_$sendto', '$date', '$user')";
		mysqli_query($db, $query);
		mysqli_query($db, $sqllog);
		header("location: home.php");
	}
	
?>
	
<html>
	<head>
		<title>
			Project 8 Message
		</title>
	<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body style="background-color:#F4A460">
		<div class="header">
			<h1> Message </h1><hr>
		</div>
	
		<form method="post" action="message.php">
			<table>
				<tr>
					<td> To: </td>
					<td><input type="text" name="sendto" class="textInput"></td>
				</tr>
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
					<td><input type="submit" name="send_button" value="Send Message"></td>
				</tr>
			</table>
		</form>
	</body>
</html>