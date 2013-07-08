<?php	
	include 'config.php';
	
	$connection = mysql_connect($mysql_address,$mysql_username,$mysql_password);
	mysql_select_db($mysql_database, $connection);
		
	$query = "SELECT * FROM monsters WHERE id=".$_GET["id"];
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
			
	$id = $row[0];
	$name = $row[1];			
	$previousID = $id - 1;
	$nextID = $id + 1;
	
	$query = "SELECT name FROM monsters WHERE id=".$previousID;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$previousName = $row[0];
	
	$query = "SELECT name FROM monsters WHERE id=".$nextID;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$nextName = $row[0];
	
	$query = "SELECT locationId FROM monsterlocations WHERE monsterId=".$id." AND (gameSetId=11 or gameSetId=13)";
	$result = mysql_query($query);	
	$row = mysql_fetch_array($result);
		
	$whiteLocationName = "1";
	if (empty($row))
	{
		$whiteLocationName = "0";
	}
		
	$query = "SELECT locationId FROM monsterlocations WHERE monsterId=".$id." AND (gameSetId=11 or gameSetId=12)";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	
	$blackLocationName = "1";
	if (empty($row))
	{
		$blackLocationName = "0";
	}
	
	
	mysql_close($connection);
?>