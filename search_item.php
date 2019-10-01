<?php # Script 9.5 - #5

// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.

$page_title = 'Search Item';
$page_description = 'Search Item';
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

	echo '<h2>Search</h2>';
    
    // Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	require_once ('mysqli_connect.php'); // Connect to the db.

	$errors = array(); // Initialize an error array.

	// Check for item type:
	if (empty($_POST['item_type'])) {
		$errors[] = 'You forgot to enter the item type.';
	} else {
		$it = mysqli_real_escape_string($dbc, trim($_POST['item_type']));
	}

	// Check for item colour:
	if (empty($_POST['item_colour'])) {
		$errors[] = 'You forgot to enter the colour.';
	} else {
		$ic = mysqli_real_escape_string($dbc, trim($_POST['item_colour']));
	}
    
    // Check for item size:
	if (empty($_POST['item_size'])) {
		$errors[] = 'You forgot to enter the item size.';
	} else {
		$is = mysqli_real_escape_string($dbc, trim($_POST['item_size']));
	}

	// Check for item make:
	if (empty($_POST['item_make'])) {
		$errors[] = 'You forgot to enter the make.';
	} else {
		$im = mysqli_real_escape_string($dbc, trim($_POST['item_make']));
	}
    
    // Check for item make:
	if (empty($_POST['item_badge'])) {
		$ib;
	} else {
		$ib = mysqli_real_escape_string($dbc, trim($_POST['item_badge']));
	}


           // Make the query:
            $q = "SELECT * FROM items WHERE item_badge='$ib' OR item_type='$it' AND item_colour='$ic' OR item_type='$it' AND item_make='$im' ";
    
            echo '<p>Your search for : ' . ' ' . $ic . ' ' . $it . '<p>';
            echo '
            <table cellspacing="0" cellpadding="5" width="auto">
            <tr class="set-1-a">
                <th>Type</th>
                <th>Colour</th>
                <th>Size</th>
                <th>Make</th>
                <th>Label</th>
            </tr>';
    
            // Run the query:
            $r = @mysqli_query ($dbc, $q);
            $bg = '#eeeeee';
            while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	           $bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		          echo '<tr bgcolor="' . $bg . '">
                <td> ' . $row['item_type'] . '</td>
                <td> ' . $row['item_colour'] . '</td>
                <td> ' . $row['item_size'] . '</td>
                <td> ' . $row['item_make'] . '</td>
                <td> ' . $row['item_badge'] . '</td>
                </tr>

            ';
                     
} // End of WHILE loop.

echo '</table>
<div class="space-div"> </div> <!-- Space DIV to compensate the height lost by using the fixed footer -->';
mysqli_free_result ($r);
mysqli_close($dbc);

     }

}
            
           

 ?>
            
                

            <form action="search_item.php" method="post">
    <fieldset>
    <div class="row">
        <p>
       <label class="col-" for "item_type">Item Type</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_type" placeholder="item type..." value="" />
        </p>

        <p>
       <label class="col-" for "item_colour">Item Colour</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_colour" placeholder="item colour..." value="" />
        </p>

        <p>
       <label class="col-" for "item_size">Item Size</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_size" placeholder="item size..." value="" />
        </p>
        
        <p>
       <label class="col-" for "item_make">Item Make</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_make" placeholder="item make..." value="" />
        </p>

        <p>
       <label class="col-" for "item_badge">Item Badge</label>
        <input class="input col-s-12 col-m-12 col-l-6" type="text" name="item_badge" placeholder="item badge..." value="" />
        </p>

    </div>
    
    <div class="row">
        <p><input  class="button button2" type="submit" name="submit" value="SEARCH" /></p>
	    <input type="hidden" name="submitted" value="TRUE" />    
    </div>
    </fieldset>
</form>

<div class="space-div"> </div> <!-- Space DIV to compensate the height lost by using the fixed footer -->
            
        

        </div>
        </div>
      </div>

 <?php
    include("includes/footer.html");
 ?>