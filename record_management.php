<?php

//get the db connect
require 'db_connect.php';

//insert a record 
$sql = "insert into trade_record (trade_code, trade_price, trade_quatity, trade_time)
VALUES('$_POST[trade_code]', '$_POST[trade_price]','$_POST[trade_quatity]', '$_POST[trade_time]')";

// $sql = "insert into trade_record (trade_code, trade_price, trade_quatity, trade_time)
// VALUES('a1501', '4433', '2', '2014-04-12')";

if (! mysql_query ( $sql, $con )) {
	die ( 'Error: ' . mysql_error () );
}

mysql_close ( $con );

//return to index page
header('Location: http://localhost/~liuyuhai/stock/');
