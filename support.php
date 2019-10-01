<?php # index.php
// This is the main page for the site.

$page_title = 'LPMS Support';
$page_name = 'support.php';
$page_description = 'LPMS Support';

include("includes/header.html");

?>


<!-- SECTION 2 - EMAIL US DIRECTLY -->
    <div class="row"> <!-- PAGE CONTENT --> 
        <div class="col-s-12 col-m-12 col-l-12">
            <div class="boxed-container cms-editable text-left set-1-b shadow-box">
                <h2>Lost Property Management System</h2><hr>

                <h2 class="mobile-small-text-1 capitalize set-6-a">Need help?</h2>
                
                <div  class="mobile-small-text-2">
                    
                    <p class="padded-bottom">Please click the button below to contact us right from your email application. Please give all relevant details to help us providing the best support to you. 
                        <br><br>We will do our best to get back to you the soonest possible.</p>
                
                    <p class="text-left padded-bottom"><a  class="button button1" href="mailto:<?php echo $email;?>?subject=<?php echo $niche;?>%20LPMS%20-%20support%20requested.">EMAIL US</a></p>
                </div>
            </div>
        </div>
    </div>


    
<?php
include ('includes/footer.html');
?>
    


