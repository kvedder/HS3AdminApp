<?php

include('functions.php');

?>

<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php include('menu.php'); ?>
<div id="content">
<h2>Manage Cleeng Offers</h2>

<h4>List All Offers of Type:</h4>
<ul>
<li><a href="list_all_single_offers.php">All Single Offers</a></li>
<li><a href="list_asingle_offers.php">Active Single Offers</a></li>
<li><a href="list_dsingle_offers.php">Deactivated Single Offers</a></li>
<br>
<li><a href="list_all_sub_offers.php">All Subscription Offers</a></li>
<li><a href="list_asub_offers.php">Active Subscriptions</a></li>
<li><a href="list_dsub_offers.php">Deactivated Subscriptions</a></li>
<br>
<li><a href="list_all_pass_offers.php">All Pass Offers</a></li>
<li><a href="list_apass_offers.php">Active Pass Offers</a></li>
<li><a href="list_dpass_offers.php">Deactivated Pass Offers</a></li>
<br>
<li><a href="list_all_bundle_offers.php">All Bundle Offers</a></li>
<li><a href="list_abundle_offers.php">Deactivated Bundle Offers</a></li>
</ul>
<hr>
<h4>Search For Offer By ID:</h4>
<h6>Cleeng ID</h6>
<form name="search_cleengid" action="search_offer.php" method="get">
	<textarea rows="1" cols="15" name="cleengid"></textarea>
	<h6>Offer Type:</h6>
	<select name="type">
	  <option value="single">Single</option>
	  <option value="subscription">Subscription</option>
	  <option value="pass">Pass</option>
	  <option value="bundle">Bundle</option>
	</select>
	<br><br>
	<button type="submit" name="" />Search By CleengID</button>
</form>

<hr>
<h4>Show Offers for a Specific Client:</h4>
<h6>Offer Types:</h6>
<form name="search_cleengid" action="list_offer_by_client.php" method="get">
	<select name="type">
	  <option value="single">All</option>
	  <option value="single">Single</option>
	  <option value="subscription">Subscription</option>
	  <option value="pass">Pass</option>
	  <option value="bundle">Bundle</option>
	</select><br><br>
	<!-- show list of schools in select box -->
	<h6>Client:</h6>
	<select name="client">
	<?php
	$clients = getClients();


	while ($client = mysqli_fetch_array($clients, MYSQLI_ASSOC)) { 
	?>

		  <option value="<?php echo $client['clientid']; ?>"><?php echo $client['client_name']; ?></option>

	<?php } ?>
	</select>
	<!-- end show list of schools -->
	<br><br>
	<button type="submit" name="" />Search By Client</button>
</form>



</div>
</body>
</html>