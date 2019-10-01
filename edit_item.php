<?php # Script 9.3 - edit_item.php

// This page is for editing a item record.
// This page is accessed through view_items.php.

$page_title = 'Edit a item';
$page_description = 'Edit item';
include ('includes/header.html');


?>

<div class="row"> <!-- PAGE CONTENT --> 
    <div class="col-s-12 col-m-12 col-l-12">
        <div class="boxed-container cms-editable text-left set-1-b shadow-box">
            <h2>Lost Property Management System</h2>
            <?php include ('includes/menu-1.html');?>
<?php


	// Add links if the item is an administrator:
  if ($_SESSION['user_level'] == 1) {

   	echo '<h3><b>Edit item </b></h3>';

// Check for a valid item ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_items.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('includes/menu.html');
	exit();
}

require_once ('mysqli_connect.php');

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	$errors = array();
    
    // Check for a type:
	if (empty($_POST['item_type'])) {
		$errors[] = 'You forgot to enter item type.';
	} else {
		$it = mysqli_real_escape_string($dbc, trim($_POST['item_type']));
	}
    
     // Check for a colour:
	if (empty($_POST['item_colour'])) {
		$errors[] = 'You forgot to enter item colour.';
	} else {
		$ic = mysqli_real_escape_string($dbc, trim($_POST['item_colour']));
	}
    
    // Check for a size:
	if (empty($_POST['item_size'])) {
		$is = 'NA';
	} else {
		$is = mysqli_real_escape_string($dbc, trim($_POST['item_size']));
	}
    
    // Check for a make:
	if (empty($_POST['item_make'])) {
		$im = 'NA';
	} else {
		$im = mysqli_real_escape_string($dbc, trim($_POST['item_make']));
	}
    
	// Check for a location:
	if (empty($_POST['item_location'])) {
		$errors[] = 'You forgot to enter a store location.';
	} else {
		$il = mysqli_real_escape_string($dbc, trim($_POST['item_location']));
	}
    
   // Check for a badge:
	if (empty($_POST['item_badge'])) {
		$ib = 'NA';
	} else {
		$ib = mysqli_real_escape_string($dbc, trim($_POST['item_badge']));
	}
    
     // Check for a label:
	if (empty($_POST['item_label'])) {
		$la = 'NA';
	} else {
		$la = mysqli_real_escape_string($dbc, trim($_POST['item_label']));
	}
    
    // Check for user name:
	if (empty($_POST['user_name'])) {
		$errors[] = 'You forgot to enter the user. Could be name of student or admin.';
	} else {
		$un = mysqli_real_escape_string($dbc, trim($_POST['user_name']));
	}
    
     // Check for other info:
	if (empty($_POST['other_info'])) {
		$oi = 'NA';
	} else {
		$oi = mysqli_real_escape_string($dbc, trim($_POST['user_name']));
	}
    
    // Check for status:
	if (empty($_POST['item_status'])) {
		$st = 'Found';
	} else {
		$st = mysqli_real_escape_string($dbc, trim($_POST['item_status']));
	}
    
    
	if (empty($errors)) { // If everything's OK.
        
        $la = $name;



			// Make the query:
			$q = "UPDATE items SET item_type='$it', item_colour='$ic', item_size='$is', item_make='$im', item_status='$st', item_location='$il', item_badge='$ib', item_label='$la', user_name='$un'  WHERE item_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>The item has been edited.</p>';

			} else { // If it did not run OK.
				echo '<p class="error">The item could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}



	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';

	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the item's information:
$q = "SELECT item_type, item_size, item_badge FROM items WHERE item_id=$id";
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid item ID, show the form.

	// Get the item's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);

	// Create the form:
	echo '<form action="edit_item.php" method="post">
    
    <fieldset>
    
  <div class="row">
  
  <p><label class="col-" for "item_type">Type</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_type" size="15" maxlength="15" value="' . $row[0] . '" /></p>
    
    <p><label class="col-" for "item_colour">Colour</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_colour" size="15" maxlength="15" value="' . $row[3] . '" /></p>
    
    <p><label class="col-" for "item_size">Size</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_size" size="15" maxlength="15" value="' . $row[1] . '" /></p>
  
    <p><label class="col-" for "item_make">Make</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_make" size="15" maxlength="15" value="' . $row[4] . '" /></p>
    
    <p><label class="col-" for "item_location">Store Location</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_location" size="15" maxlength="15" value="' . $row[5] . '" /></p>
    
    <p><label class="col-" for "item_badge">Badge</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_badge" size="15" maxlength="30" value="' . $row[2] . '" /></p>
    
    <p><label class="col-" for "item_label">Item Label</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_label" size="15" maxlength="15" value="' . $row[6] . '" /></p>
    
    <p><label class="col-" for "user_name">Posted by</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="user_name" size="15" maxlength="15" value="' . $row[7] . '" /></p>
    
    <p>
    <label class="col-" for "other_info">Other Information</label>
    <textarea class="input col-s-12 col-m-12 col-l-6" type="text" name="other_info">
    </textarea>
    </p>
        
    <p><label class="col-" for "item_status">Status</label>
    <select class="input col-s-12 col-m-12 col-l-6" name="item_status">
        <option value="Found">Found</option>
        <option value="Collected">Collected</option>
    </select>
    </p>
    
    
</div>  
    

<div class="row">
    <p><input class="button button2" type="submit" name="submit" value="Submit" /></p>
    <input type="hidden" name="submitted" value="TRUE" />
    <input type="hidden" name="id" value="' . $id . '" />
 </div>
 </fieldset>
</form>';

} else { // Not a valid item ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);



} else { //  Not logged in.

	echo '<p>You do not have enogh admin rights to access this page. </p>
';

}

?>
        </div>
    </div>    
</div>

<?php
include ('includes/footer.html');
?>
