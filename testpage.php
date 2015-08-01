<?php



function delete_client($clientid) {
require('connect.php');
	//delete all ticket updates
	$q = "SELECT * FROM tickets WHERE ticket_client = '$clientid';";
	$r = mysqli_query($dbc, $q);
	$row = mysqli_fetch_array ($r);
	foreach ($row as $rows ) {
		$ticketid = $rows['ticketid'];
		$q = "DELETE FROM ticket_updates WHERE parent_ticket = '$ticketid';";
	}

	//delete all tickets
	$q = "DELETE FROM tickets WHERE ticket_client = '$clientid';";
	$r = mysqli_query($dbc, $q);
	$row = mysqli_fetch_array ($r);

	//finally delete the client record
	$q = "DELETE FROM clients WHERE clientid = '$clientid'";
	if (!mysqli_query($dbc, $q))
			{
		die('Error: ' . mysql_error());
			}
		echo "1 record deleted.";
		echo "<script>window.location = 'list_assets.php'</script>";
}

delete_client(5);
?>