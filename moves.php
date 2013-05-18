<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="images/favicon.ico" rel="shortcut icon">
	</head>

	<body>
		<?php
			include 'config.php';		
				
			echo "<title>Moves</title>";
				
			echo "<table align='center' cellspacing='3'>";
				

			$connection = mysql_connect($mysql_address,$mysql_username,$mysql_password);
			mysql_select_db($mysql_database, $connection);	
			$result = mysql_query("SELECT * FROM moves");
			echo "<table align='center' cellspacing='3'>";
			echo "<tr><th colspan='6'>Moves</th></tr>";
			echo "<tr><th>Power</th><th>PP</th><th>Accuracy</th><th>Effect</th><th>typeID</th><th>MoveClass</th>";
			while ($row = mysql_fetch_array($result)) {
				$power = $row[1];
				$pp = $row[2];
				$accuracy = $row[3] * 100;
				$effect = $row[4];
				$typeID = $row[5];
				$moveClass = $row[6];
				echo "<tr><td width=5% class='center'>$power</td><td width=5% class='center'>$pp</td><td width=5% class='center'>$accuracy%</td><td>$effect</td><td width=5% class='center'>$typeID</td><td width=5% class='center'>$moveClass</td></tr>";
			}
			echo "</table>";
			mysql_close($connection);
		?>
	</body>
</html>