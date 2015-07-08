
<?php

include('connect.php');
include('./inc/cleeng/cleeng_api.php');


$cleengApi = new Cleeng_Api();
$cleengApi->setPublisherToken('LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj');
$offerList = $cleengApi->listSubscriptionOffers(array(), 0, 5);

?>

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include('menu.php'); ?>
<div id="content">
<h2>Master List of Active Subscription Offers</h2>
<?php

$totalOffers = $offerList->totalItemCount;
echo 'There are ' . $totalOffers . ' total offers.<br><br>';
echo var_dump($offerList); //this is the raw response to be decoded
echo '<br><br>';

echo '<br><br>';

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

foreach ($offerList->items as $offer) {
	echo $offer->title . '<br>';
	echo $offer->id . '<br>';
	echo $offer->publisherEmail . '<br>';
	echo $offer->url . '<br>';
	echo $offer->description . '<br>';
	echo $offer->currency . '<br>';	
	echo '$' . $offer->price . '<br>';
	echo $offer->period . '<br>';	
	echo '<br>';
	echo '<hr>';
}

?>
</div>

</body>
</html>