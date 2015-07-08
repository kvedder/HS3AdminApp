<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include('menu.php'); ?>
<div id="content">
<?php

include ('connect.php'); 

function getupdates($id) {

		include ('connect.php'); 

		//num of records to show
		$display = 5;

		//figure out how many records there will be in total

		$q = "SELECT COUNT(ticketid) FROM ticket_updates WHERE parent_ticket='$id' ";

		$r = mysqli_query($dbc, $q);


		$row = mysqli_fetch_array($r, MYSQLI_NUM);
		$records = $row[0];

		//calculate the total number of pages needed
		if ($records > $display) {
		$pages = ceil ($records/$display); // figures out pages by dividing then rounds up to the nearest integer

		} else {

		$pages = 1; // if there are less than the max number of records, then there will only be one page

		}

		 //end 'p' if

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
			default:
				$order_by = 'datetime ASC';
				$sort = 'st';
				break;
		}

		// Define the query:
		$query = "SELECT * FROM ticket_updates WHERE parent_ticket='$id' ORDER BY $order_by LIMIT $start, $display";		
		$result = @mysqli_query ($dbc, $query); // Run the query.

		// Table header:
		

		echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
		<tr>
			<td align="left"><b>Update Text</b></td>
			<td align="left"><b>Parent Ticket</b></td>
			<td align="left"><b>Date Update Created</b></td>
			<td align="left"><b><a href="update_clients.php?sort=nm">Created By User</a></b></td>
		</tr>
		';

		// Fetch and print all the records....
		$bg = '#eeeeee'; 
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
				echo '<tr bgcolor="' . $bg . '">
				<td align="left">' . $row['update_body'] . '</td>
				<td align="left">' . $row['parent_ticket'] . '</td>
				<td align="left">' . $row['datetime'] . '</td>
				<td align="left">' . $row['user'] . '</td>
			</tr>
			';
		} // End of WHILE loop.

		echo '</table>';
		mysqli_free_result($result);
		mysqli_close($dbc);

} //this ends the giant function that gets the updates and displays them

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
//include footer maybe
	exit();
}

//Get the ticket info from the DB
$query = "SELECT * FROM tickets WHERE ticketid='$id'";
$ticket_result = mysqli_query($dbc, $query);
$ticket_row = mysqli_fetch_array($ticket_result);


//Get Client Name to Display to the User
$client = $ticket_row['ticket_client'];

//echo $client; // displays clientid from table

$client_query = "SELECT * FROM clients WHERE clientid='$client'";
			     $client_result = mysqli_query($dbc, $client_query);
			     $client_row=mysqli_fetch_array($client_result);


// Check if the form has been submitted:
			     
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
		// Check for a last name:
	if (empty($_POST['ticket_update'])) {
		$errors[] = 'You forgot to add the update text.';
	} else {
		$ticket_update = mysqli_real_escape_string($dbc, trim($_POST['ticket_update']));
	}

	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		//$q = "SELECT clientid FROM users WHERE email='$e' AND user_id != $id";
		//$r = @mysqli_query($dbc, $q);
		//if (mysqli_num_rows($r) == 0) 
	

			// Make the query:
			$q = "INSERT INTO ticket_updates (parent_ticket, update_body, datetime) VALUES ('$id', '$ticket_update', NOW())";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>TThe ticket has been updated.</p>';	
				
			} else { // If it did not run OK.
				echo '<p class="error">The ticket could not be updated due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
	//	} else { // Already registered.
		//	echo '<p class="error">The email address has already been registered.</p>';
		
		
	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
		
		}

		} // End of if (empty($errors)) IF. */
?>

		<h2>Ticket Information:</h2>
		<form action="open_ticket.php" method="post">
			<p><b>Ticket Title:&nbsp;&nbsp;&nbsp;</b> <?php echo $ticket_row['ticket_title'];?></p>
			<p><b>For Client:&nbsp;&nbsp;&nbsp;</b> <?php echo $client_row['client_name'];?></p>
			<p><b>Issue Description:</b> </p>
			<p>
			<textarea rows="4" cols="50" name="ticket_message"><?php echo $ticket_row['ticket_message']; ?></textarea> 
			</p>			
			<a href="gohere.html">Edit Original Ticket Parameters</a><br>
			<p><input type="submit" name="submit" value="Submit" /></p>
			<input type="hidden" name="id" value="' . $id . '" />
		</form>

		<h2>Add An Update:</h2>
		<form name="add_update" action="update_ticket.php?id=<?php echo $id; ?>" method="post">
		<textarea rows="4" cols="50" name="ticket_update"></textarea>
		<br><input type="submit" name="submit" value="Submit" />
		</form>

		<h2>Previous Updates:</h2>
<?php getupdates($id); ?>
	</div>
	</body>
</html>