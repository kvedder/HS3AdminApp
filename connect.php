<?php

//turn cleeng sandbox on and off
define('cleeng_sandbox', '1');

DEFINE ('dbuser', 'wtlw');
DEFINE ('dbpassword', 'KirkSpock44#1');
DEFINE ('dbhost', 'wtlw-sql.cyvcuoxnhamv.us-east-1.rds.amazonaws.com');
if (cleeng_sandbox == 0) {
	DEFINE ('dbname', 'hs3');
} else {
	DEFINE ('dbname', 'hs3_sandbox');
}


//connect to the database

$dbc = mysqli_connect(dbhost, dbuser, dbpassword, dbname) or die('Error connecting to Database!' . mysqli_connect_error() );

//set the mysql encoding	

mysqli_set_charset($dbc, 'utf8');

//turn cleeng sandbox on and off
define('cleeng_sandbox', '0');
//set sandbox token
define('cleeng_sandbox_token', 'RrqDJhkbxJA9g9W7QQ2SW3BJLdALJgxPBlf9pj5W8NIPJ_Fh');
define('cleeng_token', 'LKL4ZSQhJHNnGLizJAioriOWwV0gbZaSaOKdB28uUVAuhiwj');
?>

