<?php
//connect the server
$con = mysql_connect ( "localhost", "root", "lyh1023nm" );
if (! $con) {
	die ( 'Could not connect: ' . mysql_error () );
}

//set the character for the link
if (!mysql_set_charset ( 'utf8', $con )) {
	mysql_close ( $con );
	die ( 'Error: ' . mysql_error () );
}

//select the database
mysql_select_db ( "stock", $con );
