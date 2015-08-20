<?PHP

include('./inc/cleeng/cleeng_api.php');

$offerid = $_POST['offerid'];
$title = $_POST['title'];
$price = $_POST['price'];
$desc = $_POST['desc'];
$tags = $_POST['tags'];

	 $offerSetup = array(
	 'title' => $title,
    'price' => $price,
    'description' => $desc,
    'accessToTags' => $tags,
    );

    $cleengApi = new Cleeng_Api();

	
	$cleengApi->setPublisherToken('LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj');
	
   $offer =  $cleengApi->updateSubscriptionOffer($offerid, $offerSetup);
    if ($offer->id) {
    	//header('edit_sub_offers.php');
    	Echo "Subscription Offer Updated Sucessfully.";    	
    	
    	    } else {
    	echo "ERROR.";
    }
   ?>