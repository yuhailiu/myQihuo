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
	if ($quatity [0] != 0) {
		// get cost by the trade code
		$sql = "SELECT sum(trade_price * trade_quatity) from trade_record
		where trade_code = '$trade_code[trade_code]' and isClose='0'";
		$result_sum = mysql_query ( $sql, $con );
		$sum = mysql_fetch_row ( $result_sum );
		$cost_name [$i] [name] = $trade_code [name];
		$cost_name [$i][quatity] = $quatity[0];
		$cost_name [$i][trade_code] = $trade_code[trade_code];
		if ($sum [0] > 0) {
			
			$cost_name [$i] [cost] = $sum [0] / $quatity [0];
		} elseif ($sum [0] < 0) {
			$cost_name [$i] [cost] = - $sum [0] / $quatity [0];
		}
		$i++;
	}
}

// cost = sum(price * quatity) / quatity
mysql_close ( $con );
?>
<a href=".">Home</a>
<!-- show the result of cost by code -->
<fieldset>
	<legend>current cost of holding</legend>
	<table border="1" cellpadding="10">
		<tr>
			<th>name</th>
			<th>code</th>
			<th>cost</th>
			<th>quatity</th>
			<th>current price</th>
			<th>win_lost</th>
		</tr>
<?php
$i = 1;
foreach ( $cost_name as $item ) {
	$j = 1;
	$id = $i.$j;
	echo "<tr>
			<td id='$id'>$item[name]</td>";
	$j++;
	$id = $i.$j;
	echo "<td id='$id'>$item[trade_code]</td>";
	$j++;
	$id = $i.$j;
	echo "<td id='$id'>$item[cost]</td>";
	$j++;
	$id = $i.$j;
	echo "<td id='$id'>$item[quatity]</td>";
	$j++;
	$id = $i.$j;
	echo "<td><input id='$id'></td>";
	$j++;
	$id = $i.$j;
	echo "<td id='$id'>0</td>
		</tr>";
	$i++;
}
?>
</table>
<p>summary :<span id="summary">0</span></p>
<input type="hidden" id="item_num" value="<?php echo $i; ?>">
<button id="calculate_win_lost" style="margin-top : 20px;">calculate win_lost</button>
<button id="clear_webstorage" style="margin-top : 20px;">clear webstorage</button>
</fieldset>
<script src="js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="js/getCurrentHolding.js" type="text/javascript"></script>