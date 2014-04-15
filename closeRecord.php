<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
// get db connect
require 'db_connect.php';

// get the trade code
$sql = "SELECT * from trade_code";
$result = mysql_query ( $sql, $con );

// put the record to an array
$cost_name = array ();
$i = 1;
while ( $trade_code = mysql_fetch_array ( $result ) ) {
	// get the quatity by trad code
	$sql = "SELECT sum(trade_quatity) from trade_record
		where trade_code = '$trade_code[trade_code]' and isClose='0'";
	$result_quatity = mysql_query ( $sql, $con );
	$quatity = mysql_fetch_row ( $result_quatity );
	if ($quatity [0] == 0) {
		// update the record to close
		$sql = "UPDATE trade_record set isClose = '1' where trade_code = '$trade_code[trade_code]'";
		try {
			mysql_query ( $sql, $con );
		} catch (Exception $e) {
			mysql_close ( $con );
			echo false;
		}
	}
}

mysql_close ( $con );

echo true;
?>
