<?php
	session_start();
	
	// Connect to database
	$db = mysqli_connect("tund.cefns.nau.edu", "jjg297", "xbcEPfAfFBhpxPUL", "jjg297");

	// Check is button is pressed
	if (isset($_POST['button'])){
		$user = $_POST['user'];
		$email = $_POST['email'];
		$date = date("Y-m-d H:i:s");
		$password = $_POST['password'];
		$password_confirm = $_POST['password_confirm'];
		
		// Check if password is entered TWICE
		if ($password == $password_confirm){
			// Create User into database
			$_SESSION['user'] = $user;
			$sql = "INSERT INTO users(user, email, password) VALUES('$user', '$email', '$password')";
			$sqllog = "INSERT INTO log(action, date, user) VALUES('create_user', '$date', '$user')";
			mysqli_query($db, $sql);
			mysqli_query($db, $sqllog);
			$_SESSION['message'] = "You have logged in!";
			header("location: home.php"); // Redirect to homepage
		} else {
			// Failed to enter matching passwords, dont allow creation
			$_SESSION['message'] = "Passwords dont match!";
		}
	}
?>
	
<html>
	<head>
		<title>
			Project 7 Register
		</title>
	<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body style="background-color:#F4A460">
		<div class="header">
			<h1> Register </h1><hr>
		</div>
		
		<?php 
			if (isset($_SESSION['message'])){
				echo "<div id=error>".$_SESSION['message']."</div>";
				unset($_SESSION['message']);
			}
		?>
	
		<form method="post" action="register.php">
			<table>
				<tr>
					<td> Username: </td>
					<td><input type="text" name="user" class="textInput"></td>
				</tr>
				<tr>
					<td> Email: </td>
					<td><input type="email" name="email" class="textInput"></td>
				</tr>
				<tr>
					<td> Password: </td>
					<td><input type="password" name="password" class="textInput"></td>
				</tr>
				<tr>
					<td> Confirm Password: </td>
					<td><input type="password" name="password_confirm" class="textInput"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="button" value="Register"></td>
				</tr>
			</table>
		</form>
	</body>
</html>