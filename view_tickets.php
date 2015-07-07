<?php 
##########################################################################
##																		##
## WTLW/WOSN Client Management Application  -  list_clients.php         ##
## This page will display all of the clients that are signed up for     ##
## the WOSN/HS3 partership. The results will be paginated 10 at a time. ##
##																		##
##########################################################################


include('connect.php');

//assign client to variable
$client = $_GET['id'];

//get client name
$getname = "SELECT client_name FROM clients WHERE clientid='$client'";
$nameresult = mysqli_query($dbc, $getname);
$namerow = mysqli_fetch_array($nameresult, MYSQLI_NUM);
$clientname = $namerow[0];

//num of records to show
$display = 2;

//figure out how may pages there are
// determine if the pages is already being requested
// next line starts 'p' if
if (isset($_GET['p']) && is_numeric ($_GET['p'])) {

	$pages = $_GET['p'];

} else {
	
//figure out how many records there will be in total

$q = "SELECT COUNT(ticketid) FROM tickets WHERE ticket_client='$client'";

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
		$order_by = 'ticket_status DESC';
		break;
	default:
		$order_by = 'created_date ASC';
		$sort = 'st';
		break;
}

// Define the query:
$q = "SELECT ticketid, ticket_title, assigned_to, ticket_status FROM tickets WHERE ticket_client='$client' ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

//Get client name

// Table header:
echo '<div id="menu"><h1>Main Menu</h1><br>Dashboard<br>Tickets<br>Clients<br>Options<br>Users<br>Logout</div>

<div id="content">
<h1>Tickets Open for ' . $clientname . '</h1>
<table align="center" cellspacing="0" cellpadding="5" width="75%">
<tr>
	<td align="left"><b>Ticket Title</b></td>
	<td align="left"><b>Assigned To</b></td>
	<td align="left"><b>Status</b></td>
</tr>
';

// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left">' . $row['ticket_title'] . '</td>
		<td align="left">' . $row['assigned_to'] . '</td>
		<td align="left">' . $row['ticket_status'] . '</td>
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
		echo '<a href="view_tickets.php?id=' . $client . 's=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="view_tickets.php?id=' . $client . '&s=' . (($display * ($i - 1))) . '&p=' . $pages .  '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="view_tickets.php?id=' . $client . '&s=' . ($start + $display) . '&p=' . $pages .  /*'&sort=' . $sort .*/ '">Next</a>';
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

