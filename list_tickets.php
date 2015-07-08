<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>


<?php 
##########################################################################
##																		##
## WTLW/WOSN Client Management Application  -  list_tickets.php         ##
## This page will display all of the support tickets that are submitted ##
## by WOSN/HS3 clients. The results will be paginated 10 at a time.     ##
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

$q = "SELECT COUNT(ticketid) FROM tickets";

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
		$order_by = 'ticket_status DESC';
		break;
	case 'ct':
		$order_by = 'created_date ASC';
		break;
	case 'st':
		$order_by = 'ticket_client ASC';
		break;
	default:
		$order_by = 'created_date ASC';
		$sort = 'st';
		break;
}

// Define the query:
$q = "SELECT ticketid, ticket_title, ticket_message, assigned_to, ticket_status, created_date, ticket_client FROM tickets ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.

// Table header:
include('menu.php');
echo '
<div id="content">
<h1>All Tickets</h1>
<table align="center" cellspacing="0" cellpadding="5" style="table-layout: fixed; width: 75%">
<tr>
	<td align="left"><b>Update</b></td>
	<td align="left"><b>Delete</b></td>
	<td align="left"><b>Ticket Subject</b></td>
	<td align="left"><b>Assigned To</b></td>
	<td align="left"><b><a href="list_tickets.php?sort=nm">Ticket Status</a></b></td>
	<td align="left"><b><a href="list_tickets.php?sort=ct">Date Created</a></b></td>
	<td align="left"><b><a href="list_tickets.php?sort=st">Client</a></b></td>
</tr>
';



// Fetch and print all the records....
$bg = '#eeeeee'; 
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

// get client text name to display to user instead of a number
	$clientid = $row['ticket_client'];
$order = "SELECT * FROM clients WHERE clientid='$clientid'";
			      $result = mysqli_query($dbc, $order);
			     $clientinfo=mysqli_fetch_array($result);

	$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
		echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="update_ticket.php?id=' . $row['ticketid'] . '">Update</a></td>
		<td align="left"><a href="delete_ticket.php?id=' . $row['ticketid'] . '">Delete</a></td>
		<td align="left" style="word-break:break-word;">' . $row['ticket_title'] . '</td>
		<td align="left">' . $row['assigned_to'] . '</td>
		<td align="left">' . $row['ticket_status'] . '</td>
		<td align="left">' . $row['created_date'] . '</td>
		<td align="left">' . $clientinfo['client_name'] . '</td>
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
		echo '<a href="list_tickets.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="list_tickets.php?s=' . (($display * ($i - 1))) . '&p=' . $pages .  '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="list_tickets.php?s=' . ($start + $display) . '&p=' . $pages .  '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p></div>'; // Close the paragraph.
	
} // End of links section.

?>


</body>
</html>

