<?php
include('./inc/cleeng/cleeng_api.php');
include_once('connect.php');
$offerSetup = array(
    'associateEmail' => 'testschool@hs3.tv',
    'title' =>'test title',
    'price' => '50',
    'url' => 'http://www.google.com',
    'description' =>  '',
    'period' => 'year',
    //'expiresAt' => $_POST['exp_date'],
    'accessToTags' => 'Football',
    
    );

    $cleengApi = new Cleeng_Api();
   
	$cleengApi->enableSandbox();
	$cleengApi->setPublisherToken(cleeng_sandbox_token);
	

    $offer = $cleengApi->createPassOffer($offerSetup);
    if ($offer->id) {
    	Echo "Pass Offer Created Sucessfully.";
    } else {
    	echo "ERROR.";
    }

   

   ?>