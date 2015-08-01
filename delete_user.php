

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include('menu.php'); ?>

<?php # Script 10.3 - edit_user.php
// This page is for editing a user record.
// This page is accessed through view_users.php.

$page_title = 'Edit a Client\'s Info';
?>
<div id="content">

<?php

require ('connect.php'); 

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

	//delete the login profile
	$q = "DELETE FROM users WHERE client_id = '$clientid';";
	$r = mysqli_query($dbc, $q);

	// delete the client record
	$q = "DELETE FROM clients WHERE clientid = '$clientid'";
	if (!mysqli_query($dbc, $q))
			{
		die('Error: ' . mysql_error());
			}
		echo "1 record deleted.";
		ob_end_flush();
		flush();
		usleep(2000000);
		echo "<script>window.location = 'list_clients.php'</script>";

}


// Retrieve the user's information:
$q = "SELECT * FROM clients WHERE clientid=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
 
	// Get the user's information:
	$row = mysqli_fetch_array ($r);

echo '<h1>Are you sure you want to delete ' . $row['client_name'] .  '?</h1>';
echo '<h3>Warning: This will delete all tickets, and ticket updates. Basically this client will never have existed in the system.</h3>';

}

if(isset($_POST['delete']))
{
   delete_client($id);

} 
?>
	</div>
<form action="" method="post" style="text-align:center;">
  <input type="submit" style="width:280px;"class="manage-button" value="Yes, I want to Delete." name="delete" />
 </form>
<form action="list_ass" style="text-align:center;">
    <input type="button" onclick="location.href='list_clients.php';" value="No, Go Back!" />
</form>


