<?php # Script 16.5 - index.php
// This is the main page for the site.

// Include the configuration file:
require_once ('includes/config.inc.php'); 

// Set the page title and include the HTML header:
$page_title = 'Contact';
$page_description = 'Contact';
include ('includes/header.html');

?>

<div class="row"> <!-- PAGE CONTENT --> 
    <div class="col-s-12 col-m-12 col-l-12">
        <div class="boxed-container cms-editable text-left set-1-b shadow-box">
            <h2>Lost Property Management System</h2>
            <?php include ('includes/menu-1.html');?>

            <h3>Contact</h3>
            <hr>

   
            <form action="contact.php" method="post">

                <div class="col-s-12">
                <p>Please fill the form to leave a message</p>
                <p class="small-text">Your email address will be never made public.  </p>
                </div>


                <div class="row">
                <p>
               <label class="col-" for "name">Name</label>
                <input class="input col-s-12 col-m-12 col-l-6" type="text" name="name" placeholder="Your name here..." value="" />
                </p>
                </div>

                <div class="row">       
                <p>
                <label class="col-" for "email">Email</label>
                <input class="input col-s-12 col-m-12 col-l-6" type="email" name="email" placeholder="Your email here..." value="" />
                </p>
                </div>

                <div class="row">   
                <p>
                <label class="col-" for "message">Message</label>
                <textarea class="input col-s-12 col-m-12 col-l-6" name="message"></textarea>
                </p>
                </div>

                <div class="row">
                <p><input  class="button button2" type="submit" name="submit" value="SEND MESSAGE" /></p>
                <input type="hidden" name="submitted" value="TRUE" />

                </div>
            </form>
                
            <div class="space-div"> </div> <!-- Space DIV to compensate the height lost by using the fixed footer -->
                
        </div>
    </div>    
</div>
            
            
<?php // Include the HTML footer file:
include ('includes/footer.html');
?>
