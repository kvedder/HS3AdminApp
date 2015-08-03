<?php

/*

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


$q2 = "SELECT * FROM clients WHERE clientid='4'";	

			$r = @mysqli_query ($dbc, $q2);
			$num = mysqli_num_rows ($r);
			printf("Select returned %d rows.\n", mysqli_num_rows($r));
			*/
require('connect.php');
$client_state = 'OH';
			//generate the unique member ID

		$q = "SELECT * from clients where LEFT(memberid , 2) = '$client_state';"; //search the db by state
		$r = @mysqli_query ($dbc, $q); //run the query
		$client_count = mysqli_num_rows($r); //get count of clients from that state currently
		$next_num = $client_count + 1; //increase count by 1 for next client
		$num_padded = sprintf("%02d", $next_num);  //always make sure single digits have a 0 in front
		$newname = $client_state . $num_padded; //generate new name
			echo 'the next client will be ' . $newname . '!';
		?>
