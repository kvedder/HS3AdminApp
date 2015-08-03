<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include('menu.php'); ?>

<?php # Script 10.3 - edit_user.php
// This page is for editing a user record.
// This page is accessed through view_users.php.

$page_title = 'Add a New Client';
?>
<div id="content">

<?php

echo '<h1>Add a Client</h1>';
echo '<h3>Primary Contact Information</h3>';

/* Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
//include footer maybe
	exit();
} */

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

// generate the uniqure member ID
		$q = "SELECT * from clients where LEFT(memberid , 2) = '$client_state';"; //search the db by state
		$r = @mysqli_query ($dbc, $q); //run the query
		$client_count = mysqli_num_rows($r); //get count of clients from that state currently
		$next_num = $client_count + 1; //increase count by 1 for next client
		$num_padded = sprintf("%02d", $next_num);  //always make sure single digits have a 0 in front
		$memberid = $client_state . $num_padded; //generate new name


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
$memberid = mysqli_real_escape_string($dbc, trim($memberid));
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

	

//figure out how many people are already clients from that state


//the following query will add the client info to the datbase
			// Make the query:
			$q = "INSERT INTO `hs3`.`clients` (`dbhost`,`dbuser`,`dbpass`,`dbname`,`kaltura_url`,`admin_url`,`kaltura_pid`,`kadmin_secret`,`kplayer`,`memberid`,`wp_url`,`wp_blogid`,`stream_server`,`xml_path`,`client_name`,`client_fname`,`client_lname`,`client_address`,`client_city`,`client_state`,`client_zip`,`client_email`,`client_phone`) VALUES ('$dbhost', '$dbuser','$dbpass','$dbname','$kaltura_url','$admin_url','$kaltura_pid','$kadmin_secret','$kplayer','$memberid','$wp_url','$wp_blogid','$stream_server','$xml_path','$client_name','$client_fname','$client_lname','$client_address','$client_city','$client_state','$client_zip','$client_email','$client_phone')";
			//execute the query added client information
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p><strong>The client has been added.</strong></p>';	
				
			} else { // If it did not run OK.
				echo '<p class="error">The user could not be added due to a system error. We apologize for any inconvenience.</p>'; // Public message.
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

if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		//$q = "SELECT clientid FROM users WHERE email='$e' AND user_id != $id";
		//$r = @mysqli_query($dbc, $q);
		//if (mysqli_num_rows($r) == 0) 
	

//the following query will add the user info to the datbase
		//get the info just added
		// Retrieve the user's information:

			$q = "SELECT * FROM clients WHERE memberid='$memberid';";		
			$r = @mysqli_query ($dbc, $q);

			if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
			 
				// Get the user's information:
				$row = mysqli_fetch_array($r);
				//var_dump($row);
				$clientid = $row['clientid'];

			// Make the query:
			$q = "INSERT INTO users (user_id, pass, email, client_id ) VALUES ('$user_id', SHA1('$pass'), '$email', '$clientid');";
			//execute the query added client information
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p><strong>The user has been added.</strong></p>';	
				
			} else { // If it did not run OK.
				echo '<p class="error">The user could not be added due to a system error. We apologize for any inconvenience.</p>'; // Public message.
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

		
	
	 }// End of if (empty($errors)) IF.	




} // End of submit conditional.

// Always show the form...

/* Retrieve the user's information:
$q = "SELECT * FROM clients WHERE clientid=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
 
	// Get the user's information:
	$row = mysqli_fetch_array ($r); */
	
	// Create the form:
	echo '<form action="add_client.php" method="post">
<p>Client School Name: <input type="text" name="client_name" size="60" maxlength="60" value="' . $row['client_name'] . '" /></p>
<p>Client Primary Contact First Name: <input type="text" name="client_fname" size="60" maxlength="60" value="' . $row['client_fname'] . '" /></p>
<p>Client Primary Contact Last Name: <input type="text" name="client_lname" size="45" maxlength="60" value="' . $row['client_lname'] . '" /></p>

<p>Address: <input type="text" name="client_address" size="60" maxlength="60" value="' . $row['client_address'] . '" /></p>
<p>City: <input type="text" name="client_city" size="60" maxlength="60" value="' . $row['client_city'] . '" /></p>
<p>Client State: <select name="client_state">
	<option value="AL">Alabama</option>
	<option value="AK">Alaska</option>
	<option value="AZ">Arizona</option>
	<option value="AR">Arkansas</option>
	<option value="CA">California</option>
	<option value="CO">Colorado</option>
	<option value="CT">Connecticut</option>
	<option value="DE">Delaware</option>
	<option value="DC">District of Columbia</option>
	<option value="FL">Florida</option>
	<option value="GA">Georgia</option>
	<option value="HI">Hawaii</option>
	<option value="ID">Idaho</option>
	<option value="IL">Illinois</option>
	<option value="IN">Indiana</option>
	<option value="IA">Iowa</option>
	<option value="KS">Kansas</option>
	<option value="KY">Kentucky</option>
	<option value="LA">Louisiana</option>
	<option value="ME">Maine</option>
	<option value="MD">Maryland</option>
	<option value="MA">Massachusetts</option>
	<option value="MI">Michigan</option>
	<option value="MN">Minnesota</option>
	<option value="MS">Mississippi</option>
	<option value="MO">Missouri</option>
	<option value="MT">Montana</option>
	<option value="NE">Nebraska</option>
	<option value="NV">Nevada</option>
	<option value="NH">New Hampshire</option>
	<option value="NJ">New Jersey</option>
	<option value="NM">New Mexico</option>
	<option value="NY">New York</option>
	<option value="NC">North Carolina</option>
	<option value="ND">North Dakota</option>
	<option value="OH">Ohio</option>
	<option value="OK">Oklahoma</option>
	<option value="OR">Oregon</option>
	<option value="PA">Pennsylvania</option>
	<option value="RI">Rhode Island</option>
	<option value="SC">South Carolina</option>
	<option value="SD">South Dakota</option>
	<option value="TN">Tennessee</option>
	<option value="TX">Texas</option>
	<option value="UT">Utah</option>
	<option value="VT">Vermont</option>
	<option value="VA">Virginia</option>
	<option value="WA">Washington</option>
	<option value="WV">West Virginia</option>
	<option value="WI">Wisconsin</option>
	<option value="WY">Wyoming</option>
</select </p>
<p>Zip Code: <input type="text" name="client_zip" size="60" maxlength="60" value="' . $row['client_zip'] . '" /></p>
<p>Contact E-Mail: <input type="text" name="client_email" size="60" maxlength="60" value="' . $row['client_email'] . '" /></p>
<p>Contact Phone: <input type="text" name="client_phone" size="60" maxlength="60" value="' . $row['client_phone'] . '" /></p>
<br><br>
<h3>Software Configuration</h3>


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

<p>User Name: <input type="text" name="user_id" size="60" maxlength="60" value="' . $row['xml_path'] . '" /></p>
<p>Password: <input type="text" name="pass" size="60" maxlength="60" value="' . $row['xml_path'] . '" /></p>
<p>E-mail: <input type="text" name="email" size="60" maxlength="60" value="' . $row['xml_path'] . '" /></p>

<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';
echo "<a href='list_clients.php'>Go Back to Client List.</a>";

/* } else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
} */

mysqli_close($dbc);
		
//include ('includes/footer.html');
?>
</div>
</body>
</html>