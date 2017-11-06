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
        <title>Email Validation</title>
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
        date_default_timezone_set("MST"); 
        $creatorEmail = "jjg297@nau.edu";
        /* set up array for POST inputs */
        /* not in heading like before, though you could */
        $labels = array("name" => "Your name",
                        "address" => "Your email address",
                        "reason" => "Reason for email",
                        "reply" => "Reply Desired?",
                        "subject" => "Subject",
                        "message" => "Your message");
        /* set a valid flag true */
        $vflag = 1;
        echo "<h1> Welcome to the Project 5 Webspace </h1> <hr >";
        /* scan the POST array and validate the fields */
        foreach ($_POST as $field => $value) {
            /* handle free-form text fields */
            if ($field === "name") {
                if(empty($value)){
                    echo"<errorstr>You must fill in the ($labels[$field]) field.</errorstr><br>\n";
                    /* set valid flag to false */
                    $vflag = false;
                }
            }

            /* handle email address format */
            if ($field === "address") {
                if(empty($value)){
                    echo"<errorstr>You must fill in the ($labels[$field]) field.</errorstr><br>\n";
                    /* set valid flag to false */
                    $vflag = false;
                }
                /* you didn't really think I'd give you the pattern? */
                elseif (!strpos($value, "@")) {
                    echo "<errorstr>Email address must be in the form 
                        <i>username@hostname.(com|org|edu|gov)</i>.</errorstr><br>\n";
                    /* set valid flag to false */
                    $vflag = false;
                }
                elseif ((!strpos($value, ".com")) and (!strpos($value, ".edu"))
                        and (!strpos($value, ".org")) and (!strpos($value, ".gov"))) {
                    echo "<errorstr>Email address must be in the form 
                        <i>username@hostname.(com|org|edu|gov)</i>.</errorstr><br>\n";
                    /* set valid flag to false */
                    $vflag = false;
                }
            }
        
            if ($field === "message") {
                if(empty($value)){
                    echo"<errorstr>You must fill in the ($labels[$field]) field.</errorstr><br>\n";
                    /* set valid flag to false */
                    $vflag = false;
                }
            }
            if ($field === "subject") {
                if(empty($value)){
                    echo"<errorstr>You must fill in the ($labels[$field]) field.</errorstr><br>\n";
                    /* set valid flag to false */
                    $vflag = false;
                }
            }
        }
        
        /* if we got here and the valid flag is still true, do what the form
         * requires.  Otherwise, redisplay the form for the user to try again.
         */
        if ($vflag){
            /* if true, do the action (email in this case)... */
            
            $timestamp = date('h:i:s, m-d-Y');
            $msg = $_POST["message"];
            mail($creatorEmail, $_POST["subject"], $msg, "From: ". $_POST['address']);
            echo "TO: $creatorEmail <br>";
            echo "FROM: " . $_POST['address'] . "<br>";
            echo "CC: " . $_POST['address'] . "<br>";
            echo "SUBJECT: " . $_POST['subject'] . "<hr>";
            echo "BODY: "  . $_POST['reason'] . "<br> ";
            echo "<msgbody> $msg <br> <msgbody><b> Created at: " . $timestamp . "</b>";
            
                
        }
        else /* false, so redisplay form */
        {
            /* $_SERVER(PHP_SELF) means 'use this file on SUBMIT' */
            echo "<h3>Please fill out the form and click submit to send an email.
                </h3>\n
                <form action='$_SERVER[PHP_SELF]' method='POST'>";

            /* Loop that displays the form fields */
            foreach ($labels as $field => $label) {
                  /* echo the label */
                  echo "<div class='field'>\n
                          <label for='$field'>$label</label>\n";

                  /* echo the appropriate field */
                  if ($field === "name" or $field === "address" or $field === "subject") {
                      echo "<input type='text' name='$field' id='$field'
                            size='65' maxlength='65' value='$_POST[$field]' />\n";
                  }
                  
                  
                if($field === "reason"){
                    /* Create the radio buttons for the reason for email */
                    echo "<select name='reason'>
                            <option value='Complaint'> Complaint  </option>
                            <option value='Question'> Question   </option>
                            <option value='Suggestion'> Suggestion  </option>
                            <option value='Praise'> Praise  </option>
                            <option value='Other'> Other  </option></select>";
                }
                
                if($field === "reply"){
                    /* Create the reply desired button */
                    echo "<input type='checkbox' name='$field' value='reply'>";
                }
                
                if($field === "message"){
                    /* Create the message text field */
                    echo "<textarea name='$field' rows='5' cols='40'>$_POST[$field]</textarea>";
                }

                  /* echo the end of the field div */
                  echo "</div>\n";
              }

              /* Display the submit button */
              echo "<div id='submit'>\n
                      <input type='submit' value='Send Message'>\n
                    </div>
                </form>";
        }
        ?>
    </body>
</html>
