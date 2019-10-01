<?php # Script 8.5 - ade_add_user.php #2

$page_title = 'Add User';
$page_description = 'Add User';
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

   	echo '<h3>Add user</h3><hr>';
    // Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	require_once ('mysqli_connect.php'); // Connect to the db.

	$errors = array(); // Initialize an error array.

	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter a first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}

	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter a last name.';
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
		$errors[] = 'You forgot to enter an email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'The password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter a password.';
	}

    // Check for a user level:

		$ul = ($_POST['user_level']);

	if (empty($errors)) { // If everything's OK.

		// Register the user in the database...

		// Make the query:
        $q =      "INSERT INTO users (email, pass, first_name, last_name, badge_number, user_level, active, registration_date) VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$bn', '$ul', NULL, NOW() )";

		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.

			// Print a message:
			echo '<h1>Well done!</h1>
		<p>You have successfuly added the user to the system.</p><p><br /></p>';

		} else { // If it did not run OK.

			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';

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

<form action="add_user.php" method="post">
    </fieldset>
    <div class="row">
        <p>
       <label class="col-" for "first_name">First Name</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="first_name" placeholder="First name here..." value="" />
        </p>

        <p>
       <label class="col-" for "last_name">Last Name</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="last_name" placeholder="Last name here..." value="" />
        </p>

        <p>
       <label class="col-" for "badge_number">Badge Number</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="badge_number" placeholder="Badge number here..." value="" />
        </p>
        
        <p>
        <label class="col-" for "email">Email</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="email" name="email" placeholder="Email here..." value="" />
        </p>
        
        <p>
        <label class="col-" for "pass1">Create Password</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="password" name="pass1" size="10" placeholder="Password here..." value="" />
        </p>
        
        <p>
        <label class="col-" for "pass1">Confirm Password</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="password" name="pass2" size="10" placeholder="Confirm password here..." value="" />
        </p>
        
    </div>
    <div class="row">
        <p> <b>User Level: </b>    <br />
           Student <input name="user_level" type="radio" value="0" checked="checked">  <br />
          Admin <input name="user_level" type="radio" value="1">
        </p>
    </div>
    
    <div class="row">
        <p><input  class="button button2" type="submit" name="submit" value="ADD USER" /></p>
	    <input type="hidden" name="submitted" value="TRUE" />    
    </div>
    
</form>



';



} else { //  Not logged in.

	echo '<p>You do not have enogh rights to access this page. </p>
';    }


?>
        </div>
    </div>    
</div>

<?php
include ('includes/footer.html');
?>
