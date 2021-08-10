<?php
//takes 2 arrays, swaps around its content based off a randomly decided %
Function SwapBoy(&$a,&$b)
{
	$limit =min (count($a),count($b));
	//this gets us the the smaller array size.
	
	$special=rand(25,80);//gets us a random value between 25 and 80
	
	
	for ($x=0;$x<$limit;$x++)
	{
		
		$check=rand(0,100);
		if ($check>=$special)
		{
			$c =$b[$x];
			$b[$x]=$a[$x];
			$a[$x]=$c;
		}
		
	}

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}