<?php	
	include 'config.php';
	include 'functions.php';
	
	$connection = mysql_connect($mysql_address,$mysql_username,$mysql_password);
	mysql_select_db($mysql_database, $connection);
		
	$query = "SELECT * FROM monsters WHERE id=".$_GET["pokemon"];
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
			
	$id = $row[0];
	$name = $row[1];
	$type = $row[2];
	$type2 = $row[3];
	$eggGroups = $row[4];
	$maleRatio = $row[5];
	$femaleRatio = 100 - $maleRatio;
	$hatchSteps = $row[6];
	$description = $row[7];
	$height = $row[8];
	$weight = $row[9];
	$baseHP = $row[10];
	$baseAttack = $row[11];
	$baseDefense = $row[12];
	$baseSpeed = $row[13];
	$baseSAttack = $row[14];
	$baseSDefense = $row[15];
	$EVHP = $row[16];
	$EVAttack = $row[17];
	$EVDefense = $row[18];
	$EVSpeed = $row[19];
	$EVSAttack = $row[20];
	$EVSDefense = $row[21];
	$ability1ID = $row[22];
	$ability2ID = $row[23];
	$ability3ID = $row[24];
	$catchRate = $row[25];
	$habitatID = $row[26];

	$query = "SELECT * FROM abilities WHERE id=$ability1ID";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);	
	$ability1Name = $row[1];
	$ability1Effect = $row[2];
	
	$query = "SELECT * FROM abilities WHERE id=$ability2ID";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);	
	$ability2Name = $row[1];
	$ability2Effect = $row[2];
	
	
	$query = "SELECT * FROM abilities WHERE id=$ability3ID";
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);	
	$ability3Name = $row[1];
	$ability3Effect = $row[2];
			
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
	
	$query = "SELECT name FROM habitat WHERE id=".$habitatID;
	$result = mysql_query($query);
	$row = mysql_fetch_array($result);
	$habitatName = $row[0];
	
	mysql_close($connection);
?>