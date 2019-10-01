<?php # Script 9.3 - edit_user.php

// This page is for editing a user record.
// This page is accessed through view_users.php.

$page_title = 'Logged User Page';
$page_description = 'Logged User Page';
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
    
    $cu = $_SESSION['user_id'];

	require_once ('mysqli_connect.php');
    
    // Make the query:
$q = "SELECT last_name, first_name, email, badge_number, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM users WHERE user_id='$cu'";
$r = @mysqli_query ($dbc, $q); // Run the query.

    

// Fetch and print all the records....
$bg = '#eeeeee';
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

		echo '<h3 class="set-2-a">Hi ' . ' ' . $row['first_name'] . ', </h3>';
        echo '<p>Please check your details below. Feel free to update your proile anytime.<br><hr></p>';
        echo '<div class="row">';
        echo '<p>First name: ' . ' ' . $row['first_name'] . ' </p>';
        echo '<p>Last name: ' . ' ' . $row['last_name'] . ' </p>';
        echo '<p>Email: ' . ' ' . $row['email'] . ' </p>';
        echo '<p>Badge number: ' . ' ' . $row['badge_number'] . ' </p>';
        echo '<p>Password: ****** <a class="set-2-a" href="change_password.php?id=' . $cu . '">Change</a></p>';
        echo '<p><br><a class="button button2" href="edit_user.php?id=' . $cu . '">Edit details</a></p>';      
        echo '</div>';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);
    
        
	// Add links if the user is an administrator:
  if ($_SESSION['user_level'] == 1) {

   	echo '<h3>You are logged in as admin.</p>
';


	}

} else { //  Not logged in.

	echo '<p>You do not have enogh admin rights to access this page.</p>
    <p>You need to be a registered or admin user and logged in to access this page. </p>
';

}


?>
        </div>
    </div>    
</div>

<?php
include ('includes/footer.html');
?>
