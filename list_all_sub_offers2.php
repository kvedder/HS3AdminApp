
<?php

include('connect.php');
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
<h2>Master List of Single Offers</h2>
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
		<div class="table-header" style="width:19%;"> Offer Title </div>
		<div class="table-header" style="width:10%;">Offer ID</div>
		<div class="table-header" style="width:10%;">Email</div>
		<div class="table-header" style="width:13%;">URL</div>
		<div class="table-header" style="width:9%;">Date Created</div>
		<div class="table-header" style="width:10%;">Last Updated</div>
		<div class="table-header" style="width:3%;">Curr.</div>
		<div class="table-header" style="width:3%;">Price</div>
		<div class="table-header" style="width:8%;">Tags</div>
		
	</div>
	<div class="content">
<?php
foreach ($masterOfferList as $offer) { ?>
		<div id="table-row" class="table-row">
			<div class="table-cell" style="width:19%;">
			<?php echo $offer->title;?>
			</div>
			<div class="table-cell" style="width:10%;">
			<?php echo $offer->id;?>
			</div>
			<div class="table-cell" style="width:10%;">
			<?php echo $offer->publisherEmail;?>
			</div>
			<div class="table-cell" style="width:13%;">
			<?php echo $offer->url;?>
			</div>
			<div class="table-cell" style="width:9%;">
			<?php 
				$dateconvert = $offer->createdAt;

				echo gmdate("m-d-Y", $dateconvert);
				?>
				<br>
				<?php 
				echo gmdate('TH:i:s\Z', $dateconvert);
			?>
			</div>
			<div class="table-cell" style="width:10%;">
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
			
		</div>
	
	<?php }; ?>
		
	</div>
	<div class="page_navigation"></div>
	</div>

</div>
</div>

</body>
</html>