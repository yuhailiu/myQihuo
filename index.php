
<html lang="zh">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<p>Futures Management</p>
	<fieldset>
		<legend>code management</legend>
		<form action="code_management.php" method="post">
			<input placeholder="code" name="trade_code"><br> <input
				placeholder="code name" name="name"><br> <input type="submit">
		</form>
	</fieldset>
	<fieldset>
<?php 
//get the trade code from server
//get db connect
require 'db_connect.php';

//get all record from the table
$sql = "SELECT * from trade_code";
$result = mysql_query($sql, $con);
mysql_close ( $con );

?>
		<legend>trade record</legend>
		<form action="record_management.php" method="post">
			<select name="trade_code">
<?php
//show the select option
while ($trade_code = mysql_fetch_array($result)) {
	echo "<option value=".$trade_code['trade_code'].">".$trade_code['name']."</option>";
}
 ?>
			</select><br> 
			<input placeholder="trade_price" name="trade_price"><br> 
			<input placeholder="trade_quatity" name="trade_quatity"><br> 
			<input name="trade_time" value="<?php echo date('Y-m-d')?>"><br>
			<input type="submit"><br>
		</form>
	</fieldset>
	<br>
	<a href="getCurrentHolding.php">check the cost</a><br>
	<a href="getAllRecord.php">check all record</a><br>
	<a href="getCloseProfit.php">check profit of close deal</a><br>
</body>
</html>

<?php
