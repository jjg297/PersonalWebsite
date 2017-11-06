<?php
	session_start();
	
	// Connect to database, setup variables
	$db = mysqli_connect("tund.cefns.nau.edu", "jjg297", "xbcEPfAfFBhpxPUL", "jjg297");
	$user = $_SESSION['user'];
	$date = date("Y-m-d H:i:s");
	
	// Check is change data button is pressed
	if (isset($_POST['change_button'])){
		if (isset($_SESSION['message'])){
			echo "<div id=error>".$_SESSION['message']."</div>";
			unset($_SESSION['message']);
		}
		$oldpassword = $_SESSION['password'];
		// Check if passwords match, and log activity
		if (($_POST['oldpass'] == $_POST['c_oldpass']) && ($_POST['oldpass'] == $oldpassword)){
			$sql = "UPDATE users SET password='".$_POST['newpass']."' WHERE user='".$_SESSION['user']."'";
			mysqli_query($db, $sql);
			$sqllog = "INSERT INTO log(action, date, user) VALUES('change_login_data', '$date', '".$_SESSION['user']."')";
			mysqli_query($db, $sqllog);
			$_SESSION['password'] = $_POST['newpass'];
			header("location: home.php"); // Redirect to home
		} else {
			// Log an error of passwords matching
			$sqllog = "INSERT INTO log(action, date, user) VALUES('change_data_failed', '$date', '$user')";
			mysqli_query($db, $sqllog);
			$_SESSION['message'] = "Error: Old password is incorrect or passwords dont match";
		}
		// This will check if the Delete User button is pressed
		// As the button suggests, this will delete the logged in user from database.
	} else if (isset($_POST['delete_button'])){
		$sql = "DELETE FROM users WHERE user='$user'";
		mysqli_query($db, $sql);
		$sqllog = "INSERT INTO log(action, date, user) VALUES('user_self_delete', '$date', '$user')";
		mysqli_query($db, $sqllog);
		header("location: home.php");
		session_destroy();
		session_start();
	}
?>
	
<html>
	<head>
		<title>
			Project 7 Change Data
		</title>
	<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body style="background-color:#F4A460">
		<div class="header">
			<h1> Change user data </h1><hr>
		</div>
	
		<form method="post" action="changedata.php">
			<table>
				<tr>
					<td> New password: </td>
					<td><input type="text" name="newpass" class="textInput"></td>
				</tr>
				<!-- This WAS to change emails, removed for simplicity sake<tr>
					<td> New email: </td>
					<td><input type="text" name="newemail" class="textInput"></td>
				</tr> -->
				<tr>
					<td> Old Password: </td>
					<td><input type="password" name="oldpass" class="textInput"></td>
				</tr>
				<tr>
					<td> Confirm Old Password: </td>
					<td><input type="password" name="c_oldpass" class="textInput"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="change_button" value="Save"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="delete_button" value="Delete user?"></td>
				</tr>
			</table>
		</form>
	</body>
</html>