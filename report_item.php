<?php # Script 8.5 - ade_add_user.php #2

$page_title = 'Report Lost Item';
$page_description = 'Report Lost Items Here';
include ('includes/header.html');

?>

<div class="row"> <!-- PAGE CONTENT --> 
    <div class="col-s-12 col-m-12 col-l-12">
        <div class="boxed-container cms-editable text-left set-1-b shadow-box">
            <h2>Lost Property Management System</h2>
            
                <?php include ('includes/menu-1.html');?>
            
            
<?php
            
   // Display links based upon the login status:
if (isset($_SESSION['user_id'])) {

	echo '<h2>Report item</h2>';

    // Check if the form has been submitted:
if (isset($_POST['submitted'])) {

    require_once ('mysqli_connect.php');

	$errors = array(); // Initialize an error array.

	// Check for item type:
	if (empty($_POST['item_type'])) {
		$errors[] = 'You forgot to enter the item type.';
	} else {
		$it = mysqli_real_escape_string($dbc, trim($_POST['item_type']));
	}

	// Check for item colour:
	if (empty($_POST['item_colour'])) {
		$errors[] = 'You forgot to enter the colour.';
	} else {
		$ic = mysqli_real_escape_string($dbc, trim($_POST['item_colour']));
	}
    
    // Check for item size:
	if (empty($_POST['item_size'])) {
		$errors[] = 'You forgot to enter the item size.';
	} else {
		$is = mysqli_real_escape_string($dbc, trim($_POST['item_size']));
	}

	// Check for item make:
	if (empty($_POST['item_make'])) {
		$im = 'NA';
	} else {
		$im = mysqli_real_escape_string($dbc, trim($_POST['item_make']));
	}
    
    // Check for reporting user label:
	if (empty($_POST['item_label'])) {
		$errors[] = 'You forgot to enter the name on the label.';
	} else {
		$la = mysqli_real_escape_string($dbc, trim($_POST['item_label']));
	}
    
    // Check for reporting user name:
	if (empty($_POST['user_name'])) {
		$un = $la;
	} else {
		$un = mysqli_real_escape_string($dbc, trim($_POST['user_name']));
	}
    
        // Check for reporting user badge:
	if (empty($_POST['item_badge'])) {
		$ib = 'NA';
	} else {
		$ib = mysqli_real_escape_string($dbc, trim($_POST['item_badge']));
	}
    
    // Check for other info:
	if (empty($_POST['other_info'])) {
		$oi = 'NA';
	} else {
		$oi = mysqli_real_escape_string($dbc, trim($_POST['other_info']));
	}


	if (empty($errors)) { // If everything's OK.
        
        $st = 'Lost';
        $il = 'NA';
		// Register the user in the database...

		// Make the query:
        $q =      "INSERT INTO items (item_type, item_colour, item_size, item_make, item_status, item_location, item_badge, item_label, user_name, other_info, reporting_date) VALUES ('$it', '$ic', '$is', '$im', '$st', '$il', '$ib', '$la', '$un', '$oi', NOW() )";

		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.

			// Print a message:
			echo '<p>Thank you, ' .$un .  '!</p>
		<p>You have successfuly reported the item ' . ' ' . $it . ' to the system.</p><p><br /></p>';

            
		} else { // If it did not run OK.

			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">The item could not be reported due to a system error. We apologize for any inconvenience.</p>';

			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';

		} // End of if ($r) IF.

		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('includes/menu.html');
		exit();
    
	} else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';

	} // End of if (empty($errors)) IF.
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.


echo '

<form action="report_item.php" method="post">
    <fieldset>
    <div class="row">
        <p>
       <label class="col-" for "item_type">Type</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_type" value="" />
        </p>

        <p>
       <label class="col-" for "item_colour">Colour</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_colour" value="" />
        </p>

        <p>
       <label class="col-" for "item_size">Size</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_size" value="" />
        </p>
        
        <p>
       <label class="col-" for "item_make">Make</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_make" value="" />
        </p>
        

        <p>
       <label class="col-" for "item_label">Name On Label</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_label" value="" />
        </p>
        
        <p>
       <label class="col-" for "item_badge">Badge Number</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_badge" value="" />
        </p>
        
        <p>
        <label class="col-" for "other_info">Other Information</label>
        <textarea class="input col-s-12 col-m-12 col-l-6" type="text" name="other_info">
        </textarea>
        </p>
        
    </div>
    
    <div class="row">
        <p><input  class="button button2" type="submit" name="submit" value="RECORD ITEM" /></p>
	    <input type="hidden" name="submitted" value="TRUE" />    
    </div>
    </fieldset>
</form>

<div class="space-div"> </div> <!-- Space DIV to compensate the height lost by using the fixed footer -->

';


	

} else { //  Not logged in.

	echo '<p>You do not have enogh rights to access this page. </p>
';    }


?>
        </div> <span style="color:white;"></span>
    </div>    
</div>

<?php
include ('includes/footer.html');
?>
