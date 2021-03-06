
<?php

include_once('connect.php');
include('functions.php');
include('./inc/cleeng/cleeng_api.php');

//var_dump($_POST['tags']);

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) )  { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
//include footer maybe
	exit();
}

$offerid = $_GET['offer'];


$config = getClientConfig($id);

//get the offer

$cleengApi = new Cleeng_Api();
    if (cleeng_sandbox == '1') {
	$cleengApi->enableSandbox();
	$cleengApi->setPublisherToken(cleeng_sandbox_token);
	} else {
	$cleengApi->setPublisherToken(cleeng_token);
	}

    $offer = $cleengApi->getPassOffer($offerid);
    if ($offer->id) {
    	Echo "Subscription Offer Retrieved Sucessfully.";
    	echo $config['clientid'];
    	    } else {
    	echo "ERROR.";
    }

    //r_dump($offer);
	$tagslist = array();
    $tagslist = $offer->accessToTags;
    //var_dump($tagslist);

   

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

<h2>Create New Subscription Offer:</h2>

<form action="update_offer.php" method="post">
<input type="hidden" name="clientid" value="<?php echo $id; ?>" />
<p>Offer ID: <input type="hidden" name="offerid" value="<?php echo $offerid; ?>" /><?php echo $offerid; ?></p>
<p>Offer Title: <input type="text" name="title" size="60" maxlength="60" value="<?php echo $offer->title; ?>" /></p>
<p>URL: <input type="text" name="url" size="60" maxlength="60" value="<?php echo $offer->url; ?>" /></p>
<p>Price: <input type="text" name="price" size="60" maxlength="60" value="<?php echo $offer->price; ?>" /></p>
<p>Offer Description: <input type="text" name="desc" size="120" maxlength="120" value="<?php echo $offer->description; ?>" /></p>

<h4>Add Tags:</h4>
<?php
$cats = getClientCategories($config['clientid']);
foreach ($cats as $cat) {
	# code...
?>
<input type="checkbox" name="tags[]" value="<?php echo $cat['slug'] ?>" 
<?php foreach ($tagslist as $tag ) {
	if ($tag == $cat['name']) {
		echo 'checked';
	}
	
}
?>
/><?php echo $cat['name']; ?> <br />

<?php
}
?>
<input type="checkbox" name="tags[]" value="Year-2015" />2015-2016 <br />
<input type="checkbox" name="tags[]" value="Year-2016" />2016-2017 <br />

<input type="checkbox" name="tags[]" value="fall" />Fall <br />
<input type="checkbox" name="tags[]" value="winter" />Winter <br />
<input type="checkbox" name="tags[]" value="spring" />Spring <br />

<input class="create-button" type="submit" value="Update Offer" tabindex="6" id="submit" name="submit" />
<input type="hidden" name="newoffer" value="post" /> 

</form>

</div>

</body>
</html>