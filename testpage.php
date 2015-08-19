<?php

/*
require_once('./inc/cleeng/cleeng_api.php');
require ('connect.php'); 



$cleengApi = new Cleeng_Api();
$email = 'lcc@hs3.tv';
$cleengApi->setDistributorToken('LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj');		
	$result = $cleengApi->getAssociate($email);

		var_dump($result);
?>


<br><br><br>


Associate ID: <?php echo $result->id; ?><br>
Email: <?php echo $result->email; ?><br>
Currency: <?php echo $result->currency; ?><br>
Locale: <?php echo $result->locale; ?><br>
Country: <?php echo $result->country; ?><br>
First Name:<?php echo $result->firstName; ?><br>
Last Name :<?php echo $result->lastName; ?><br>
Site Name: <?php echo $result->siteName; ?><br>
Publisher Data: <?php echo $result->publisherData; ?><br>
License Type: <?php echo $result->licenseType; ?><br>
Pending? <?php echo $result->pending; ?><br>
Site URL: <?php echo $result->siteUrl; ?><br>

<?php

$q  = "INSERT INTO cleeng_associates (email, currency, firstname, lastname, sitename, siteurl, locale, country, licenseType ) VALUES ('$result->email', '$result->currency', '$result->firstName', '$result->lastName', '$result->siteName', '$result->siteUrl', '$result->locale', '$result->country', '$result->licenseType');";
mysqli_query ($dbc, $q);
if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p><strong>The client has been added.</strong></p>';	
				
			} else { // If it did not run OK.
				echo '<p class="error">The user could not be added due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}

*/

	require_once('./inc/cleeng/cleeng_api.php');		

$cleengApi = new Cleeng_Api();
//$email = 'lcc@hs3.tv';
//$cleengApi->setDistributorToken('LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj');		
	$result = $cleengApi->listAssociates('LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj');

		var_dump($result);
		?>