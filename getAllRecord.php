<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
// get db connect
require 'db_connect.php';

// get the trade code
$sql = "SELECT * from trade_record order by 'trade_time'";
$result = mysql_query ( $sql, $con );

// put the record to an array
$record = array ();
$i = 1;
while ( $item = mysql_fetch_array ( $result ) ) {
	// put the record to record array
	array_push ( $record, $item );
}

// cost = sum(price * quatity) / quatity
mysql_close ( $con );
?>
<a href=".">Home</a>
<!-- show the result of cost by code -->
<fieldset>
	<legend>All the trade record</legend>
	<table border="1" cellpadding="10">
		<tr>
			<th>code</th>
			<th>price</th>
			<th>quatity</th>
			<th>trade time</th>
			<th>isClose</th>
		</tr>
<?php
foreach ( $record as $item ) {
	$flag = $item[isClose] ? 'yes' : 'no';
	echo "<tr>
			<td>$item[trade_code]</td>
			<td>$item[trade_price]</td>
			<td>$item[trade_quatity]</td>
			<td>$item[trade_time]</td>
			<td>$flag</td>
		</tr>";
}
?>
</table>
</fieldset>
<p><button id="close_record">close record</button></p>
<script src="js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="js/getCurrentHolding.js" type="text/javascript"></script>