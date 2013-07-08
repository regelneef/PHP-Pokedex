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
			$result = mysql_query("SELECT * FROM monsters");
				
			echo "<title>Pokémons</title>";
			
			//Category
			echo "<table align='center' cellspacing='3'>";
			echo "<tr><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th width=10%><a href='\'>Main Menu</a></th></tr></table>";
			
			echo "<br>";

			echo "<table align='center' cellspacing='3'>";
			echo "<tr><th colspan='3'>Pokémons</th></tr>";
			echo "<tr><th>ID</th><th>Icon</th><th>Name</th>";
			while ($row = mysql_fetch_array($result)) {
				echo "<tr><td width=5% class='center'>$row[0]</td><td width=5% class='center'><img src='images/icons/$row[0].png' alt='$row[1]' title='$row[1]'></td><td width=90% class='center'><a href=pokemon.php?id=$row[0]>$row[1]</a></td></tr>";
			}
			echo "</table>";
			mysql_close($connection);
		?>
	</body>
</html>