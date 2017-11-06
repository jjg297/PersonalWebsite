<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Project 9 Email (JS)</title>
		<script type="text/javascript">
			function js_validate(){
				var name = document.forms["emailForm"]["name"].value;
				var email = document.forms["emailForm"]["address"].value;
				var subject = document.forms["emailForm"]["subject"].value;
				var message = document.forms["emailForm"]["message"].value;
				var list = "";
				var emailIsValid;
				if (name == "") {
					list = list + "Name ";
				} if (email == "") {
					list = list + "Email ";
					emailIsValid = email.includes("@");
					if(emailIsValid == false){
						alert("Email is in invalid format, no @ symbol");
					}
					emailIsValid = email.includes(".");
					if(emailIsValid == false){
						alert("Email is in invalid format, no . suffix");
					}
				} if (subject == "") {
					list = list + "Subject ";
				} if (message == "") {
					list = list + "Message ";
				}
				if (list != ""){
					list = list + "cannot be empty.";
					alert(list);
					return false;
				}
				return true;
			}
		</script>
        <style type ="text/css">
                form {margin: 1.5em 0 0 0; padding: 0;}
               .field {padding-top: .5em}
               label {width: 20%; text-align: left;}
               .msg_label {font-weight: bold; float: left; width: 50%;
                    margin-right: 2em; text-align: right;}
               #submit {margin-left: 35%; padding-top: 1em;}
        </style>
    </head>
    <body style="background-color:#F4A460;">
        <form name="emailForm" action = "sendEmail.php" method="POST" onsubmit="return js_validate()">
		
        <h1> Welcome to the Project 9 Webspace </h1> <hr >
		<h3> Please fill out the form and click submit to send an email. </h3>
		<label>
			Your name: <input type='text' name='name' id='name' size='30' maxlength='65' /></label><br><br><label>
			Email Address: <input type='text' name='address' id='address' size='30' maxlength='65' /></label><br><br><label>
			Subject: <input type='text' name='subject' id='subject' size='30' maxlength='65' /></label><br><br><label>
			
			Reason for email: <select name='reason'>
					<option value='Complaint'> Complaint  </option>
					<option value='Question'> Question   </option>
					<option value='Suggestion'> Suggestion  </option>
					<option value='Praise'> Praise  </option>
					<option value='Other'> Other  </option></select></label><br><br><label>
			Reply Desired? <input type='checkbox' name='Replydesired?' value='reply'></label><br><br><label>
			Message: <textarea name='message' rows='8' cols='60'></textarea></label><br><br><label>
			<input type='submit' value='Send Message'></label><a href="../index.html">Go back</a>
		</form>
	</body>
</html>
