<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="images/favicon.ico" rel="shortcut icon">
	</head>

	<body>
		<?php
			include 'config.php';

			$connection = mysql_connect($mysql_address,$mysql_username,$mysql_password);
			mysql_select_db($mysql_database, $connection);	
			$result = mysql_query("SELECT * FROM moves");			
				
			echo "<title>Moves</title>";
						
			//Category
			echo "<table align='center' cellspacing='3'>";
			echo "<tr><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th width=10%><a href='\'>Main Menu</a></th></tr></table>";
			
			echo "<br>";			

			echo "<table align='center' cellspacing='3'>";
			echo "<tr><th colspan='7'>Moves</th></tr>";
			echo "<tr><th>Name</th><th>Power</th><th>PP</th><th>Accuracy</th><th>Effect</th><th>Type</th><th>Class</th>";
			while ($row = mysql_fetch_array($result)) {
				$name = $row[7];
				$power = $row[1];
				$pp = $row[2];
				$accuracy = $row[3] * 100;
				$effect = $row[4];
				$type = $row[5];
				$moveClass = $row[6];
				echo "<tr><td width=5% class='center'>$name</td><td width=5% class='center'>$power</td><td width=5% class='center'>$pp</td><td width=5% class='center'>$accuracy%</td><td>$effect</td><td width=5% class='center'><img src='images/types/$type.png' alt='$type' title='$type'></td><td width=5% class='center'><img src='images/class/$moveClass.png' alt='$moveClass' title='$moveClass'></td></tr>";
			}
			echo "</table>";
			mysql_close($connection);
		?>
	</body>
</html>