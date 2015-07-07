<?php

include('connect.php');

//assign client to variable
$client = $_GET['id'];

//get client name
$getname = "SELECT client_name FROM clients WHERE clientid='$client'";
$nameresult = mysqli_query($dbc, $getname);
$namerow = mysqli_fetch_array($nameresult, MYSQLI_NUM);
$clientname = $namerow[0];

echo $client;
echo $clientname;

?>