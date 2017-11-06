<?php
	session_start();

	// Check for when login button is pressed
	if (isset($_POST['login_button'])){
		if (isset($_SESSION['message'])){
			echo "<div id=error>".$_SESSION['message']."</div>";
			unset($_SESSION['message']);
		}
		// Connect to database and setup variables
		$db = mysqli_connect("tund.cefns.nau.edu", "jjg297", "xbcEPfAfFBhpxPUL", "jjg297");
		$user = $_POST['user'];
		$password = $_POST['password'];
		$date = date("Y-m-d H:i:s");
		
		// Send a request to add data to the 'log' table in database
		$sql = "SELECT * FROM users WHERE user='$user' AND password='$password'";
		$result = mysqli_query($db, $sql);
		
		// Login and update SESSION
		if(mysqli_num_rows($result) == 1){
			$_SESSION['message'] = "You are logged in.";
			$_SESSION['user'] = $user;
			$_SESSION['password'] = $password;
			$sqllog = "INSERT INTO log(action, date, user) VALUES('login_success', '$date', '$user')";
			mysqli_query($db, $sqllog);
			$_SESSION['message'] = "Password changed.";
			header("location: home.php"); // Redirect to home
		} else {
			// If login doesn't match up, log it and don't allowed access
			$sqllog = "INSERT INTO log(action, date, user) VALUES('login_failed', '$date', '$user')";
			mysqli_query($db, $sqllog);
			$_SESSION['message'] = "Your username or password is incorrect";
		}
	}
?>
	
<html>
	<head>
		<title>
			Project 7 Login
		</title>
	<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body style="background-color:#F4A460">
		<div class="header">
			<h1> Login </h1><hr>
		</div>
	
		<form method="post" action="login.php">
			<table>
				<tr>
					<td> Username: </td>
					<td><input type="text" name="user" class="textInput"></td>
				</tr>
				<tr>
					<td> Password: </td>
					<td><input type="password" name="password" class="textInput"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="login_button" value="Login"></td>
				</tr>
			</table>
		</form>
	</body>
</html>