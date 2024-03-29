<?php # Script 16.6 - register.php
// This is the registration page for the site.

require_once ('includes/config.inc.php');
$page_title = 'Register';
$page_description = 'Register';
include ('includes/header.html');

?>

<div class="row"> <!-- PAGE CONTENT --> 
    <div class="col-s-12 col-m-12 col-l-12">
        <div class="boxed-container cms-editable text-left set-1-b shadow-box">
            <h2>Lost Property Management System</h2>
            <h3>Register</h3>
<?php
            
if (isset($_POST['submitted'])) { // Handle the form.

	require_once (MYSQL);
	
	// Trim all the incoming data:
	$trimmed = array_map('trim', $_POST);
	
	// Assume invalid values:
	$fn = $ln = $e = $p = FALSE;
	
	// Check for a first name:
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string ($dbc, $trimmed['first_name']);
	} else {
		echo '<p class="error">Please enter your first name!</p>';
	}
	
	// Check for a last name:
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string ($dbc, $trimmed['last_name']);
	} else {
		echo '<p class="error">Please enter your last name!</p>';
	}
	
	// Check for an email address:
	if (preg_match ('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/', $trimmed['email'])) {
		$e = mysqli_real_escape_string ($dbc, $trimmed['email']);
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}

	// Check for a password and match against the confirmed password:
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid password!</p>';
	}
	
	if ($fn && $ln && $e && $p) { // If everything's OK...

		// Make sure the email address is available:
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) { // Available.
		
			// Create the activation code:
			$a = md5(uniqid(rand(), true));
		
			// Add the user to the database:
			$q = "INSERT INTO users (email, pass, first_name, last_name, active, registration_date) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', NOW() )";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
			
				// Send the email:
				$body = "Thank you for registering at <whatever site>. To activate your account, please click on this link:\n\n";
				$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
				mail($trimmed['email'], 'Registration Confirmation', $body, 'From: admin@sitename.com');
				
				// Finish the page:
				echo '<h3>Thank you for registering! A confirmation email has been sent to your address. Please click on the link in that email in order to activate your account.</h3>';
				include ('includes/menu-1.html'); // Include the HTML footer.
				exit(); // Stop the page.
				
			} else { // If it did not run OK.
				echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			}
			
		} else { // The email address is not available.
			echo '<p class="error">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</p>';
		}
		
	} else { // If one of the data tests failed.
		echo '<p class="error">Please re-enter your passwords and try again.</p>';
	}

	mysqli_close($dbc);

} // End of the main Submit conditional.
?>
	
<form action="register.php" method="post">
	<fieldset>
        
    <div class="row">
        <p><label class="col-" for "first_name">First Name</label><input class="input col-s-12 col-m-12 col-l-6" type="text" name="first_name" size="20" maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>" /></p>
        
        <p><label class="col-" for "last_name">Last Name</label><input class="input col-s-12 col-m-12 col-l-6" type="text" name="last_name" size="20" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" /></p>
        
        <p><label class="col-" for "email">Email</label><input class="input col-s-12 col-m-12 col-l-6" type="text" name="email" size="30" maxlength="80" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" /> </p>
    
	   <p><label class="col-" for "password1">Password<br><small>Use only letters, numbers, and the underscore. Must be between 4 and 20 characters long.</small></label><input class="input col-s-12 col-m-12 col-l-6" type="password" name="password1" size="20" maxlength="20" /> </p>

        <p><label class="col-" for "password2">Confirm Password</label><input class="input col-s-12 col-m-12 col-l-6" type="password" name="password2" size="20" maxlength="20" /></p>
		
        </div>
        <div class="row">
            
	<p><input  class="button button2" type="submit" name="submit" value="Register" /></p>
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
