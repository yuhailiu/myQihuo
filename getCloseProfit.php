<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php
// get db connect
require 'db_connect.php';

// get the Times
$sql = "SELECT * from times";
$result = mysql_query ( $sql, $con );

// put the record to an array
$times = array ();
while ( $item = mysql_fetch_array ( $result ) ) {
	//put the record to record array
	$times[$item[code]] = $item[times];
}

//reg express for string
$reg = '/[a-z]+/';

// get the trade code
$sql = "SELECT * from trade_code order by 'trade_time'";
$result = mysql_query ( $sql, $con );

// put the records to an array
$i = 1;
$sum_profit = array();
while ( $trade_code = mysql_fetch_array ( $result ) ) {
	// get the profit by trad code
	$sql = "SELECT sum(trade_price*trade_quatity) from trade_record
		where trade_code = '$trade_code[trade_code]' and isClose='1'";
	$result_profit = mysql_query ( $sql, $con );
	$profit = mysql_fetch_row ( $result_profit );
	
	//when get the legal profit
	if($profit[0]){
		//get the code
		preg_match_all($reg, $trade_code[trade_code], $out_array);
		$code = $out_array[0][0];
		
		//profit by times
		$final_profit = -($profit[0]*$times[$code]);
		
		//push it to array
		$sum_profit[$i][name] = $trade_code[name];
		$sum_profit[$i][code] = $trade_code[trade_code];
		$sum_profit[$i][final_profit] = $final_profit;
		$i++;
	}
}

mysql_close ( $con );
?>
<a href=".">Home</a>
<!-- show the result of cost by code -->
<fieldset>
	<legend>profit of close order</legend>
	<table border="1" cellpadding="10">
		<tr>
			<th>code</th>
			<th>name</th>
			<th>final_profit</th>
		</tr>
<?php
foreach ( $sum_profit as $item ) {
	echo "<tr>
			<td>$item[code]</td>
			<td>$item[name]</td>
			<td>$item[final_profit]</td>
		</tr>";
}
?>
</table>
</fieldset>
<script src="js/jquery-1.9.1.js" type="text/javascript"></script>
<script src="js/getCurrentHolding.js" type="text/javascript"></script>