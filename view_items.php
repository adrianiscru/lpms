<?php # Script 9.5 - #5

// This script retrieves all the records from the users table.
// This new version allows the results to be sorted in different ways.

$page_title = 'View Items';
$page_description = 'View Items';
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

   	echo '<h3><b>View reported items </b></h3><hr>';

require_once ('mysqli_connect.php');

// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(item_id) FROM items";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by reporting date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
    case 'im':
		$order_by = 'item_make ASC';
		break;
	case 'it':
		$order_by = 'item_type ASC';
		break;
     case 'st':
		$order_by = 'item_status ASC';
		break;
    case 'un':
		$order_by = 'user_name ASC';
		break;
	case 'il':
		$order_by = 'item_location ASC';
		break;
    case 'la':
		$order_by = 'item_label ASC';
		break;
    case 'ic':
		$order_by = 'item_colour ASC';
		break;
    case 'is':
		$order_by = 'item_size ASC';
		break;
	case 'rd':
		$order_by = 'reporting_date ASC';
		break;
	default:
		$order_by = 'reporting_date ASC';
		$sort = 'rd';
		break;
}

// Make the query:
$q = "SELECT item_type, item_badge, item_make, item_status, item_colour, user_name, item_location, item_label, item_size, DATE_FORMAT(reporting_date, '%d-%m-%Y') AS dr, item_id FROM items ORDER BY $order_by LIMIT $start, $display";
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo '<table align="center" cellspacing="0" cellpadding="5" width="auto">
<tr class="set-2-a" >
	<td align="left"><b>Sort by</b></td>
    
    <td align="left"><b><a href="view_items.php?sort=im">Make</a></b></td>
    <td align="left"><b><a href="view_items.php?sort=it">Type</a></b></td>
	<td align="left"><b><a href="view_items.php?sort=st">Status</a></b></td>
    <td align="left"> </td>
    <td align="left"><b><a href="view_items.php?sort=un">Posted by</a></b></td>
    <td align="left"><b><a href="view_items.php?sort=il">Location</a></b></td>
    <td align="left"><b><a href="view_items.php?sort=la">Item Label</a></b></td>
    <td align="left"><b><a href="view_items.php?sort=ic">Colour</a></b></td>
    <td align="left"><b><a href="view_items.php?sort=is">Size</a></b></td>
    <td align="left"><b><a href="view_items.php?sort=ib">Badge</a></b></td>
	<td align="left"><b><a href="view_items.php?sort=rd">Reported on</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee';
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_item.php?id=' . $row['item_id'] . '">Edit</a></td>
		
        
        <td align="left">' . $row['item_make'] . '</td>
        <td align="left">' . $row['item_type'] . '</td>
        <td align="left">' . $row['item_status'] . '</td>
        <td align="left"> by </td>
        <td align="left">' . $row['user_name'] . '</td>
        <td align="left">' . $row['item_location'] . '</td>
        <td align="left">' . $row['item_label'] . '</td>
        <td align="left">' . $row['item_colour'] . '</td>
        <td align="left">' . $row['item_size'] . '</td>
        <td align="left">' . $row['item_badge'] . '</td>
		<td align="left">' . $row['dr'] . '</td>
	</tr>
	';
} // End of WHILE loop.

echo '</table>';
mysqli_free_result ($r);
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {

	echo '<br /><p>';
	$current_page = ($start/$display) + 1;

	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="view_items.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}

	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_items.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.

	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_items.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}

	echo '</p>'; // Close the paragraph.

} // End of links section.



} else { //  Not logged in.

	echo '<p class="error">You do not have enogh admin rights to access this page. </p>
';

}


?>
            
        </div>
    </div>    
</div>

<?php
include ('includes/footer.html');
?>
