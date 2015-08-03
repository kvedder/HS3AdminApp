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
$client_state = 'OH';
			//generate the unique member ID

		$q = "SELECT * from clients where LEFT(memberid , 2) = '$client_state';"; //search the db by state
		$r = @mysqli_query ($dbc, $q); //run the query
		$client_count = mysqli_num_rows($r); //get count of clients from that state currently
		$next_num = $client_count + 1; //increase count by 1 for next client
		$num_padded = sprintf("%02d", $next_num);  //always make sure single digits have a 0 in front
		$memberid = $client_state . $num_padded; //generate new name
			echo 'the next client will be ' . $memberid . '!';

			


require('connect.php');
$q = "CREATE TABLE `$memberid-videos` (
  `asset_id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_title` varchar(100) DEFAULT NULL,
  `wp_post_id` int(11) DEFAULT NULL,
  `kt_entry_id` varchar(45) DEFAULT NULL,
  `kt_ref_id` varchar(45) DEFAULT NULL,
  `cleeng_offer_id` varchar(45) DEFAULT NULL,
  `cleeng_price` varchar(45) DEFAULT NULL,
  `cleeng_offer_type` varchar(45) DEFAULT NULL,
  `game_date` varchar(45) DEFAULT NULL,
  `home_score` int(11) DEFAULT NULL,
  `away_score` int(11) DEFAULT NULL,
  `asset_type` varchar(45) DEFAULT NULL,
  `clip_attached` int(11) DEFAULT NULL,
  `category` varchar(45) DEFAULT NULL,
  `game_start_time` time DEFAULT NULL,
  `from_live` int(3) DEFAULT NULL,
  PRIMARY KEY (`asset_id`),
  UNIQUE KEY `asset_id_UNIQUE` (`asset_id`)
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=latin1 COMMENT='master list of assets for hs3 customer';
";
if (mysqli_query ($dbc, $q)) {

	echo "Database created succesfully!";
} else {
    echo "Error creating database: " . mysqli_error($conn);
}

		?>
