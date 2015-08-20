
<?php

include_once('connect.php');
include('functions.php');
include('./inc/cleeng/cleeng_api.php');

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

$config = getClientConfig($id);

//get total item count
$cleengApi = new Cleeng_Api();
if (cleeng_sandbox == '1') {
	$cleengApi->enableSandbox();
	$cleengApi->setPublisherToken(cleeng_sandbox_token);
	} else {
	$cleengApi->setPublisherToken(cleeng_token);
	}
$offerOptions = array(
	'associateEmail' => $config['cleeng_email'],
	'active' => 1,
	);
$offerList = $cleengApi->listSubscriptionOffers($offerOptions, 0, 5);
$totalOffers = $offerList->totalItemCount;
echo 'There are ' . $totalOffers . ' total offers.<br><br>';

//get total number of api queries to get all results
$startCount = 0;
$totalRuns = $totalOffers / 50;
$totalRuns = ceil($totalRuns);

//set up array to hold returned offers

$masterOfferList  = array();

for ($i=0; $i < $totalRuns; $i++) { 
	
	$cleengApi = new Cleeng_Api();
	if (cleeng_sandbox == '1') {
	$cleengApi->enableSandbox();
	$cleengApi->setPublisherToken(cleeng_sandbox_token);
	} else {
	$cleengApi->setPublisherToken(cleeng_token);
	}
	$offerOptions = array(
	'associateEmail' => $config['cleeng_email'],
	'active' => 1,

	);
$offerList = $cleengApi->listSubscriptionOffers($offerOptions, $startCount, 50);

		foreach ($offerList->items as $offer) {
			$masterOfferList[] = $offer;
		}

	$startCount = $startCount + 50;
}
/*
foreach ($masterOfferList as $offer) {
	echo $offer->title . '<br>';
	echo $offer->id . '<br>';
	echo $offer->publisherEmail . '<br>';
	echo $offer->url . '<br>';
	echo $offer->description . '<br>';
	echo $offer->currency . '<br>';	
	echo $offer->price . '<br>';
	foreach ($offer->tags as $tag) {
		echo $tag . ", ";
	}
	echo '<br>';
	echo $offer->contentType . '<br>';
	echo '<hr>';
}
*/
?>

<hr>
old code resumes here
<?php
//old code resumes here
//get total list of offers
$cleengApi = new Cleeng_Api();
$cleengApi->setPublisherToken('LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj');
$offerOptions = array(
	'associateEmail' => $config['cleeng_email'],
	'active' => 1,
	);
$offerList = $cleengApi->listSubscriptionOffers($offerOptions, 0, 50);
$totalOffers = $offerList->totalItemCount;
echo 'There are ' . $totalOffers . ' total offers.<br><br>';
?>


<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src='./js/pajinate/jquery.pajinate.min.js'></script>
<script>
$(document).ready(function () {
	$("#page_container").pajinate();
	});
</script>
</head>
<body>
<?php include('menu.php'); ?>
<div id="wrapper">
<h2>Assign Client Subscription Offers</h2>
<?php


//echo var_dump($masterOfferList); //this is the raw response to be decoded
echo '<br><br>';

echo '<br><br>';

// use totaloffers to set the value for the array to make sure all offers are grabbed

/* this may be used for pagination
$count = 0;
while ($count < $totalOffers) {
	
	echo $offerList->items[$count]->title . '<br>';
	echo $offerList->items[$count]->id . '<br>';
//	echo $offer->publisherEmail . '<br>';
//	echo $offer->url . '<br>';
//	echo $offer->description . '<br>';
//	echo $offer->currency . '<br>';
//	echo $offer->price . '<br>';
//	echo $offer->tags[1] . '<br>';
//	echo $offer->contentType . '<br>';
	
	echo '<hr>';
	$count = $count + 1;

} */
?> 

<div id="page_container"style="border:1px solid #000;">
	<div id="header-row">
		<div class="table-header" style="width:20%;"> Offer Title </div>
		<div class="table-header" style="width:10%;">Offer ID</div>
		<div class="table-header" style="width:8%;">Email</div>
		<div class="table-header" style="width:11%;">URL</div>
		<div class="table-header" style="width:11%;">Date Created</div>
		<div class="table-header" style="width:12%;">Last Updated</div>
		<div class="table-header" style="width:3%;">Curr.</div>
		<div class="table-header" style="width:3%;">Price</div>
		<div class="table-header" style="width:8%;">Tags</div>
		<div class="table-header" style="width:4%;">Options</div>
		
	</div>
	<div class="content">
