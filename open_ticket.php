<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include('menu.php'); ?>
<div id="content">


<?php # HS3- open_ticket.php
// This page is for creating a new trouble ticket.
// This page is accessed through list_users.php.

$page_title = 'Open a New Support Ticket';

echo '<h1>Create a New Support Ticket</h1>';
//echo '<h3>Primary Contact Information</h3>';

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

include ('connect.php'); 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
	// Check for a first name:
	if (empty($_POST['ticket_title'])) {
		$errors[] = 'You forgot to enter the ticket title.';
	} else {
		$ticket_title = mysqli_real_escape_string($dbc, trim($_POST['ticket_title']));
	}
	
	// Check for a last name:
	if (empty($_POST['ticket_client'])) {
		$errors[] = 'You forgot to assign it to a client.';
	} else {
		$ticket_client = mysqli_real_escape_string($dbc, trim($_POST['id']));
	}

	// Check for an email address:
	if (empty($_POST['ticket_message'])) {
		$errors[] = 'You forgot to enter the trouble ticket information.';
	} else {
		$ticket_message = mysqli_real_escape_string($dbc, trim($_POST['ticket_message']));
	}

//set the rest of the variables
$assigned_to = mysqli_real_escape_string($dbc, trim($_POST['assigned_to']));
$created_date = mysqli_real_escape_string($dbc, trim($_POST['created_date']));
$ticket_status = mysqli_real_escape_string($dbc, trim($_POST['ticket_status']));
$created_ip = mysqli_real_escape_string($dbc, trim($_POST['created_ip']));



	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		//$q = "SELECT clientid FROM users WHERE email='$e' AND user_id != $id";
		//$r = @mysqli_query($dbc, $q);
		//if (mysqli_num_rows($r) == 0) 
	{

			// Make the query:
			$q = "INSERT INTO tickets (ticket_title, ticket_client, ticket_message, assigned_to, created_date, ticket_status, created_ip) VALUES ('$ticket_title', '$ticket_client', '$ticket_message', '$assigned_to', '$created_date', '$ticket_status', '$created_ip')";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>The ticket has been created.</p>';	
				
			} else { // If it did not run OK.
				echo '<p class="error">The ticket could not be created due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
	//	} else { // Already registered.
		//	echo '<p class="error">The email address has already been registered.</p>';
		}
		
	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
//$q = "SELECT * FROM clients WHERE clientid=$id";		
//$r = @mysqli_query ($dbc, $q);

//if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
 
	// Get the user's information:
//	$row = mysqli_fetch_array ($r);
	
//Get Client Name to Display to the User
$id = $_GET['id'];
$order = "SELECT * FROM clients WHERE clientid='$id'";
			      $result = mysqli_query($dbc, $order);
			     $row=mysqli_fetch_array($result);

	// Create the form:			     
	echo '<form action="open_ticket.php" method="post">
<p>Ticket Title: <input type="text" name="ticket_title" size="60" maxlength="60" value="' . $_POST['ticket_title'] . '" /></p>
<p>For Client: <input type="text" name="ticket_client" size="45" maxlength="60" value="';
if (isset($_POST['ticket_client'])) { 
	echo($_POST['ticket_client']);
 } else { echo $row['client_name']; } 
echo '" readonly/></p>
<p>Issue Description: <input type="text" name="ticket_message" size="30" maxlength="60" value="' . $_POST['ticket_message'] . '"  /> </p>
<p>Assigned to User: <input type="text" name="assigned_to" size="60" maxlength="60" value="' . 'User DropDown Here'  . '" readonly></p>
<p>Date Created: <input type="text" name="created_date" size="60" maxlength="60" value="' . date('n-j-Y') . '" /></p>
<p>Ticket Status: <input type="text" name="ticket_status" size="60" maxlength="60" value="' . '' . '" /></p>
<p>Created IP: <input type="text" name="created_ip" size="60" maxlength="60" value="' . '' . '" /></p>

<br><br>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';
echo "<a href='list_clients.php'>Go Back to Client List.</a>";

//} else { // Not a valid user ID.
//	echo '<p class="error">This page has been accessed in error.</p>';
//}

mysqli_close($dbc);
		
//include ('includes/footer.html');
?>
</div>
</body>
</html>