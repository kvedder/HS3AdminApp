<?php
require ('connect.php'); 
$memberid = 'PA4';

$q = "SELECT * FROM clients WHERE memberid='$memberid';";		
			$r = @mysqli_query ($dbc, $q);

			if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.
			 
				// Get the user's information:
				$row = mysqli_fetch_array($r);
				var_dump($row);
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
		}

				?>