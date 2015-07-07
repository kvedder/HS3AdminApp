<?php 
##########################################################################
##																		##
## WTLW/WOSN Client Management Application  -  list_clients.php         ##
## This page will display all of the clients that are signed up for     ##
## the WOSN/HS3 partership. The results will be paginated 10 at a time. ##
##																		##
##########################################################################


include('connect.php');



//num of records to show
$display = 5;

//figure out how may pages there are
// determine if the pages is already being requested
// next line starts 'p' if
if (isset($_GET['p']) && is_numeric ($_GET['p'])) {

	$pages = $_GET['p'];

} else {
	
//figure out how many records there will be in total

$q = "SELECT COUNT(clientid) FROM clients";

$r = mysqli_query($dbc, $q);


$row = mysqli_fetch_array($r, MYSQLI_NUM);
$records = $row[0];

//calculate the total number of pages needed
if ($records > $display) {
$pages = ceil ($records/$display); // figures out pages by dividing then rounds up to the nearest integer

} else {

$pages = 1; // if there are less than the max number of records, then there will only be one page

}

} //end 'p' if

// figure out where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {

	$start = $_GET['s'];

} else {

	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'nm':
		$order_by = 'client_name ASC';
		break;
	case 'ct':
		$order_by = 'client_city ASC';
		break;
	case 'st':
		$order_by = 'client_state ASC';
		break;
	default:
		$order_by = 'client_state, client_name ASC';
		$sort = 'st';
		break;
}

// Define the query:
$q = "SELECT clientid, client_name, client_city, client_state FROM clients ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
echo '<div id="menu"><h1>Main Menu</h1><br>Dashboard<br><a href="list_tickets.php">Tickets</a><br><a href="list_clients.php">Clients</a><br>Options<br>Users<br>Logout</div>

<div id="content">
<h1>Current Clients</h1>
<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr>
	<td align="left"><b>Edit</b></td>
	<td align="left"><b>Delete</b></td>
	<td align="left"><b>New Ticket</b></td>
	<td align="left"><b>Client History</b></td>
	<td align="left"><b><a href="list_clients.php?sort=nm">Client Name</a></b></td>
	<td align="left"><b><a href="list_clients.php?sort=ct">City</a></b></td>
	<td align="left"><b><a href="list_clients.php?sort=st">State</a></b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="edit_client.php?id=' . $row['clientid'] . '">Edit</a></td>
		<td align="left"><a href="delete_user.php?id=' . $row['clientid'] . '">Delete</a></td>
		<td align="left"><a href="open_ticket.php?id=' . $row['clientid'] . '">Open New Ticket</a></td>
		<td align="left"><a href="view_tickets.php?id=' . $row['clientid'] . '">View Support History</a></td>
		<td align="left"><a href="client_summary.php?id=' . $row['clientid'] . '">' . $row['client_name'] . '</a></td>
		<td align="left">' . $row['client_city'] . '</td>
		<td align="left">' . $row['client_state'] . '</td>
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
		echo '<a href="list_clients.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="list_clients.php?s=' . (($display * ($i - 1))) . '&p=' . $pages .  '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="list_clients.php?s=' . ($start + $display) . '&p=' . $pages .  '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p></div>'; // Close the paragraph.
	
} // End of links section.

?>

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
</body>
</html>

