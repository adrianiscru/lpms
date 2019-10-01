<?php # Script 16.5 - index.php
// This is the main page for the site.

// Include the configuration file:
require_once ('includes/config.inc.php');

// Set the page title and include the HTML header:
$page_title = 'Welcome to this Site!';
$page_description = 'Lost Property Management System For Schools By Adrian Iscru';
include ('includes/header.html');

?>
<!-- ADRIAN: PAGE SPECIFIC CONTENT - START -->


    <div class="row"> <!-- PAGE CONTENT --> 
        <div class="col-s-12 col-m-12 col-l-12 text-left">
            <div class="boxed-container cms-editable set-1-b">
                <h2>Lost Property Management System</h2>
                <?php // Welcome the user (by name if they are logged in):
                    if (isset($_SESSION['first_name'])) {
                        echo "<h3>Welcome," . " " . $_SESSION['first_name'] . "!</h3>";
                    }
                    ?>
                <fieldset>
                  
                <div class="row"><br>
                    <p><a href="login.php" class="button button1">LOGIN</a> </p>
                </div>
                    
                <div class="row"><br>
                    <h3>OR </h3>
                </div>
                    
                <div class="row"><br>
                    <p><a href="register.php" class="button button2">REGISTER</a> </p>
                </div>
                    
                
                    
                <div class="row"><br>
                    <p><a href="forgot_password.php" class="button set-1-a ">Forgot Password?</a> </p>
                </div>
                

                
                
                
                    
                <div class="space-div"> </div> <!-- Space DIV to compensate the height lost by using the fixed footer -->
                    
                </fieldset>
                
            </div>
        </div>    
    </div>

<?php // Include the HTML footer file:
include ('includes/footer.html');
?>
