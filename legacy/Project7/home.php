<?php
	session_start();
?>
	
<html>
	<head>
		<title>
			Project 8 Home
		</title>
	<link href="styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body style="background-color:#F4A460">
		
		<?php 
			if (isset($_SESSION['message'])){
				echo "<div id=error>".$_SESSION['message']."</div>";
				unset($_SESSION['message']);
			}
		?>
		
		<h1> Home </h1><hr>
		<div><h4> Welcome <?php echo $_SESSION['user']; ?></h4></div>
		<p> (If no options appear, try reloading, rare bug that happened once while testing ~ Jesus)</p>
		<!-- If a user is detected 'in session'
			 Then only output certain links, and vice versa -->
		<?php
			$user = $_SESSION['user'];
			if($user != ""){
				echo "<div><a href='logout.php'>Logout</a></div>";
				echo "<div><a href='changedata.php'>Change login info</a></div>";
				echo "<div><a href='printdata.php'>Access Data</a></div>";
				echo "<div><a href='inbox.php'>Inbox/Message</a></div>";
				echo "<div><a href='ticket.php'>Send a Ticket</a></div>";
			} else {
				echo "<div><a href='login.php'>Login</a></div>";
				echo "<div><a href='register.php'>Register</a></div>";
			}
		?>
		
	</body>
</html>