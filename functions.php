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
?>