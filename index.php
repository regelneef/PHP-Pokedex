<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-2">
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="images/favicon.ico" rel="shortcut icon">
	</head>

	<body>
		<?php
			include 'config.php';
			
			if (!isset($_GET["pokemon"]))
				$_GET["pokemon"] = 1;
				
			echo "<form action='index.php' method='get'>";
			echo "<select name='pokemon'>";
			echo "<option>Pokémons</option>";
	
			$connection = mysql_connect($mysql_address,$mysql_username,$mysql_password);
			mysql_select_db($mysql_database, $connection);
		
			$result = mysql_query("SELECT * FROM monsters");
			while ($row = mysql_fetch_array($result))
			    echo "<option value='$row[0]'>$row[1]</option>\n";
						
			mysql_close($connection);
			
			echo "</select>";
			echo "<input type='submit' value='Select' /></form>";
			
			if ($_GET["pokemon"] < 1 or $_GET["pokemon"] > 649)
			{
				echo "<title>Pokedex</title>";
				echo "<table align='center'><th>This Pokémon not exist in the database!</th></table>";
			}
				
			else {
				include 'data.php';
				
				echo "<title>Pokedex - $name</title>";
				
				//Navigation
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='3'>Navigation</th></tr>";
				if ($id != 1)
					echo "<tr><td width=10% class='left'><img src='images/icons/$previousID.png' alt='$previousName' title='$previousName'><br><a href='index.php?pokemon=$previousID'><- $previousName</a>";
				else
					echo "<td width=10% class='left'></td>";
				echo "</td><td class='name'><center><img src='images/icons/$id.png' alt='$name' title='$name'>  $name</center></td>";
				if ($id != 649)
					echo "<td width=10% class='right'><img src='images/icons/$nextID.png' alt='$nextName' title='$nextName'><a href='index.php?pokemon=$nextID'><br>$nextName-></a></td></tr></table>";
				else
					echo "<td width=10% class='left'></td></tr></table>";
				
				
				echo "<br>";
				
				//Pokedex data
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='6'>Description</th></tr>";
				echo "<tr><th>National No.</th><th>Generation</th><th>Type</th><th>Height</th><th>Weight</th><th>Description</th></tr>";
				echo "<tr><td width=10%>#$id</td>";
				if ($id < 152)
					echo "<td width=10%>I. generation</td>";
				else if ($id >= 152 and $id < 252)
					echo "<td width=10%>II. generation</td>";
				else if ($id >= 252 and $id < 387)
					echo "<td width=10%>III. generation</td>";
				else if ($id >= 387 and $id < 494)
					echo "<td width=10%>IV. generation</td>";
				else	
					echo "<td width=10%>V. generation</td>";
				if ($type2 == "None")
					echo "<td ><center><img src='images/types/$type.png' alt='$type' title='$type'></center></td>";
				else
					echo "<td><center><img src='images/types/$type.png' alt='$type' title='$type'> <img src='images/types/$type2.png' alt='$type2' title='$type2'></center></td>";
				echo "<td width=10%>$height m</td>";
				echo "<td width=10%>$weight kg</td>";
				echo "<td width=50%>$description</td></tr></table>";
				
				echo "<br>";
				
				//Breeding
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='6'>Breeding</th></tr>";
				echo "<tr><th>Egg groups</th><th>Gender ratio</th><th>Hatch steps</th><th>Catch rate</th><th>Catch chance</th><th>Habitant</th></tr>";
				echo "<tr><td width=16%>$eggGroups</td>";
				echo "<td  width=16%><b>Male ratio:</b> $maleRatio%<br><b>Female ratio:</b> $femaleRatio%</td>";
				echo "<td  width=16%>$hatchSteps</td>";
				echo "<td  width=16%>$catchRate</td>";
				echo "<td  width=16%>".catchCalculate(100,100,1,1,$catchRate)."%</td>";
				echo "<td  width=16%><center><img src='images/habitat/$habitatID.png' alt='$habitatName' title='$habitatName'></center></td></tr></table>";
								
				echo "<br>";
							
				//Abilities
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='3'>Abilities</th></tr>";
				echo "<tr><th>Ability #1</th><th>Ability #2</th><th>Hidden Ability</th>";
				echo "<tr><td width=33%>$ability1Name: $ability1Effect</td>";
				if ($ability2ID != 0)
					echo "<td width=33%>$ability2Name: $ability2Effect</td>";
				else
					echo "<td width=33%>This Pokémon don't have a second ability.</td>";
				
				if ($ability3ID != 0)
					echo "<td width=33%>$ability3Name: $ability3Effect</td></tr></table>";
				else
					echo "<td width=33%>This Pokémon don't have a hidden ability.</td></tr></table>";
					
				echo "<br>";
				
				//Stats
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='8'>Stats</th></tr>";
				echo "<tr><th class='hidden'></th><th class='hidden'></th><th>HP</th><th>Attack</th><th>Defense</th><th>Sp. Attack</th><th>Sp. Defense</th><th>Speed</th></tr>";
				echo "<tr><td colspan='2'>Base stats</td>";
				echo "<td class='center' width=12%>$baseHP</td>";
				echo "<td class='center' width=12%>$baseAttack</td>";
				echo "<td class='center' width=12%>$baseDefense</td>";
				echo "<td class='center' width=12%>$baseSAttack</td>";
				echo "<td class='center' width=12%>$baseSDefense</td>";
				echo "<td class='center' width=12%>$baseSpeed</td></tr>";
				echo "<tr><td rowspan='2'>Max Stats <br> <i>Negativ nature</i></td>";
				echo "<td>Level 50</td>";
				echo "<td class='center' width=12%>".hpCalculate($baseHP,$EVHP,"min",50,"-")." - ".hpCalculate($baseHP,$EVHP,"max",50,"-")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseAttack,$EVAttack,"min",50,"-")." - ".statCalculate($baseAttack,$EVAttack,"max",50,"-")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseDefense,$EVDefense,"min",50,"-")." - ".statCalculate($baseDefense,$EVDefense,"max",50,"-")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSAttack,$EVSAttack,"min",50,"-")." - ".statCalculate($baseSAttack,$EVSAttack,"max",50,"-")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSDefense,$EVSDefense,"min",50,"-")." - ".statCalculate($baseSDefense,$EVSDefense,"max",50,"-")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSpeed,$EVSpeed,"min",50,"-")." - ".statCalculate($baseSpeed,$EVSpeed,"max",50,"-")."</td></tr>";
				echo "<tr><td>Level 100</td>";
				echo "<td class='center' width=12%>".hpCalculate($baseHP,$EVHP,"min",100,"1")." - ".hpCalculate($baseHP,$EVHP,"max",100,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseAttack,$EVAttack,"min",100,"-")." - ".statCalculate($baseAttack,$EVAttack,"max",100,"-")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseDefense,$EVDefense,"min",100,"-")." - ".statCalculate($baseDefense,$EVDefense,"max",100,"-")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSAttack,$EVSAttack,"min",100,"-")." - ".statCalculate($baseSAttack,$EVSAttack,"max",100,"-")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSDefense,$EVSDefense,"min",100,"-")." - ".statCalculate($baseSDefense,$EVSDefense,"max",100,"-")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSpeed,$EVSpeed,"min",100,"-")." - ".statCalculate($baseSpeed,$EVSpeed,"max",100,"-")."</td></tr>";
				echo "<tr><td rowspan='2'>Max Stats <br> <i>Natural nature</i></td>";
				echo "<td>Level 50</td>";
				echo "<td class='center' width=12%>".hpCalculate($baseHP,$EVHP,"min",50,"1")." - ".hpCalculate($baseHP,$EVHP,"max",50,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseAttack,$EVAttack,"min",50,"1")." - ".statCalculate($baseAttack,$EVAttack,"max",50,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseDefense,$EVDefense,"min",50,"1")." - ".statCalculate($baseDefense,$EVDefense,"max",50,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSAttack,$EVSAttack,"min",50,"1")." - ".statCalculate($baseSAttack,$EVSAttack,"max",50,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSDefense,$EVSDefense,"min",50,"1")." - ".statCalculate($baseSDefense,$EVSDefense,"max",50,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSpeed,$EVSpeed,"min",50,"1")." - ".statCalculate($baseSpeed,$EVSpeed,"max",50,"1")."</td></tr>";
				echo "<tr><td>Level 100</td>";
				echo "<td class='center' width=12%>".hpCalculate($baseHP,$EVHP,"min",100,"1")." - ".hpCalculate($baseHP,$EVHP,"max",100,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseAttack,$EVAttack,"min",100,"1")." - ".statCalculate($baseAttack,$EVAttack,"max",100,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseDefense,$EVDefense,"min",100,"1")." - ".statCalculate($baseDefense,$EVDefense,"max",100,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSAttack,$EVSAttack,"min",100,"1")." - ".statCalculate($baseSAttack,$EVSAttack,"max",100,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSDefense,$EVSDefense,"min",100,"1")." - ".statCalculate($baseSDefense,$EVSDefense,"max",100,"1")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSpeed,$EVSpeed,"min",100,"1")." - ".statCalculate($baseSpeed,$EVSpeed,"max",100,"1")."</td></tr>";
				echo "<tr><td rowspan='2'>Max Stats <br> <i>Positive nature</i></td>";
				echo "<td>Level 50</td>";
				echo "<td class='center' width=12%>".hpCalculate($baseHP,$EVHP,"min",50,"+")." - ".hpCalculate($baseHP,$EVHP,"max",50,"+")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseAttack,$EVAttack,"min",50,"+")." - ".statCalculate($baseAttack,$EVAttack,"max",50,"+")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseDefense,$EVDefense,"min",50,"+")." - ".statCalculate($baseDefense,$EVDefense,"max",50,"+")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSAttack,$EVSAttack,"min",50,"+")." - ".statCalculate($baseSAttack,$EVSAttack,"max",50,"+")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSDefense,$EVSDefense,"min",50,"+")." - ".statCalculate($baseSDefense,$EVSDefense,"max",50,"+")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSpeed,$EVSpeed,"min",50,"+")." - ".statCalculate($baseSpeed,$EVSpeed,"max",50,"+")."</td></tr>";
				echo "<tr><td>Level 100</td>";
				echo "<td class='center' width=12%>".hpCalculate($baseHP,$EVHP,"min",100,"+")." - ".hpCalculate($baseHP,$EVHP,"max",100,"+")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseAttack,$EVAttack,"min",100,"+")." - ".statCalculate($baseAttack,$EVAttack,"max",100,"+")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseDefense,$EVDefense,"min",100,"+")." - ".statCalculate($baseDefense,$EVDefense,"max",100,"+")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSAttack,$EVSAttack,"min",100,"+")." - ".statCalculate($baseSAttack,$EVSAttack,"max",100,"+")."</td>";
				echo "<td class='center' width=12%>".statCalculate($baseSDefense,$EVSDefense,"min",100,"+")." - ".statCalculate($baseSDefense,$EVSDefense,"max",100,"+")."</td>";
				echo "<td class='center' class='center' width=12%>".statCalculate($baseSpeed,$EVSpeed,"min",100,"+")." - ".statCalculate($baseSpeed,$EVSpeed,"max",100,"+")."</td></tr>";
				echo "</table>";
								
				echo "<br>";
				
				//Sprites
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='4'>Sprites</th></tr>";
				echo "<tr><th>Front Normal</th><th>Front Shiny</th><th>Back Normal</th><th>Back Shiny</th></tr>";
				echo "<tr><td><center><img src='images/front_normal/$id.png' alt='$name' title='$name'></center></td><td><center><img src='images/front_shiny/$id.png' alt='$name' title='$name'></center></td><td><center><img src='images/back_normal/$id.png' alt='$name' title='$name'></center></td><td><center><img src='images/back_shiny/$id.png' alt='$name' title='$name'></center></td></tr></table>";
			}
		?>
	</body>
</html>