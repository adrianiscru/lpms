<?php # Script 9.2 - delete_item.php

// This page is for deleting a item record.
// This page is accessed through view_items.php.

$page_title = 'Delete an Item';
$page_description = 'Delete Item';
include ('includes/header.html');

?>

<div class="row"> <!-- PAGE CONTENT --> 
    <div class="col-s-12 col-m-12 col-l-12">
        <div class="boxed-container cms-editable text-left set-1-b shadow-box">
            <h2>Lost Property Management System</h2>
            <?php include ('includes/menu-1.html');?>
<?php

	// Add links if the user is an administrator:
  if ($_SESSION['user_level'] == 1) {

   	echo '<h3>Delete Item </h3><hr>';

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

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query:
		$q = "DELETE FROM items WHERE item_id=$id LIMIT 1";
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

			// Print a message:
			echo '<p>The item has been deleted.</p>';

		} else { // If the query did not run OK.
			echo '<p class="error">The item could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}

	} else { // No confirmation of deletion.
		echo '<p>The item has NOT been deleted.</p>';
	}

} else { // Show the form.

	// Retrieve the item's information:
	$q = "SELECT CONCAT(item_type, ', ', item_colour) FROM items WHERE item_id=$id";
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1) { // Valid item ID, show the form.

		// Get the item's information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);

		// Create the form:
		echo '<form action="delete_item.php" method="post">
        <fieldset>
	<h3>Name: ' . $row[0] . '</h3>
	<p>Are you sure you want to delete this item?<br />
	<input type="radio" name="sure" value="Yes" /> Yes
	<input type="radio" name="sure" value="No" checked="checked" /> No</p>
	<p><input class="button button2" type="submit" name="submit" value="Submit" /></p>
	<input type="hidden" name="submitted" value="TRUE" />
	<input type="hidden" name="id" value="' . $id . '" />
    </fieldset>
	</form>';

	} else { // Not a valid item ID.
		echo '<p class="error">This page has been accessed in error.</p>';
	}

} // End of the main submission conditional.

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
