<?php

include('connect.php');
include('./inc/cleeng/cleeng_api.php');

function getOffer($offerType, $offerId) {

	switch ($offerType) {
		case 'single' :
	
			$cleengApi = new Cleeng_Api();

   			$offerDetails = $cleengApi->getSingleOffer($offerId);

   			echo var_dump($offerDetails);

   			echo '<br><br><br>';

    		echo $offerDetails->title; //print the offer title
    		echo '<br>';
    		echo $offerDetails->id; //print the offer title
    		echo '<br>';
    		echo $offerDetails->description; //print the offer title
    		echo '<br>';
    		echo $offerDetails->price; //print the offer title
    		echo '<br>';
    		echo $offerDetails->url; //print the offer title
			echo '<br>';
    		echo $offerDetails->publisherEmail; //print the offer title
    		echo '<br>';
    		echo $offerDetails->active; //print the offer title
    		echo '<br';
    		//foreach ($offerDetails->tags as $tag) {
				//echo $tag . ", ";
				//}
		break;
		 
		case 'subscription' :

			$cleengApi = new Cleeng_Api();

    		$offerDetails = $cleengApi->getSubscriptionOffer($offerId);

    		echo var_dump($offerDetails);
    		echo '<br><br><br>';

   			echo $offerDetails->title; //print the offer title
   			echo '<br>';
   			echo $offerDetails->id; //print the offer title
    		echo '<br>';
    		echo $offerDetails->description; //print the offer title
    		echo '<br>';
    		echo $offerDetails->price; //print the offer title
    		echo '<br>';
    		echo $offerDetails->url; //print the offer title
			echo '<br>';
    		echo $offerDetails->publisherEmail; //print the offer title
    		echo '<br>';
    		echo $offerDetails->active; //print the offer title
    		echo '<br';

    	break;

    	case 'pass' :

			$cleengApi = new Cleeng_Api();

    		$offerDetails = $cleengApi->getPassOffer($offerId);

    		echo var_dump($offerDetails);
    		echo '<br><br><br>';


   			echo $offerDetails->title; //print the offer title
   			echo '<br>';
   			echo $offerDetails->id; //print the offer title
    		echo '<br>';
    		echo $offerDetails->description; //print the offer title
    		echo '<br>';
    		echo $offerDetails->price; //print the offer title
    		echo '<br>';
    		echo $offerDetails->url; //print the offer title
			echo '<br>';
    		echo $offerDetails->publisherEmail; //print the offer title
    		echo '<br>';
    		echo $offerDetails->active; //print the offer title
    		echo '<br';

    	break;

    	case 'bundle' :

			$cleengApi = new Cleeng_Api();

    		$offerDetails = $cleengApi->getBundleOffer($offerId);

    		echo var_dump($offerDetails);
    		echo '<br><br><br>';


   			echo $offerDetails->title; //print the offer title
   			echo '<br>';
   			echo $offerDetails->id; //print the offer title
    		echo '<br>';
    		echo $offerDetails->description; //print the offer title
    		echo '<br>';
    		echo $offerDetails->price; //print the offer title
    		echo '<br>';
    		echo $offerDetails->url; //print the offer title
			echo '<br>';
    		echo $offerDetails->publisherEmail; //print the offer title
    		echo '<br>';
    		echo $offerDetails->active; //print the offer title
    		echo '<br';

    	break;
	}
}

$offerId = $_GET['cleengid'];

$offerType = $_GET['type'];
	
getOffer( $offerType, $offerId );   