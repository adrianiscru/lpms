<?php # Script 9.3 - edit_user.php

// This page is for editing a user record.
// This page is accessed through view_users.php.

$page_title = 'Edit a User';
$page_description = 'Edit User';
include ('includes/header.html');


?>

<div class="row"> <!-- PAGE CONTENT --> 
    <div class="col-s-12 col-m-12 col-l-12">
        <div class="boxed-container cms-editable text-left set-1-b shadow-box">
            <h2>Lost Property Management System</h2>
            <?php include ('includes/menu-1.html');?>
<?php


	// Add links if the user is an administrator:
  if (isset($_SESSION['user_id'])) {

   	echo '<h3><b>Edit profile </b></h3>
';

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
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

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
    
    // Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}

	// Check for a badge number:
	if (empty($_POST['badge_number'])) {
		$errors[] = 'You forgot to enter a badge number.';
	} else {
		$bn = mysqli_real_escape_string($dbc, trim($_POST['badge_number']));
	}
	

	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
    
    

	if (empty($errors)) { // If everything's OK.

		//  Test for unique email address:
		$q = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE users SET first_name='$fn', last_name='$ln', badge_number='$bn', email='$e' WHERE user_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>Profile updated.</p>';

			} else { // If it did not run OK.
				echo '<p class="error">This profile could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}

		} else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
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

// Retrieve the user's information:
$q = "SELECT first_name, last_name, badge_number, email FROM users WHERE user_id=$id";
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);

	// Create the form:
	echo '<form action="edit_user.php" method="post">
    
    <fieldset>
    
  <div class="row">
    <p><label class="col-" for "first_name">First Name</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="first_name" size="15" maxlength="15" value="' . $row[0] . '" /></p>
    
    <p><label class="col-" for "last_name">Last Name</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="last_name" size="15" maxlength="30" value="' . $row[1] . '" /></p>
    
    <p><label class="col-" for "badge_number">Badge Number</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="badge_number" size="15" maxlength="15" value="' . $row[2] . '" /></p>
    
    <p><label class="col-" for "email">Email</label>
    <input class="input col-s-12 col-m-12 col-l-6" type="text" name="email" size="20" maxlength="40" value="' . $row[3] . '"  /></p>
    
</div>  
    

<div class="row">
    <p><input class="button button2" type="submit" name="submit" value="Submit" /></p>
    <input type="hidden" name="submitted" value="TRUE" />
    <input type="hidden" name="id" value="' . $id . '" />
 </div>
 </fieldset>
</form>';

} else { // Not a valid user ID.
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
