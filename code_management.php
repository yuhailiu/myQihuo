<?php
$tade_code = $_POST ['trade_code'];
$name = $_POST ['name'];

//get the db connect
require 'db_connect.php';

$sql = "INSERT INTO trade_code (trade_code, name)
VALUES ('$tade_code', '$name')";

if (! mysql_query ( $sql, $con )) {
	die ( 'Error: ' . mysql_error () );
}

mysql_close ( $con );

//return to index page
header('Location: http://localhost/~liuyuhai/stock/');


