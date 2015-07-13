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

<h2>Manage Client Media Entries</h2>

<h4>List All Entries of Type:</h4>
<form name="search_entries" action="search_entries.php" method="get">
<input type="radio" name="mediatype" value="VOD" checked>VOD Entries
<br>
<input type="radio" name="mediatype" value="live">Live Entries


<h4>Choose Client:</h4>

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