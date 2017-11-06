<!DOCTYPE html>
<?php
/* Validate Email Form 
 * This is the PHP file that validates entry from a simple email form.  If any
 * field fails validation, then the form is redisplayed with an error.
 * 
 * This is a crippled version of the one I showed in class.  It would make a
 * good starting point.  Even so, DO NOT USE my code.  Pick your own variable
 * names (for keys and values, too) and make up your own CSS (or, better still,
 * use the CSS you came up with for your Project 3, but invoke the external
 * CSS with a PHP echo statement, and any page specific stuff should be your
 * own, not what you see below.
 * 
 * Author: Patrick E. Kelley - 2012
 * 
 * As recommended, this code was used as a starting point with modifications
 * made on top of the starting code
 */
?>
<html>
    <head>
        <title>Email sent (JS)</title>-
        <style type ="text/css">
        <!--
            form {margin: 1.5em 0 0 0; padding: 0;}
            .field {padding-top: .5em}
            label {float: left; width: 20%;
                   margin-right: 1em; text-align: right;}
            #submit {margin-left: 35%; padding-top: 1em;}
            errorstr {color: red;}
            msgbody {margin-right: auto; padding-left: 52px; width:400px; float:left;}
        -->
        </style>
    </head>
    
    <body style="background-color:#F4A460;">
		
        <?php
        echo "<h1> Welcome to the Project 9 Webspace </h1> <hr >";
            
            $timestamp = date('h:i:s, m-d-Y');
            $msg = "REASON: "  . $_POST['reason'] . "\n" . $_POST["message"] . "\n" . $timestamp;
            mail('jjg297@nau.edu', $_POST["subject"], $msg, "From: ". $_POST['address']);
            echo "TO: jjg297@nau.edu <br>";
            echo "FROM: " . $_POST['address'] . "<br>";
            echo "CC: " . $_POST['address'] . "<br>";
            echo "SUBJECT: " . $_POST['subject'] . "<hr>";
            echo "BODY: <br> ";
            echo "<msgbody> $msg <br> </msgbody><br>";
			echo "<b>Created at: " . $timestamp . "</b><br>";
            
		echo "<a href='index.php'> Go Back</a>"
        ?>
    </body>
</html>
