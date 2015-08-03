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

echo '<h1>Edit a Client</h1>';
echo '<h3>Primary Contact Information</h3>';

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

require ('connect.php'); 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
	// Check for a first name:
	if (empty($_POST['client_name'])) {
		$errors[] = 'You forgot to enter the clients name.';
	} else {
		$client_name = mysqli_real_escape_string($dbc, trim($_POST['client_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['client_city'])) {
		$errors[] = 'You forgot to enter the city.';
	} else {
		$client_city = mysqli_real_escape_string($dbc, trim($_POST['client_city']));
	}

	// Check for an email address:
	if (empty($_POST['client_state'])) {
		$errors[] = 'You forgot to enter the state.';
	} else {
		$client_state = mysqli_real_escape_string($dbc, trim($_POST['client_state']));
	}

//set the rest of the variables
$client_zip = mysqli_real_escape_string($dbc, trim($_POST['client_zip']));
$client_phone = mysqli_real_escape_string($dbc, trim($_POST['client_phone']));
$client_email = mysqli_real_escape_string($dbc, trim($_POST['client_email']));
$client_fname = mysqli_real_escape_string($dbc, trim($_POST['client_fname']));
$client_lname = mysqli_real_escape_string($dbc, trim($_POST['client_lname']));
$client_address = mysqli_real_escape_string($dbc, trim($_POST['client_address']));
$admin_url = mysqli_real_escape_string($dbc, trim($_POST['admin_url']));
$dbhost = mysqli_real_escape_string($dbc, trim($_POST['dbhost']));
$dbname = mysqli_real_escape_string($dbc, trim($_POST['dbname']));
$dbuser = mysqli_real_escape_string($dbc, trim($_POST['dbuser']));
$dbpass = mysqli_real_escape_string($dbc, trim($_POST['dbpass']));
$kadmin_secret = mysqli_real_escape_string($dbc, trim($_POST['kadmin_secret']));
$kaltura_url = mysqli_real_escape_string($dbc, trim($_POST['kaltura_url']));
$kaltura_pid = mysqli_real_escape_string($dbc, trim($_POST['kaltura_pid']));
$kplayer = mysqli_real_escape_string($dbc, trim($_POST['kplayer']));
$memberid = mysqli_real_escape_string($dbc, trim($_POST['memberid']));
$stream_server = mysqli_real_escape_string($dbc, trim($_POST['stream_server']));
$wp_blogid = mysqli_real_escape_string($dbc, trim($_POST['wp_blogid']));
$wp_url = mysqli_real_escape_string($dbc, trim($_POST['wp_url']));
$xml_path = mysqli_real_escape_string($dbc, trim($_POST['xml_path']));

$user_id = mysqli_real_escape_string($dbc, trim($_POST['user_id']));
$pass = mysqli_real_escape_string($dbc, trim($_POST['pass']));
$email = mysqli_real_escape_string($dbc, trim($_POST['email']));



	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		//$q = "SELECT clientid FROM users WHERE email='$e' AND user_id != $id";
		//$r = @mysqli_query($dbc, $q);
		//if (mysqli_num_rows($r) == 0) 

	{
	

			// Make the query:
			$q = "UPDATE `hs3`.`users` SET `user_id` = '$user_id',`email` = '$email' WHERE client_id='$id' LIMIT 1";

			$r = @mysqli_query ($dbc, $q);

			$affected = mysqli_affected_rows ($dbc);

			//check to see if the record exists
			$q2 = "SELECT * FROM clients WHERE clientid='$id'";		
			$r2 = @mysqli_query ($dbc, $q2);	


			if ($affected == 1 ) { // If it ran OK.

				// Print a message:
				echo '<p><strong>The login info has been updated and changes were saved.</strong></p>';	
				
			} elseif ($affected  == 0 AND mysqli_num_rows($r2) == 1) {

					// Print a message:
				echo '<p><strong>The login info has been updated, but no changes were requested.</strong></p>';

			} else {

			 // If it had nothing to update because nothing changed
				echo '<p class="error"><strong>The user could not be edited due to a system error. We apologize for any inconvenience.</strong></p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}

			//------------------------------------------------------------------------------------------------------------------------

			// Make the query:
			$q = "UPDATE `hs3`.`clients` SET `dbhost` = '$dbhost',`dbuser` = '$dbuser',`dbpass` = '$dbpass',`dbname` = '$dbname',`kaltura_url` = '$kaltura_url',`admin_url` = '$admin_url',`kaltura_pid` = '$kaltura_pid',`kadmin_secret` = '$kadmin_secret',`kplayer` = '$kplayer',`memberid` = '$memberid',`wp_url` = '$wp_url',`wp_blogid` = '$wp_blogid',`stream_server` = '$stream_server',`xml_path` = '$xml_path',`client_name` = '$client_name',`client_fname` = '$client_fname',`client_lname` = '$client_lname',`client_address` = '$client_address',`client_city` = '$client_city',`client_state` = '$client_state',`client_zip` = '$client_zip',`client_email` = '$client_email',`client_phone` = '$client_phone' WHERE clientid='$id' LIMIT 1";

			$r = @mysqli_query ($dbc, $q);

			$affected = mysqli_affected_rows ($dbc);

					//check to see if the record exists
			$q2 = "SELECT * FROM users WHERE client_id='$id'";		
			$r2 = @mysqli_query ($dbc, $q2);	


			if ($affected == 1) { // If it ran OK.

				// Print a message:
				echo '<p><strong>The client information and software config has been updated and changes were saved.</strong></p>';	
				
			} elseif ( $affected == 0 AND mysqli_num_rows($r2) == 1 ) {

				// Print a message:
				echo '<p><strong>The cclient information and software config has been updated, but no changes were requested.</strong></p>';

			} else { // If it did not run OK.

				echo '<p class="error"><strong>The client information and software configF could not be edited due to a system error. We apologize for any inconvenience.</strong></p>'; // Public message.
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
$q = "SELECT * FROM clients WHERE clientid=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
 
	// Get the user's information:
	$row = mysqli_fetch_array ($r);

// Retrieve the user's information:
$q = "SELECT * FROM users WHERE client_id=$id";		
$r = @mysqli_query ($dbc, $q);


 
	// Get the user's information:
	$user = mysqli_fetch_array ($r);
	
// Create the form:
	echo '<form action="edit_client.php" method="post">
<p>Client School Name: <input type="text" name="client_name" size="60" maxlength="60" value="' . $row['client_name'] . '" /></p>
<p>Client Primary Contact First Name: <input type="text" name="client_fname" size="60" maxlength="60" value="' . $row['client_fname'] . '" /></p>
<p>Client Primary Contact Last Name: <input type="text" name="client_lname" size="45" maxlength="60" value="' . $row['client_lname'] . '" /></p>
<p>Client State: <input type="text" name="client_state" size="30" maxlength="60" value="' . $row['client_state'] . '"  /> </p>
<p>Address: <input type="text" name="client_address" size="60" maxlength="60" value="' . $row['client_address'] . '" /></p>
<p>City: <input type="text" name="client_city" size="60" maxlength="60" value="' . $row['client_city'] . '" /></p>
<p>State: <input type="text" name="client_state" size="60" maxlength="60" value="' . $row['client_state'] . '" /></p>
<p>Zip Code: <input type="text" name="client_zip" size="60" maxlength="60" value="' . $row['client_zip'] . '" /></p>
<p>Contact E-Mail: <input type="text" name="client_email" size="60" maxlength="60" value="' . $row['client_email'] . '" /></p>
<p>Contact Phone: <input type="text" name="client_phone" size="60" maxlength="60" value="' . $row['client_phone'] . '" /></p>
<br><br>
<h3>Software Configuration</h3>

<p>HS3 Member ID: <input type="text" name="memberid" size="60" maxlength="60" value="' . $row['memberid'] . '" /></p>
<p>MySQL DB Hostname: <input type="text" name="dbhost" size="60" maxlength="60" value="' . $row['dbhost'] . '" /></p>
<p>MySQL DB User: <input type="text" name="dbuser" size="60" maxlength="60" value="' . $row['dbuser'] . '" /></p>
<p>MySQL DB Password: <input type="text" name="dbpass" size="60" maxlength="60" value="' . $row['dbpass'] . '" /></p>
<p>MySQL DB Name: <input type="text" name="dbname" size="60" maxlength="60" value="' . $row['dbname'] . '" /></p>
<p>Admin Interface URL: <input type="text" name="admin_url" size="60" maxlength="60" value="' . $row['admin_url'] . '" /></p>
<p>Kaltura Server Url: <input type="text" name="kaltura_url" size="60" maxlength="60" value="' . $row['kaltura_url'] . '" /><br><i> I.E. http://video.wtlw.com/</i></p>
<p>Kaltura Client ID: <input type="text" name="kaltura_pid" size="60" maxlength="60" value="' . $row['kaltura_pid'] . '" /><br><i> I.E. 101</i></p>
<p>Kaltura Admin API Secret: <input type="text" name="kadmin_secret" size="60" maxlength="60" value="' . $row['kadmin_secret'] . '" /></p>
<p>Kaltura Primary Player ID: <input type="text" name="kplayer" size="60" maxlength="60" value="' . $row['kplayer'] . '" /></p>
<p>Wordpress URL TO XMLRPC: <input type="text" name="wp_url" size="60" maxlength="60" value="' . $row['wp_url'] . '" /></p>
<p>Wordpress Blog ID: <input type="text" name="wp_blogid" size="60" maxlength="60" value="' . $row['wp_blogid'] . '" /></p>
<p>Wowza Server URL: <input type="text" name="stream_server" size="60" maxlength="60" value="' . $row['stream_server'] . '" /><br><i> I.E. http://streamengine.wosn.tv:1935/</i></p>
<p>Relative Path Where FMLE XML Files: <input type="text" name="xml_path" size="60" maxlength="60" value="' . $row['xml_path'] . '" /></p>

<h3>Login Info</h3>
<p>User Name: <input type="text" name="user_id" size="60" maxlength="60" value="' . $user['user_id'] . '" /></p>

<p>E-mail: <input type="text" name="email" size="60" maxlength="60" value="' . $user['email'] . '" /></p>

<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';
echo "<a href='list_clients.php'>Go Back to Client List.</a>";
} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
		
//include ('includes/footer.html');
?>
</div>
</body>
</html>