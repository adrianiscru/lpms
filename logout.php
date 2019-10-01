<?php # Script 16.9 - logout.php
// This is the logout page for the site.

require_once ('includes/config.inc.php'); 
$page_title = 'Logout';
$page_description = 'Logout';
include ('includes/header.html');

?>

<div class="row"> <!-- PAGE CONTENT --> 
    <div class="col-s-12 col-m-12 col-l-12">
        <div class="boxed-container cms-editable text-left set-1-b shadow-box">
            <h2>Lost Property Management System</h2><hr>
            
<?php
            
// If no first_name session variable exists, redirect the user:
if (!isset($_SESSION['first_name'])) {

	$url = BASE_URL . 'index.php'; // Define the URL.
	ob_end_clean(); // Delete the buffer.
	header("Location: $url");
	exit(); // Quit the script.
	
} else { // Log out the user.

	$_SESSION = array(); // Destroy the variables.
	session_destroy(); // Destroy the session itself.
	setcookie (session_name(), '', time()-300); // Destroy the cookie.

}

// Print a customized message:
echo '<h3>You are now logged out.</h3>';
echo '<p><a href="index.php" class="button button2" " >Click here to continue</a></p>';

?>
        </div>
    </div>    
</div>

<?php
include ('includes/footer.html');
?>
