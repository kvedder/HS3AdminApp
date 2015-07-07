<?php

DEFINE ('dbuser', 'wtlw');
DEFINE ('dbpassword', 'KirkSpock44#1');
DEFINE ('dbhost', 'wtlw-sql.cyvcuoxnhamv.us-east-1.rds.amazonaws.com');
DEFINE ('dbname', 'hs3');

//connect to the database

$dbc = mysqli_connect(dbhost, dbuser, dbpassword, dbname) or die('Error connecting to Database!' . mysqli_connect_error() );

//set the mysql encoding	

mysqli_set_charset($dbc, 'utf8');

?>