<!DOCTYPE html>
<?php
    /* Email Form
     * This is a simple email form that is used to demonstrate PHP validation.
     * This particular file also demonstrates using PHP to display HTML elements
     * 
     * Based off skeleton code from the project document
     */
$labels = array("name" => "Your name","address" => "Your email address",
    "reason" => "Reason for email", "reply" => "Reply Desired?",
     "subject" => "Subject", "message" => "Your Message");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Project 6 Email</title>
        <style type ="text/css">
            <!--
                form {margin: 1.5em 0 0 0; padding: 0;}
               .field {padding-top: .5em}
               label {/*font-weight: bold;*/ float: left; width: 20%;
                    margin-right: 1em; text-align: right;}
               .msg_label {font-weight: bold; float: left; width: 50%;
                    margin-right: 2em; text-align: right;}
               #submit {margin-left: 35%; padding-top: 1em;}
            -->
        </style>
    </head>
    <body style="background-color:#F4A460;">
        <form action = "jjg297Validator.php" method="POST">
        <?php
            echo "<h1> Welcome to the Project 6 Webspace </h1> <hr >";
            echo "<h3> Please fill out the form and click submit to send an email. </h3>";
            /* Loop that displays the form fields */
            foreach ($labels as $field => $label){
                
                /* echo the labels */
               echo "<div class ='field'>\n
                        <label for = '$field'>$label</label>\n";

                /* Echo the appropriate fields */
                if($field === "name" or $field === "address" or $field === "subject"){
                    echo "<input type='text' name='$field' id='$field'
                            size='65' maxlength='65' />\n";
                }
                
                if($field === "reason"){
                    /* Create the dropdown options for the reason for email */
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
                    echo "<textarea name='$field' rows='8' cols='60'></textarea>";
                }
                
                /* echo the end of the field div */
                echo "</div>\n";
                
            }

            /* Display the submit button */
            echo "<div id='submit'>\n
                    <input type='submit' value='Send Message'>\n
                    </div>\n</form>\n</body>\n</html>";
        ?>
    <!--There are no ending tags here because they are embedded in the PHP!-->
