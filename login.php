<?php # Script 16.8 - login.php
// This is the login page for the site.

require_once ('includes/config.inc.php');
$page_title = 'Login';
$page_description = 'Login';
include ('includes/header.html');

?>

<div class="row"> <!-- PAGE CONTENT --> 
    <div class="col-s-12 col-m-12 col-l-12">
        <div class="boxed-container cms-editable text-left set-1-b shadow-box">
            <h2>Lost Property Management System</h2>
            
<?php
if (isset($_POST['submitted'])) {
	require_once (MYSQL);
	
	// Validate the email address:
	if (!empty($_POST['email'])) {
		$e = mysqli_real_escape_string ($dbc, $_POST['email']);
	} else {
		$e = FALSE;
		echo '<p class="error">You forgot to enter your email address!</p>';
	}
	
	// Validate the password:
	if (!empty($_POST['pass'])) {
		$p = mysqli_real_escape_string ($dbc, $_POST['pass']);
	} else {
		$p = FALSE;
		echo '<p class="error">You forgot to enter your password!</p>';
	}
	
	if ($e && $p) { // If everything's OK.
	
		// Query the database:
		$q = "SELECT user_id, first_name, user_level FROM users WHERE (email='$e' AND pass=SHA1('$p')) AND active IS NULL";		
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (@mysqli_num_rows($r) == 1) { // A match was made.

			// Register the values & redirect:
			$_SESSION = mysqli_fetch_array ($r, MYSQLI_ASSOC); 
			mysqli_free_result($r);
			mysqli_close($dbc);
							
			$url = BASE_URL . 'loggedin.php'; // Define the URL:
			ob_end_clean(); // Delete the buffer.
			header("Location: $url");
			exit(); // Quit the script.
				
		} else { // No match was made.
			echo '<p class="error">Either the email address and password entered do not match those on file or you have not yet activated your account.</p>';
		}
		
	} else { // If everything wasn't OK.
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);

} // End of SUBMIT conditional.
?>

           
            
<h1><?php echo $page_title; ?></h1>

    <form action="login.php" method="post">
        <fieldset>
        <p class="small-text">Your browser must allow cookies in order to log in.  </p>
        
        
        <div class="row">       
        <p>
        <label class="col-" for "email">Email</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="email" name="email" maxlength="40" placeholder="Your email here..." value="" />
        </p>
        </div>
        
        <div class="row">
        <p>
       <label class="col-" for "pass">Password</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="password" name="pass" placeholder="Your password here..." value="" />
        </p>
        </div>
        
        <div class="row">
        <p><input  class="button button2" type="submit" name="submit" value="LOGIN" /></p>
	    <input type="hidden" name="submitted" value="TRUE" />
        
        </div>
        </fieldset>
    </form>
            
        </div>
    </div>
</div>
<?php // Include the HTML footer.
include ('includes/footer.html');
?>
