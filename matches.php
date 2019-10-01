<?php # Script 16.5 - matches.php
// Adrian: This is the matches testing for the LPMS.

// Include the configuration file:
require_once ('includes/config.inc.php');

// Set the page title and include the HTML header:
$page_title = 'Regular Expression Pattern';
$page_description = 'Lost Property Management System For Schools By Adrian Iscru';
include ('includes/header.html');

?>
<!-- ADRIAN: PAGE SPECIFIC CONTENT - START -->


    <div class="row"> <!-- PAGE CONTENT --> 
        <div class="col-s-12 col-m-12 col-l-12 text-left">
            <div class="boxed-container cms-editable set-1-b">
                <h2>Lost Property Management System</h2>
                <fieldset>
<?php // Script 13.2 - matches.php

// This script takes a submitted string and checks it against a submitted pattern.
// This version prints every match made.

if (isset($_POST['submitted'])) {

	// Trim the strings:
	$pattern = trim($_POST['pattern']);
	$subject = trim($_POST['subject']);
			
	// Print a caption:
	echo "<p>The result of checking<br /><b>$pattern</b><br />against<br />$subject<br />is ";
	
	// Test:
	if (preg_match_all ($pattern, $subject, $matches) ) {
		echo 'TRUE!</p>';
		
		// Print the matches:
		echo '<pre>' . print_r($matches, 1) . '</pre>';
		
	} else {
		echo 'FALSE!</p>';
	}
	
} // End of submission IF.
// Display the HTML form.
?>
            
                   
<form action="matches.php" method="post">
    <div class="row">
	<p>Regular Expression Pattern:</p>
        
    <p> <input class="input col-s-12 col-m-12 col-l-6" type="text" name="pattern" value="<?php if (isset($pattern)) echo $pattern; ?>" size="30" /> </p></div>
    <div class="row"><p>(include the delimiters)</p></div>
    <div class="row">
	<p>Test Subject:</p>
    <p> <textarea class="input col-s-12 col-m-12 col-l-6" name="subject" rows="5" cols="30"><?php if (isset($subject)) echo $subject; ?></textarea></p>
    </div>
    <div class="row">
	<input class="button button2"  type="submit" name="submit" value="Test!" />
	<input type="hidden" name="submitted" value="TRUE" />
    </div>
</form>
                    
                </fieldset>
            </div>
        </div>
</div>


<?php // Include the HTML footer file:
include ('includes/footer.html');
?>
