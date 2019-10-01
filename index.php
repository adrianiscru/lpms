<?php # Script 16.5 - index.php
// This is the main page for the site.

// Include the configuration file:
require_once ('includes/config.inc.php');

// Set the page title and include the HTML header:
$page_title = 'Lost Property Management System!';
$page_description = 'Lost Property Management System For Schools By Adrian Iscru';
include ('includes/header.html');

?>
<!-- ADRIAN: PAGE SPECIFIC CONTENT - START -->


    <div class="row jumbo-up"> <!-- PAGE CONTENT --> 
        <div class="col-s-12 col-m-12 col-l-12 text-center">
            <div class="boxed-container cms-editable">
                <?php // Welcome the user (by name if they are logged in):
                    if (isset($_SESSION['first_name'])) {
                        echo "<h3>Welcome," . " " . $_SESSION['first_name'] . "!</h3>";
                    }
                    ?>
                <h1>LPMS</h1>
                <h2> Claim / manage lost property in schools.</h2>
                <h2>A lost property management system developed for parents, students and school administrators.</h2>
                
                <div class="row">
                    <p><a href="get-started.php" class="button button1">GET STARTED</a> </p>
                </div>
                
                <div class="space-div"> </div> <!-- Space DIV to compensate the height lost by using the fixed footer -->
            </div>
        </div>    
    </div>

<?php // Include the HTML footer file:
include ('includes/footer.html');
?>