<?php
foreach ($masterOfferList as $offer) { ?>
		<div id="table-row" class="table-row">
			<div class="table-cell" style="width:20%;">
			<?php echo $offer->title;?>
			</div>
			<div class="table-cell" style="width:10%;">
			<?php echo $offer->id;?>
			</div>
			<div class="table-cell" style="width:8%;">
			<?php echo $offer->publisherEmail;?>
			</div>
			<div class="table-cell" style="width:11%;">
			<?php echo $offer->url;?>
			</div>
			<div class="table-cell" style="width:11%;">
			<?php 
				$dateconvert = $offer->createdAt;

				echo gmdate("m-d-Y", $dateconvert);
				?>
				<br>
				<?php 
				echo gmdate('TH:i:s\Z', $dateconvert);
			?>
			</div>
			<div class="table-cell" style="width:12%;">
			<?php 
				$dateconvert = $offer->updatedAt;

				echo gmdate("m-d-Y", $dateconvert);
				?>
				<br>
				<?php 
				echo gmdate('TH:i:s\Z', $dateconvert);
			?>
			</div>
			<div class="table-cell" style="width:3%;">
			<?php echo $offer->currency;?>
			</div>
			<div class="table-cell" style="width:3%;">	
			<?php echo $offer->price;?>
			</div>
			<div class="table-cell" style="width:8%;">
			<?php
			foreach ($offer->accessToTags as $tag) {
				echo $tag . ", ";
			}?>
			</div>
			<div class="table-cell" style="width:4%;">
			<a href="edit_sub_offer.php?id=<?php echo $id; ?>&offer=<?php echo $offer->id;?>">Edit Offer</a>
			</div>
			
		</div>
	
	<?php }; ?>
		
	</div>
	<div class="page_navigation"></div>
	</div>

</div>
<h2>Create New Subscription Offer:</h2>
<form action="edit_sub_offers.php?id=<?php echo $config['clientid']; ?>" method="post">
<p>Offer Title: <input type="text" name="title" size="60" maxlength="60" value="" /></p>
<p>URL: <input type="text" name="url" size="60" maxlength="60" value="" /></p>
<p>Price: <input type="text" name="price" size="60" maxlength="60" value="" /></p>
<p>Offer Description: <input type="text" name="desc" size="120" maxlength="120" value="" /></p>
<p>Expires on Date (unix date): <input type="text" name="exp_date" size="120" maxlength="120" value="" /></p>
<h4>Add Tags:</h4>
<?php
$cats = getClientCategories($id);
foreach ($cats as $cat) {
	# code...
?>
<input type="checkbox" name="tags[]" value="<?php echo $cat['slug'] ?>" /><?php echo $cat['name']; ?> <br />

<?php
}
?>
<input type="checkbox" name="tags[]" value="Year2015" />2015-2016 <br />
<input type="checkbox" name="tags[]" value="Year2016" />2016-2017 <br />

<input type="checkbox" name="tags[]" value="fall" />Fall <br />
<input type="checkbox" name="tags[]" value="winter" />Winter <br />
<input type="checkbox" name="tags[]" value="spring" />Spring <br />

<input class="create-button" type="submit" value="Create" tabindex="6" id="submit" name="submit" />
<input type="hidden" name="newoffer" value="post" /> 

</form>

</div>




<?php
if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['newoffer'] )) {

$offerSetup = array(
    'title' => $_POST['title'],
    'price' => $_POST['price'],
    'url' => $_POST['url'],
    'description' =>  $_POST['desc'],
    'period' => 'year',
    
    'accessToTags' => $_POST['tags'],
    'associateEmail' => $config['cleeng_email'],
    );

    $cleengApi = new Cleeng_Api();
    if (cleeng_sandbox == '1') {
	$cleengApi->enableSandbox();
	$cleengApi->setPublisherToken(cleeng_sandbox_token);
	} else {
	$cleengApi->setPublisherToken(cleeng_token);
	}

    $offer = $cleengApi->createSubscriptionOffer($offerSetup);
    if ($offer->id) {
    	Echo "S Offer Created Sucessfully.";
    } else {
    	echo "ERROR.";
    }

   }


