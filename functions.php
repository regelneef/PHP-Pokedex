<?php
	function catchCalculate($maxHP, $HP, $ballModifier, $statusModifier, $catchRate) 
	{ 			
		//CatchValue = (( 3 * Max HP - 2 * HP ) * (Catch Rate * Ball Modifier ) / (3 * Max HP) ) * Status Modifier
		$catchValue = ((3*$maxHP-2*$HP)*($catchRate*$ballModifier)/(3*$maxHP))*$statusModifier;
		return (round(pow(1048560/(sqrt(sqrt(16711680/($catchValue))))/65535,4)*100,1));
	} 
	
	function statCalculate($base, $EV, $IV, $level, $mod) 
	{ 
		if ($mod == "+")
			$mod=1.1;
		else if ($mod == "-")
			$mod=0.9;
		else
			$mod=1;
			
		if ($IV == "min")
			$IV = 0;
		else if ($IV == "max")
			$IV = 94;
			
		//(((IV + 2 * BaseStat + (EV/4) ) * Level/100 ) + 5) * Nature Value
		return (floor(((($IV + 2 * $base + ($EV/4) ) * $level/100 ) + 5) * $mod));
	} 
	
	function hpCalculate($base, $EV, $IV, $level, $mod) 
	{ 
		if ($mod == "+")
			$mod=1.1;
		else if ($mod == "-")
			$mod=0.9;
		else
			$mod=1;
			
		if ($IV == "min")
			$IV = 0;
		else if ($IV == "max")
			$IV = 94;
			
		//( (IV + 2 * BaseStat + (EV/4) ) * Level/100 ) + 10 + Level
		return (floor((($IV + 2 * $base + ($EV/4) ) * $level/100 ) + 10 + $level));
	} 
	
	function damageTaken($type, $type2, &$DTNormal, &$DTFire, &$DTWater, &$DTElectric, &$DTGrass, &$DTIce, &$DTFighting, &$DTPoison, &$DTGround, &$DTFlying, &$DTPsychic, &$DTBug, &$DTRock, &$DTGhost, &$DTDragon, &$DTDark, &$DTSteel)
	{
		switch ($type) {
			case "Normal":
				$DTFighting = $DTFighting * 2;
				$DTGhost = $DTGhost * 0;
			break;
			case "Fire":
				$DTFire = $DTFire * 0.5;
				$DTWater = $DTWater * 2;
				$DTGrass = $DTGrass * 0.5;
				$DTIce = $DTIce * 0.5;
				$DTGround = $DTGround * 2;
				$DTBug = $DTBug * 0.5;
				$DTRock = $DTRock * 2;
				$DTSteel = $DTSteel * 0.5;
			break;
			case "Water":
				$DTFire = $DTFire * 0.5;
				$DTWater = $DTWater * 0.5;
				$DTElectric = $DTElectric * 2; 
				$DTGrass = $DTGrass * 2;
				$DTIce = $DTIce * 0.5;
				$DTSteel = $DTSteel * 0.5;
			break;
			case "Electric":
				$DTElectric = $DTElectric * 0.5; 
				$DTGround = $DTGround * 2;
				$DTFlying = $DTFlying * 0.5;
				$DTSteel = $DTSteel * 0.5;
			break;
			case "Grass":
				$DTFire = $DTFire * 2;
				$DTWater = $DTWater * 0.5;
				$DTElectric = $DTElectric * 0.5;
				$DTGrass = $DTGrass * 0.5;
				$DTIce = $DTIce * 2;
				$DTPoison = $DTPoison * 2;
				$DTGround = $DTGround * 0.5;
				$DTFlying = $DTFlying * 2;
				$DTBug = $DTBug * 2;
			break;
			case "Ice":
				$DTFire = $DTFire * 2;
				$DTIce = $DTIce * 0.5;
				$DTFighting = $DTFighting * 2;
				$DTRock = $DTRock * 2;
				$DTSteel = $DTSteel * 2;
			break;
			case "Fighting":
				$DTFlying = $DTFlying * 2;
				$DTPsychic = $DTPsychic * 2;
				$DTBug = $DTBug * 0.5;
				$DTRock = $DTRock * 0.5;
				$DTDark = $DTDark * 0.5;
			break;
			case "Poison":
				$DTGrass = $DTGrass * 0.5;
				$DTFighting = $DTFighting * 0.5;
				$DTPoison = $DTPoison * 0.5;
				$DTGround = $DTGround * 2;
				$DTPsychic = $DTPsychic * 2;
				$DTBug = $DTBug * 0.5;
			break;
			case "Ground":
				$DTWater = $DTWater * 2;
				$DTElectric = $DTElectric * 0;
				$DTGrass = $DTGrass * 2;
				$DTIce = $DTIce * 2;
				$DTPoison = $DTPoison * 0.5;
				$DTRock = $DTRock * 0.5;
			break;
			case "Flying":
				$DTElectric = $DTElectric * 2;
				$DTGrass = $DTGrass * 0.5;
				$DTIce = $DTIce * 2;
				$DTFighting = $DTFighting * 0.5;
				$DTGround = $DTGround * 0;
				$DTBug = $DTBug * 0.5;
				$DTRock = $DTRock * 2;
			break;
			case "Psychic":
				$DTFighting = $DTFighting * 0.5;
				$DTPsychic = $DTPsychic * 0.5;
				$DTBug = $DTBug * 2;
				$DTGhost = $DTGhost * 2;
				$DTDark = $DTDark * 2;
			break;
			case "Bug":
				$DTFire = $DTFire * 2;
				$DTGrass = $DTGrass * 0.5;
				$DTFighting = $DTFighting * 0.5;
				$DTGround = $DTGround * 0.5;
				$DTFlying = $DTFlying * 2;
				$DTRock = $DTRock * 2;
			break;
			case "Rock":
				$DTNormal = $DTNormal * 0.5;
				$DTFire = $DTFire * 0.5;
				$DTWater = $DTWater * 2;
				$DTGrass = $DTGrass * 2;
				$DTFighting = $DTFighting * 2;
				$DTPoison = $DTPoison * 0.5;
				$DTGround = $DTGround * 2;
				$DTFlying = $DTFlying * 0.5;
				$DTSteel = $DTSteel * 2;
			break;
			case "Ghost":
				$DTNormal = $DTNormal * 0;
				$DTFighting = $DTFighting * 0;
				$DTPoison = $DTPoison * 0.5;
				$DTBug = $DTBug * 0.5;
				$DTGhost = $DTGhost * 2;
				$DTDark = $DTDark * 2;
			break;
			case "Dragon":
				$DTFire = $DTFire * 0.5;
				$DTWater = $DTWater * 0.5;
				$DTElectric = $DTElectric * 0.5;
				$DTGrass = $DTGrass * 0.5;
				$DTIce = $DTIce * 2;
				$DTDragon = $DTDragon * 2;
			break;
			case "Dark":
				$DTFighting = $DTFighting * 2;
				$DTPsychic = $DTPsychic * 0;
				$DTBug = $DTBug * 2;
				$DTGhost = $DTGhost * 0.5;
				$DTDark = $DTDark * 0.5;
			break;
			case "Steel":
				$DTNormal = $DTNormal * 0.5;
				$DTFire = $DTFire * 2;
				$DTGrass = $DTGrass * 0.5;
				$DTIce = $DTIce * 0.5;
				$DTFighting = $DTFighting * 2;
				$DTPoison = $DTPoison * 0;
				$DTGround = $DTGround * 2;
				$DTPsychic = $DTPsychic * 0.5;
				$DTFlying = $DTFlying * 0.5;
				$DTBug = $DTBug * 0.5;
				$DTGhost = $DTGhost * 0.5;
				$DTDark = $DTDark * 0.5;
				$DTSteel = $DTSteel * 0.5;
				$DTRock = $DTRock * 0.5;
				$DTDragon = $DTDragon * 0.5;
			break;
		}
		
		switch ($type2) {
						case "Normal":
				$DTFighting = $DTFighting * 2;
				$DTGhost = $DTGhost * 0;
			break;
			case "Fire":
				$DTFire = $DTFire * 0.5;
				$DTWater = $DTWater * 2;
				$DTGrass = $DTGrass * 0.5;
				$DTIce = $DTIce * 0.5;
				$DTGround = $DTGround * 2;
				$DTBug = $DTBug * 0.5;
				$DTRock = $DTRock * 2;
				$DTSteel = $DTSteel * 0.5;
			break;
			case "Water":
				$DTFire = $DTFire * 0.5;
				$DTWater = $DTWater * 0.5;
				$DTElectric = $DTElectric * 2; 
				$DTGrass = $DTGrass * 2;
				$DTIce = $DTIce * 0.5;
				$DTSteel = $DTSteel * 0.5;
			break;
			case "Electric":
				$DTElectric = $DTElectric * 0.5; 
				$DTGround = $DTGround * 2;
				$DTFlying = $DTFlying * 0.5;
				$DTSteel = $DTSteel * 0.5;
			break;
			case "Grass":
				$DTFire = $DTFire * 2;
				$DTWater = $DTWater * 0.5;
				$DTElectric = $DTElectric * 0.5;
				$DTGrass = $DTGrass * 0.5;
				$DTIce = $DTIce * 2;
				$DTPoison = $DTPoison * 2;
				$DTGround = $DTGround * 0.5;
				$DTFlying = $DTFlying * 2;
				$DTBug = $DTBug * 2;
			break;
			case "Ice":
				$DTFire = $DTFire * 2;
				$DTIce = $DTIce * 0.5;
				$DTFighting = $DTFighting * 2;
				$DTRock = $DTRock * 2;
				$DTSteel = $DTSteel * 2;
			break;
			case "Fighting":
				$DTFlying = $DTFlying * 2;
				$DTPsychic = $DTPsychic * 2;
				$DTBug = $DTBug * 0.5;
				$DTRock = $DTRock * 0.5;
				$DTDark = $DTDark * 0.5;
			break;
			case "Poison":
				$DTGrass = $DTGrass * 0.5;
				$DTFighting = $DTFighting * 0.5;
				$DTPoison = $DTPoison * 0.5;
				$DTGround = $DTGround * 2;
				$DTPsychic = $DTPsychic * 2;
				$DTBug = $DTBug * 0.5;
			break;
			case "Ground":
				$DTWater = $DTWater * 2;
				$DTElectric = $DTElectric * 0;
				$DTGrass = $DTGrass * 2;
				$DTIce = $DTIce * 2;
				$DTPoison = $DTPoison * 0.5;
				$DTRock = $DTRock * 0.5;
			break;
			case "Flying":
				$DTElectric = $DTElectric * 2;
				$DTGrass = $DTGrass * 0.5;
				$DTIce = $DTIce * 2;
				$DTFighting = $DTFighting * 0.5;
				$DTGround = $DTGround * 0;
				$DTBug = $DTBug * 0.5;
				$DTRock = $DTRock * 2;
			break;
			case "Psychic":
				$DTFighting = $DTFighting * 0.5;
				$DTPsychic = $DTPsychic * 0.5;
				$DTBug = $DTBug * 2;
				$DTGhost = $DTGhost * 2;
				$DTDark = $DTDark * 2;
			break;
			case "Bug":
				$DTFire = $DTFire * 2;
				$DTGrass = $DTGrass * 0.5;
				$DTFighting = $DTFighting * 0.5;
				$DTGround = $DTGround * 0.5;
				$DTFlying = $DTFlying * 2;
				$DTRock = $DTRock * 2;
			break;
			case "Rock":
				$DTNormal = $DTNormal * 0.5;
				$DTFire = $DTFire * 0.5;
				$DTWater = $DTWater * 2;
				$DTGrass = $DTGrass * 2;
				$DTFighting = $DTFighting * 2;
				$DTPoison = $DTPoison * 0.5;
				$DTGround = $DTGround * 2;
				$DTFlying = $DTFlying * 0.5;
				$DTSteel = $DTSteel * 2;
			break;
			case "Ghost":
				$DTNormal = $DTNormal * 0;
				$DTFighting = $DTFighting * 0;
				$DTPoison = $DTPoison * 0.5;
				$DTBug = $DTBug * 0.5;
				$DTGhost = $DTGhost * 2;
				$DTDark = $DTDark * 2;
			break;
			case "Dragon":
				$DTFire = $DTFire * 0.5;
				$DTWater = $DTWater * 0.5;
				$DTElectric = $DTElectric * 0.5;
				$DTGrass = $DTGrass * 0.5;
				$DTIce = $DTIce * 2;
				$DTDragon = $DTDragon * 2;
			break;
			case "Dark":
				$DTFighting = $DTFighting * 2;
				$DTPsychic = $DTPsychic * 0;
				$DTBug = $DTBug * 2;
				$DTGhost = $DTGhost * 0.5;
				$DTDark = $DTDark * 0.5;
			break;
			case "Steel":
				$DTNormal = $DTNormal * 0.5;
				$DTFire = $DTFire * 2;
				$DTGrass = $DTGrass * 0.5;
				$DTIce = $DTIce * 0.5;
				$DTFighting = $DTFighting * 2;
				$DTPoison = $DTPoison * 0;
				$DTGround = $DTGround * 2;
				$DTPsychic = $DTPsychic * 0.5;
				$DTFlying = $DTFlying * 0.5;
				$DTBug = $DTBug * 0.5;
				$DTGhost = $DTGhost * 0.5;
				$DTDark = $DTDark * 0.5;
				$DTSteel = $DTSteel * 0.5;
				$DTRock = $DTRock * 0.5;
				$DTDragon = $DTDragon * 0.5;
			break;
		}
	}
	
	function damageDone($type, $type2, &$DDNormal, &$DDFire, &$DDWater, &$DDElectric, &$DDGrass, &$DDIce, &$DDFighting, &$DDPoison, &$DDGround, &$DDFlying, &$DDPsychic, &$DDBug, &$DDRock, &$DDGhost, &$DDDragon, &$DDDark, &$DDSteel)
	{
		
	}
?>