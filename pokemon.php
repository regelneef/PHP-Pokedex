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
				include 'data/data_general.php';
				
				echo "<title>Pokémon - $name</title>";
				
				//Category
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th class='hidden' width=10%></th><th width=10%><a href='pokemons.php'>Pokémons</a></th><th width=10%><a href='#'>General</a></th><th width=10%><a href='pokemon_location.php?id=$id'>Location</a></th><th width=10%><a href='moves.php?pokemon=$id'>Moves</a></th></tr></table>";
				
				echo "<br>";
				
				//Navigation
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='3'>Navigation</th></tr>";
				if ($id != 1)
					echo "<tr><td width=10% class='left'><img src='images/icons/$previousID.png' alt='$previousName' title='$previousName'><br><a href='pokemon.php?id=$previousID'><- $previousName</a>";
				else
					echo "<td width=10% class='left'></td>";
				echo "</td><td class='name' width=80%><center><img src='images/icons/$id.png' alt='$name' title='$name'>  $name</center></td>";
				if ($id != 649)
					echo "<td width=10% class='right'><img src='images/icons/$nextID.png' alt='$nextName' title='$nextName'><a href='pokemon.php?id=$nextID'><br>$nextName-></a></td></tr></table>";
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
				echo "<tr height='96px'><td><center><img src='images/front_normal/$id.png' alt='$name' title='$name'></center></td><td><center><img src='images/front_shiny/$id.png' alt='$name' title='$name'></center></td><td><center><img src='images/back_normal/$id.png' alt='$name' title='$name'></center></td><td><center><img src='images/back_shiny/$id.png' alt='$name' title='$name'></center></td></tr></table>";
				
				echo "<br>";
				
				//Moving sprites
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='4'>Moving sprites</th></tr>";
				echo "<tr><th>Front Normal</th><th>Front Shiny</th><th>Back Normal</th><th>Back Shiny</th></tr>";
				echo "<tr height='96px'><td><center><img src='images/front_normal_moving/$id.gif' alt='$name' title='$name'></center></td><td><center><img src='images/front_shiny_moving/$id.gif' alt='$name' title='$name'></center></td><td><center><img src='images/back_normal_moving/$id.gif' alt='$name' title='$name'></center></td><td><center><img src='images/back_shiny_moving/$id.gif' alt='$name' title='$name'></center></td></tr></table>";
				
				echo "<br>";
				
				//Damage taken
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='17'>Damage taken</th></tr>";
				echo "<tr><td width=5% class='center'><img src='images/types/Normal.png' alt='Normal' title='Normal'></td>";
				echo "<td width=5% class='center'><img src='images/types/Fire.png' alt='Fire' title='Fire'></td>";
				echo "<td width=5% class='center'><img src='images/types/Water.png' alt='Water' title='Water'></td>";
				echo "<td width=5% class='center'><img src='images/types/Electric.png' alt='Electric' title='Electric'></td>";
				echo "<td width=5% class='center'><img src='images/types/Grass.png' alt='Grass' title='Grass'></td>";
				echo "<td width=5% class='center'><img src='images/types/Ice.png' alt='Ice' title='Ice'></td>";
				echo "<td width=5% class='center'><img src='images/types/Fighting.png' alt='Fighting' title='Fighting'></td>";
				echo "<td width=5% class='center'><img src='images/types/Poison.png' alt='Poison' title='Poison'></td>";
				echo "<td width=5% class='center'><img src='images/types/Ground.png' alt='Ground' title='Ground'></td>";
				echo "<td width=5% class='center'><img src='images/types/Flying.png' alt='Flying' title='Flying'></td>";
				echo "<td width=5% class='center'><img src='images/types/Psychic.png' alt='Psychic' title='Psychic'></td>";
				echo "<td width=5% class='center'><img src='images/types/Bug.png' alt='Bug' title='Bug'></td>";
				echo "<td width=5% class='center'><img src='images/types/Rock.png' alt='Rock' title='Rock'></td>";
				echo "<td width=5% class='center'><img src='images/types/Ghost.png' alt='Ghost' title='Ghost'></td>";
				echo "<td width=5% class='center'><img src='images/types/Dragon.png' alt='Dragon' title='Dragon'></td>";
				echo "<td width=5% class='center'><img src='images/types/Dark.png' alt='Dark' title='Dark'></td>";
				echo "<td width=5% class='center'><img src='images/types/Steel.png' alt='Steel' title='Steel'></td></tr>";
				echo "<tr><td width=5% class='center'>*$DTNormal</td>";
				echo "<td width=5% class='center'>*$DTFire</td>";
				echo "<td width=5% class='center'>*$DTWater</td>";
				echo "<td width=5% class='center'>*$DTElectric</td>";
				echo "<td width=5% class='center'>*$DTGrass</td>";
				echo "<td width=5% class='center'>*$DTIce</td>";
				echo "<td width=5% class='center'>*$DTFighting</td>";
				echo "<td width=5% class='center'>*$DTPoison</td>";
				echo "<td width=5% class='center'>*$DTGround</td>";
				echo "<td width=5% class='center'>*$DTFlying</td>";
				echo "<td width=5% class='center'>*$DTPsychic</td>";
				echo "<td width=5% class='center'>*$DTBug</td>";
				echo "<td width=5% class='center'>*$DTRock</td>";
				echo "<td width=5% class='center'>*$DTGhost</td>";
				echo "<td width=5% class='center'>*$DTDragon</td>";
				echo "<td width=5% class='center'>*$DTDark</td>";
				echo "<td width=5% class='center'>*$DTSteel</td></tr></table>";
				
				echo "<br>";
				
				//Damage done
				echo "<table align='center' cellspacing='3'>";
				echo "<tr><th colspan='17'>Damage done</th></tr>";
				echo "<tr><td width=5% class='center'><img src='images/types/Normal.png' alt='Normal' title='Normal'></td>";
				echo "<td width=5% class='center'><img src='images/types/Fire.png' alt='Fire' title='Fire'></td>";
				echo "<td width=5% class='center'><img src='images/types/Water.png' alt='Water' title='Water'></td>";
				echo "<td width=5% class='center'><img src='images/types/Electric.png' alt='Electric' title='Electric'></td>";
				echo "<td width=5% class='center'><img src='images/types/Grass.png' alt='Grass' title='Grass'></td>";
				echo "<td width=5% class='center'><img src='images/types/Ice.png' alt='Ice' title='Ice'></td>";
				echo "<td width=5% class='center'><img src='images/types/Fighting.png' alt='Fighting' title='Fighting'></td>";
				echo "<td width=5% class='center'><img src='images/types/Poison.png' alt='Poison' title='Poison'></td>";
				echo "<td width=5% class='center'><img src='images/types/Ground.png' alt='Ground' title='Ground'></td>";
				echo "<td width=5% class='center'><img src='images/types/Flying.png' alt='Flying' title='Flying'></td>";
				echo "<td width=5% class='center'><img src='images/types/Psychic.png' alt='Psychic' title='Psychic'></td>";
				echo "<td width=5% class='center'><img src='images/types/Bug.png' alt='Bug' title='Bug'></td>";
				echo "<td width=5% class='center'><img src='images/types/Rock.png' alt='Rock' title='Rock'></td>";
				echo "<td width=5% class='center'><img src='images/types/Ghost.png' alt='Ghost' title='Ghost'></td>";
				echo "<td width=5% class='center'><img src='images/types/Dragon.png' alt='Dragon' title='Dragon'></td>";
				echo "<td width=5% class='center'><img src='images/types/Dark.png' alt='Dark' title='Dark'></td>";
				echo "<td width=5% class='center'><img src='images/types/Steel.png' alt='Steel' title='Steel'></td></tr>";
				echo "<tr><td width=5% class='center'>*$DDNormal</td>";
				echo "<td width=5% class='center'>*$DDFire</td>";
				echo "<td width=5% class='center'>*$DDWater</td>";
				echo "<td width=5% class='center'>*$DDElectric</td>";
				echo "<td width=5% class='center'>*$DDGrass</td>";
				echo "<td width=5% class='center'>*$DDIce</td>";
				echo "<td width=5% class='center'>*$DDFighting</td>";
				echo "<td width=5% class='center'>*$DDPoison</td>";
				echo "<td width=5% class='center'>*$DDGround</td>";
				echo "<td width=5% class='center'>*$DDFlying</td>";
				echo "<td width=5% class='center'>*$DDPsychic</td>";
				echo "<td width=5% class='center'>*$DDBug</td>";
				echo "<td width=5% class='center'>*$DDRock</td>";
				echo "<td width=5% class='center'>*$DDGhost</td>";
				echo "<td width=5% class='center'>*$DDDragon</td>";
				echo "<td width=5% class='center'>*$DDDark</td>";
				echo "<td width=5% class='center'>*$DDSteel</td></tr></table>";
				
				echo "<br>";
							
				//Evolution
				echo "<table align='center' cellspacing='3'>";				
				if (!empty($evolutionID))
				{
					echo "<tr><th colspan='3'>Evolution</th></tr>";
					echo "<tr><th>Source</th><th>Method</th><th>Target</th></tr>";
					for ($i=0;$i<count($evolutionID);$i++)
					{
						echo "<tr><td><center><img src='images/front_normal/$id.png' alt='$name' title='$name'></center></td>";
						echo "<td><center>$evolutionMethod[$i]</center></td>";
						echo "<td><center><a href='pokemon.php?id=$evolutionID[$i]'><img src='images/front_normal/$evolutionID[$i].png' alt='$name' title='$name'></a></center></td></tr>";
					}
				}
				
				else
				{	
					echo "<tr><th>Evolution</th></tr>";
					echo "<tr><td>This Pokémon not evolves.</td></tr>";
				}
				echo "</table>";				
				echo "<br>";
			}
		?>
	</body>
</html>