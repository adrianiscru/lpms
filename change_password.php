<?php # Script 16.11 - change_password.php
// This page allows a logged-in user to change their password.

require_once ('includes/config.inc.php'); 
$page_title = 'Change Your Password';
$page_description = 'Change Your Password';
include ('includes/header.html');

?>

<div class="row"> <!-- PAGE CONTENT --> 
    <div class="col-s-12 col-m-12 col-l-12">
        <div class="boxed-container cms-editable text-left set-1-b shadow-box">
            <h2>Lost Property Management System</h2>
            <?php include ('includes/menu-1.html');?>
            
<?php

// If no first_name session variable exists, redirect the user:
if (!isset($_SESSION['first_name'])) {
	
	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
	
}

if (isset($_POST['submitted'])) {
	require_once (MYSQL);
			
	// Check for a new password and match against the confirmed password:
	$p = FALSE;
	if (preg_match ('/^(\w){4,20}$/', $_POST['password1']) ) {
		if ($_POST['password1'] == $_POST['password2']) {
			$p = mysqli_real_escape_string ($dbc, $_POST['password1']);
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid password!</p>';
	}
	
	if ($p) { // If everything's OK.

		// Make the query.
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id={$_SESSION['user_id']} LIMIT 1";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
		
			// Send an email, if desired.
			echo '<h3>Your password has been changed.</h3>';
			mysqli_close($dbc); // Close the database connection.
			include ('includes/menu.html'); // Include the HTML footer.
			exit();
			
		} else { // If it did not run OK.
		
			echo '<p class="error">Your password was not changed. Make sure your new password is different than the current password. Contact the system administrator if you think an error occurred.</p>'; 

		}

	} else { // Failed the validation test.
		echo '<p class="error">Please try again.</p>';		
	}
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.

?>
            
<form action="change_password.php" method="post">
    <fieldset>
    <div class="row">
        <p>
            <label class="col-" for "password1">New Password: <br><small>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</small></label>
            <input class="input col-s-12 col-m-12 col-l-6" type="password" name="password1" size="20" />
        </p>
        
        <p>
            <label class="col-" for "password2">Confirm New Password:</label>
            <input class="input col-s-12 col-m-12 col-l-6" type="password" name="password2" size="20" />
        </p>
    </div>
    
    <div class="row">
        <p><input  class="button button2" type="submit" name="submit" value="Change My Password" /></p>
        <input type="hidden" name="submitted" value="TRUE" />
    </div> 
        </fieldset>
</form>

        </div>
    </div>    
</div>

<?php
include ('includes/footer.html');
?>
