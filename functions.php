<?php

// functions.php


function getClients() {

// gets list of client id's and names and returns them at the end of the function

include('connect.php');
$query = "SELECT clientid, client_name, cleeng_email FROM clients ORDER BY client_name";
$result = mysqli_query ($dbc, $query); // Run the query.

return $result;

}


function getClientConfig($id) {

// gets list of client id's and names and returns them at the end of the function

include('connect.php');
$query = "SELECT * FROM clients WHERE clientid=$id";	
$result = mysqli_query ($dbc, $query); // Run the query.
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
return $row;

}

function getClientCategories($id) {

    //returns array with category information
		$config = getClientConfig($id);
        require_once("class-IXR.php");  
        $client = new IXR_Client($config['wp_url'] . '/xmlrpc.php');
        $blog_id = 5;
        $USER = 'hs3admin';
        $PASS = 'KirkSpock44#1';
        $taxonomy = 'category';

        if (!$client->query('wp.getTerms', $blog_id, $USER,$PASS, $taxonomy))
        {
            die( 'Error while updating post' . $client->getErrorCode() ." : ". $client->getErrorMessage());  
        }
        $postID =  $client->getResponse();
        return $postID;

}

?>