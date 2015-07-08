<?php

// functions.php


function getClients() {

// gets list of client id's and names and returns them at the end of the function

include('connect.php');
$query = "SELECT clientid, client_name FROM clients ORDER BY client_name";
$result = mysqli_query ($dbc, $query); // Run the query.

return $result;

}


?>