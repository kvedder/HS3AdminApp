<?

class clientConfig {

CONST dbhost = 'wtlw-sql.cyvcuoxnhamv.us-east-1.rds.amazonaws.com';
CONST dbuser = 'wtlw';
CONST dbpass = 'KirkSpock44#1';
CONST dbname = 'hs3';

}

//connect to the database

$conn = mysqli_connect(clientConfig::dbhost, (clientConfig::dbuser, (clientConfig::dbpass, (clientConfig::dbname) or die('Error connecting to Database!' . mysqli_connect_error() );

//set the mysql encoding	

mysqli_set_charset($conn, 'utf8');

?>