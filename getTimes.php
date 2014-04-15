<?php
// get db connect
require 'db_connect.php';

// get the trade code
$sql = "SELECT * from times";
$result = mysql_query ( $sql, $con );

// put the record to an array
$times = array ();
while ( $item = mysql_fetch_array ( $result ) ) {
	//put the record to record array
	$times[$item[code]] = $item[times];
}
mysql_close ( $con );

// echo $times[cu];
//return the array
$json = json_encode($times);
echo $json;
?>
