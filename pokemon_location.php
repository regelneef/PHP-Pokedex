<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="images/favicon.ico" rel="shortcut icon">
	</head>

	<body>
		<?php
			include 'config.php';
			
			if (!isset($_GET["id"]))
				$_GET["id"] = 1;
			
			if ($_GET["id"] < 1 or $_GET["id"] > 649)
			{
				echo "<title>Pokedex</title>";
				echo "<table align='center'><th>This Pokémon not exist in the database!</th></table>";
			}
				
			else {
				include 'data/data_location.php';
				
				echo "<title>Location - $name</title>";
				
				//Category
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th width=10%><a href='pokemons.php'>Pokémons</a></th><th width=10%><a href='pokemon.php?id=$id'>General</a></th><th width=10%><a href=#>Location</a></th><th width=10%><a href='pokemon_moves.php?pokemon=$id'>Moves</a></th></tr></table>";
				
				echo "<br>";
				
				//Navigation
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='3'>Navigation</th></tr>";
				if ($id != 1)
					echo "<tr><td width=10% class='left'><img src='images/icons/$previousID.png' alt='$previousName' title='$previousName'><br><a href='pokemon_location.php?id=$previousID'><- $previousName</a>";
				else
					echo "<td width=10% class='left'></td>";
				echo "</td><td class='name'><center><img src='images/icons/$id.png' alt='$name' title='$name'>  $name</center></td>";
				if ($id != 649)
					echo "<td width=10% class='right'><img src='images/icons/$nextID.png' alt='$nextName' title='$nextName'><a href='pokemon_location.php?id=$nextID'><br>$nextName-></a></td></tr></table>";
				else
					echo "<td width=10% class='left'></td></tr></table>";
				
				echo "<br>";
				
				if ($whiteLocationName == "0" and $blackLocationName == "0")
				{
						echo "<table align='center' cellspacing='3'>";
						echo "<tr><th>$name can't be found in the wild!</th></tr></table>";
				}
				
				else 
				{
					$connection = mysql_connect($mysql_address,$mysql_username,$mysql_password);
					mysql_select_db($mysql_database, $connection);
					
					//Surfing	
					$result = mysql_query("SELECT * FROM monsterlocations WHERE monsterId=".$_GET["id"]." AND locationTypeId=1");
					for ($i=0;$row = mysql_fetch_array($result);$i++) {
							$locationID[$i] = $row[1];
							$rate[$i] = $row[3];
							$game[$i] = $row[4];
					}
					
					if (!empty($locationID))
					{
						echo "<table align='center' cellspacing='3'>";
						echo "<tr><th colspan='3'>Surfing</th></tr>";
						echo "<tr><th>Location</th><th>Rate</th><th>Game</th>";
						echo "<tr>";
						for ($i=0;$i<count($locationID);$i++)
						{
							$result = mysql_query("SELECT name FROM locations WHERE id=".$locationID[$i]);
							$row = mysql_fetch_array($result);
							echo "<tr>";
							echo "<td width=80%>$row[0]</td>";
							echo "<td width=10%>$rate[$i]%</td>";
							if ($game[$i] == 12)
								echo "<td width=10%>Black</td>";
							else if ($game[$i] == 13)
								echo "<td width=10%>White</td>";
							else if ($game[$i] == 11)
								echo "<td width=10%>Black and White</td>";							
					
							echo "</tr>";
						}
						echo "</tr></table><br>";
						unset($locationIDs);
						unset($game);
						unset($rate);
					}
					
					//Surfing - Shaking Spots
					$result = mysql_query("SELECT * FROM monsterlocations WHERE monsterId=".$_GET["id"]." AND locationTypeId=2");
					for ($i=0;$row = mysql_fetch_array($result);$i++) {
							$locationID[$i] = $row[1];
							$rate[$i] = $row[3];
							$game[$i] = $row[4];
					}
					
					if (!empty($locationID))
					{
						echo "<table align='center' cellspacing='3'>";
						echo "<tr><th colspan='3'>Surfing - Shaking Spots</th></tr>";
						echo "<tr><th>Location</th><th>Rate</th><th>Game</th>";
						echo "<tr>";
						for ($i=0;$i<count($locationID);$i++)
						{
							$result = mysql_query("SELECT name FROM locations WHERE id=".$locationID[$i]);
							$row = mysql_fetch_array($result);
							echo "<tr>";
							echo "<td width=80%>$row[0]</td>";
							echo "<td width=10%>$rate[$i]%</td>";
							if ($game[$i] == 12)
								echo "<td width=10%>Black</td>";
							else if ($game[$i] == 13)
								echo "<td width=10%>White</td>";
							else if ($game[$i] == 11)
								echo "<td width=10%>Black and White</td>";							
					
							echo "</tr>";
						}
						echo "</tr></table><br>";
						unset($locationID);
						unset($game);
						unset($rate);
					}
					
					//Fishing
					$result = mysql_query("SELECT * FROM monsterlocations WHERE monsterId=".$_GET["id"]." AND locationTypeId=3");
					for ($i=0;$row = mysql_fetch_array($result);$i++) {
							$locationID[$i] = $row[1];
							$rate[$i] = $row[3];
							$game[$i] = $row[4];
					}
					
					if (!empty($locationID))
					{
						echo "<table align='center' cellspacing='3'>";
						echo "<tr><th colspan='3'>Fishing</th></tr>";
						echo "<tr><th>Location</th><th>Rate</th><th>Game</th>";
						echo "<tr>";
						for ($i=0;$i<count($locationID);$i++)
						{
							$result = mysql_query("SELECT name FROM locations WHERE id=".$locationID[$i]);
							$row = mysql_fetch_array($result);
							echo "<tr>";
							echo "<td width=80%>$row[0]</td>";
							echo "<td width=10%>$rate[$i]%</td>";
							if ($game[$i] == 12)
								echo "<td width=10%>Black</td>";
							else if ($game[$i] == 13)
								echo "<td width=10%>White</td>";
							else if ($game[$i] == 11)
								echo "<td width=10%>Black and White</td>";							
					
							echo "</tr>";
						}
						echo "</tr></table><br>";
						unset($locationID);
						unset($game);
						unset($rate);
					}
					
					//Fishing - Shaking Spots
					$result = mysql_query("SELECT * FROM monsterlocations WHERE monsterId=".$_GET["id"]." AND locationTypeId=4");
					for ($i=0;$row = mysql_fetch_array($result);$i++) {
							$locationID[$i] = $row[1];
							$rate[$i] = $row[3];
							$game[$i] = $row[4];
					}
					
					if (!empty($locationID))
					{
						echo "<table align='center' cellspacing='3'>";
						echo "<tr><th colspan='3'>Fishing - Shaking Spots</th></tr>";
						echo "<tr><th>Location</th><th>Rate</th><th>Game</th>";
						echo "<tr>";
						for ($i=0;$i<count($locationID);$i++)
						{
							$result = mysql_query("SELECT name FROM locations WHERE id=".$locationID[$i]);
							$row = mysql_fetch_array($result);
							echo "<tr>";
							echo "<td width=80%>$row[0]</td>";
							echo "<td width=10%>$rate[$i]%</td>";
							if ($game[$i] == 12)
								echo "<td width=10%>Black</td>";
							else if ($game[$i] == 13)
								echo "<td width=10%>White</td>";
							else if ($game[$i] == 11)
								echo "<td width=10%>Black and White</td>";							
					
							echo "</tr>";
						}
						echo "</tr></table><br>";
						unset($locationID);
						unset($game);
						unset($rate);
					}
					
					//Walking
					$result = mysql_query("SELECT * FROM monsterlocations WHERE monsterId=".$_GET["id"]." AND locationTypeId=5");
					for ($i=0;$row = mysql_fetch_array($result);$i++) {
							$locationID[$i] = $row[1];
							$rate[$i] = $row[3];
							$game[$i] = $row[4];
					}
					
					if (!empty($locationID))
					{
						echo "<table align='center' cellspacing='3'>";
						echo "<tr><th colspan='3'>Walking</th></tr>";
						echo "<tr><th>Location</th><th>Rate</th><th>Game</th>";
						echo "<tr>";
						for ($i=0;$i<count($locationID);$i++)
						{
							$result = mysql_query("SELECT name FROM locations WHERE id=".$locationID[$i]);
							$row = mysql_fetch_array($result);
							echo "<tr>";
							echo "<td width=80%>$row[0]</td>";
							echo "<td width=10%>$rate[$i]%</td>";
							if ($game[$i] == 12)
								echo "<td width=10%>Black</td>";
							else if ($game[$i] == 13)
								echo "<td width=10%>White</td>";
							else if ($game[$i] == 11)
								echo "<td width=10%>Black and White</td>";							
					
							echo "</tr>";
						}
						echo "</tr></table><br>";
						unset($locationID);
						unset($game);
						unset($rate);
					}
					
					//Double Grass
					$result = mysql_query("SELECT * FROM monsterlocations WHERE monsterId=".$_GET["id"]." AND locationTypeId=6");
					for ($i=0;$row = mysql_fetch_array($result);$i++) {
							$locationID[$i] = $row[1];
							$rate[$i] = $row[3];
							$game[$i] = $row[4];
					}
					
					if (!empty($locationID))
					{
						echo "<table align='center' cellspacing='3'>";
						echo "<tr><th colspan='3'>Double Grass</th></tr>";
						echo "<tr><th>Location</th><th>Rate</th><th>Game</th>";
						echo "<tr>";
						for ($i=0;$i<count($locationID);$i++)
						{
							$result = mysql_query("SELECT name FROM locations WHERE id=".$locationID[$i]);
							$row = mysql_fetch_array($result);
							echo "<tr>";
							echo "<td width=80%>$row[0]</td>";
							echo "<td width=10%>$rate[$i]%</td>";
							if ($game[$i] == 12)
								echo "<td width=10%>Black</td>";
							else if ($game[$i] == 13)
								echo "<td width=10%>White</td>";
							else if ($game[$i] == 11)
								echo "<td width=10%>Black and White</td>";							
					
							echo "</tr>";
						}
						echo "</tr></table><br>";
						unset($locationID);
						unset($game);
						unset($rate);
					}
					
					//Walking - Shaking Spots
					$result = mysql_query("SELECT * FROM monsterlocations WHERE monsterId=".$_GET["id"]." AND locationTypeId=7");
					for ($i=0;$row = mysql_fetch_array($result);$i++) {
							$locationID[$i] = $row[1];
							$rate[$i] = $row[3];
							$game[$i] = $row[4];
					}
					
					if (!empty($locationID))
					{
						echo "<table align='center' cellspacing='3'>";
						echo "<tr><th colspan='3'>Walking - Shaking Spots</th></tr>";
						echo "<tr><th>Location</th><th>Rate</th><th>Game</th>";
						echo "<tr>";
						for ($i=0;$i<count($locationID);$i++)
						{
							$result = mysql_query("SELECT name FROM locations WHERE id=".$locationID[$i]);
							$row = mysql_fetch_array($result);
							echo "<tr>";
							echo "<td width=80%>$row[0]</td>";
							echo "<td width=10%>$rate[$i]%</td>";
							if ($game[$i] == 12)
								echo "<td width=10%>Black</td>";
							else if ($game[$i] == 13)
								echo "<td width=10%>White</td>";
							else if ($game[$i] == 11)
								echo "<td width=10%>Black and White</td>";							
					
							echo "</tr>";
						}
						echo "</tr></table><br>";
						unset($locationID);
						unset($game);
						unset($rate);
					}
					
					mysql_close($connection);
				}
			}
		?>
	</body>
</html>