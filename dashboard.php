<?php # Script 9.3 - edit_user.php

// This page is for editing a user record.
// This page is accessed through view_users.php.

$page_title = 'User Dashboard';
$page_description = 'User Dashboard';
include ('includes/header.html');


?>

<div class="row"> <!-- PAGE CONTENT --> 
    <div class="col-s-12 col-m-12 col-l-12">
        <div class="boxed-container cms-editable text-left set-1-b shadow-box">
            <h2>Lost Property Management System</h2>
            <?php include ('includes/menu-1.html');?>
            
            
<?php # Script 16.2 - menu-1.html
// This page add the Menu template.


	// Add links if the user is an administrator:
  if ($_SESSION['user_level'] == 1) {

   	echo '
        <p> </p>
';

	}

// Display links based upon the login status:
if (isset($_SESSION['user_id'])) {


    
    echo '<h3>This is your dashboard. </h3>';



} else { //  Not logged in.

	echo '

<p>You are not logged in.</p>
';

}
?>

            
        </div>
    </div>    
</div>

<?php
include ('includes/footer.html');
?>
