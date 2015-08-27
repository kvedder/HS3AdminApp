<?PHP
include_once('connect.php');
include('./inc/cleeng/cleeng_api.php');

$offerid = $_POST['offerid'];
$title = $_POST['title'];
$price = $_POST['price'];
$desc = $_POST['desc'];
$tags = $_POST['tags'];
$clientid = $_POST['clientid'];

	 $offerSetup = array(
	 'title' => $title,
    'price' => $price,
    'description' => $desc,
    'accessToTags' => $tags,
    );

    $cleengApi = new Cleeng_Api();

	if (cleeng_sandbox == '1') {
    $cleengApi->enableSandbox();
    $cleengApi->setPublisherToken(cleeng_sandbox_token);
    } else {
    $cleengApi->setPublisherToken(cleeng_token);
    }include_once('connect.php');
	
   $offer =  $cleengApi->updatePassOffer($offerid, $offerSetup);
    if ($offer->id) {
    	//header('edit_sub_offers.php');
    	Echo "Subscription Offer Updated Sucessfully.";    	
    	header('Location: list_offers.php?id='. $clientid);
    	    } else {
    	echo "ERROR.";
    }
   ?>