if( 'POST' == $_SERVER['REQUEST_METHOD'] && !empty( $_POST['updateOffers'] )) {   

$offerTable = $config['memberid'] . '_static_offers';

$q = "TRUNCATE $offerTable ;";
	echo $q;
	//execute the query added client information
	$r = @mysqli_query ($dbc, $q);

// insert SQL query here to add sport cats to table 
	$num = 1;
	$i=0;


$dbc = mysqli_connect(dbhost, dbuser, dbpassword, dbname) or die('Error connecting to Database!' . mysqli_connect_error() );

foreach ($cats as $cat) {
	
	$sportname = $cat['slug'];
	$sportoffer = $_POST['sport_offer'][$i];
	echo $sportoffer . ", " . "sport, " . $sportname;
	$q = "INSERT INTO $offerTable (cleeng_id, offer_type, sport ) VALUES ('$sportoffer', 'sport', '$sportname');";
	echo $q;
	//execute the query added client information
	$r = @mysqli_query ($dbc, $q);
	if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

		// Print a message:
		echo '<p><strong>The sport offer has been added.</strong></p>';	
		
	} else { // If it did not run OK.
		echo '<p class="error">The sport offer could not be added due to a system error. We apologize for any inconvenience.</p>'; // Public message.
		echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		
		}
	
	$i++;
  }

	
// insert SQL query here to add 4 mains offers to table
  //replace with loop of come sort and get rid of multi query
	$allaccess = $_POST['allaccess'];
	$fallseason = $_POST['fallseason'];
	$winterseason = $_POST['winterseason'];
	$springseason = $_POST['springseason'];
	// Make the query:
	$offerTable = $config['memberid'] . '_static_offers';
	$q = "INSERT INTO $offerTable (cleeng_id, offer_type, sport ) VALUES ('$allaccess', 'all_access', 'NULL');";
	$q.= "INSERT INTO $offerTable (cleeng_id, offer_type, sport ) VALUES ('$fallseason', 'fall', 'NULL');";
	$q.= "INSERT INTO $offerTable (cleeng_id, offer_type, sport ) VALUES ('$winterseason', 'winter', 'NULL');";
	$q.= "INSERT INTO $offerTable (cleeng_id, offer_type, sport ) VALUES ('$springseason', 'spring', 'NULL');";

	//execute the query added client information
	$r = @mysqli_multi_query ($dbc, $q);
	//flush queries otherwise the rest wont work
 // flush multi_queries
	

	if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

		// Print a message:
		echo '<p><strong>The fixed offers have been assigned.</strong></p>';	
		
	} else { // If it did not run OK.
		echo '<p class="error">The offers could not be assigned due to a system error. We apologize for any inconvenience.</p>'; // Public message.
		echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		
	} //end sql verification IF 

	mysqli_close($dbc);

} // end post submit IF
    ?>
    
    <!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
	<!-- 						Create Offer Selector for Static Offers                                 -->
	<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->

<h2>Set Client Offers</h2>
<form action="edit_sub_offers.php?id=<?php echo $config['clientid']; ?>" method="post">
<p>Current All Access Offer: 
<select name="allaccess">
	<?php
foreach ($masterOfferList as $offer) { ?>

	<option name="allaccessoption" value = "<?php echo $offer->id; ?>" ><?php echo $offer->id . " - " . $offer->title; ?></option>
	<?php } ?>
</select></p>

<p>Current Fall Season Offer: 
<select name="fallseason">
	<?php
foreach ($masterOfferList as $offer) { ?>

	<option name="falloption" value = "<?php echo $offer->id; ?>" ><?php echo $offer->id . " - " . $offer->title; ?></option>
	<?php } ?>
</select></p>

<p>Current Winter Season Offer: 
<select name="winterseason">

	<?php
foreach ($masterOfferList as $offer) { ?>

	<option name="winteroption" value = "<?php echo $offer->id; ?>" ><?php echo $offer->id . " - " . $offer->title; ?></option>
	<?php } ?>
</select></p>

<p>Current Spring Season Offer: 
<select name="springseason">

	<?php
foreach ($masterOfferList as $offer) { ?>

	<option name="springoption" value = "<?php echo $offer->id; ?>" ><?php echo $offer->id . " - " . $offer->title; ?></option>
	<?php } ?>
</select></p>



<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->
<!-- 						Create Offer Selector for Each sport                                    -->
<!-- ////////////////////////////////////////////////////////////////////////////////////////////// -->

<h4>Individual Sport Offers</h4>
<?php
//create entry for each sport(category)
$num = 1;
foreach ($cats as $cat) {	
?>

	<p>Current <?php echo $cat['name']; ?> Sport Offer: 

	<select name="sport_offer[]">

	<?php foreach ($masterOfferList as $offer) { ?>

	<option name="<?php echo $cat['slug']; ?>" value = "<?php echo $offer->id; ?>" ><?php echo $offer->id . " - " . $offer->title; ?></option>
	<?php } ?>
	</select>
	</p>
	
<?php	$num = $num + 1; }	?>

<input class="create-button" type="submit" value="Set Offers Now!" tabindex="6" id="submit" name="submit" />
<input type="hidden" name="updateOffers" value="post" /> 
</form>

</body>
</html>