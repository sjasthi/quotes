


<head>
<div class="container">
<style>.title {text-align: center; color: darkgoldenrod;}

  .words {
            height: 50px;
            text-align: center;
        }
        
        h1,
        h2,
        h3 {
            text-align: center;
        }
        
        table {
            border: 1px solid black;
            border-collapse: separate;
            table-layout: fixed;
            width: 100px;
            height: 200px;
            text-align: center;
        }
        
        table td,
        table th {
            font-size: 20px;
            padding: 10px;
        }
        
        .answerkey td {
            width: 200px;
            height: 200px;
            border: 1px solid black;
            padding: none
    </style>
</head>



<?php
include ("telugu_parser.php");
include ("usefultool.php");

Function ScrambleMaker($quote)
{
	$quote=str_replace("\n"," ",$quote);
	
	$t2=parseToCodePoints($quote,);
	$t=array();
	foreach ($t2 as $axe)
	{
		if (ctype_cntrl($axe)==false) //this exists so we can strip control characters from the set.
		{ array_push($t,$axe);
		} 
	}
	
	shuffle($t);
	$a="";
	foreach($t as $axe)
	{
		$a .=parseToCharacter($axe);
	}
	$a .="<br>";
	echo $a;
	return;
}

Function SplitMaker($quote,$chunks)
{ 	$quote=str_replace("\n"," ",$quote);
	$t2=parseToCodePoints($quote);
	$t=array();
	foreach ($t2 as $axe)
	{
		if (ctype_cntrl($axe)==false) //this exists so we can strip control characters from the set.
		{ array_push($t,$axe);
		}
	}
	
	
	
	$noletters=Count($t);
	
		if ($noletters%$chunks ==0)
	{ $fodder=0;
	} else $fodder=1;
	$fodder2= ($noletters/$chunks)+$fodder;
	
	$sample=array();
	$wheeloffortune =array_fill(0,$fodder2,$sample);

	for ($x=0;$x<$noletters;$x++)
	{ $tested =parseToCharacter($t[$x]);

array_push($wheeloffortune[$x/$chunks],$tested);
	}
	shuffle($wheeloffortune);
	
	
	?>
		<body>
<table border="1" style="width:100%">
<tbody>
	
<?php	
$counter =0;

	foreach($wheeloffortune as $value){ 
	if ($counter%5==0)
	{echo "<tr>";}
	echo "<td>";foreach ($value as $value2)
		{ echo $value2;
		
		}
	echo "</td>";
	if ($counter%5==4)
		{echo "</tr>";}
	$counter++;
	}

echo "  </tbody>
    </table>
	</body> <br> ";	
	
}


Function DropM($quote , $col)
{
		$quote=str_replace("\n"," ",$quote);
		$t=parseToCodePoints($quote);
	$noletters=Count($t);
	$spaces=array();
	


	
	

       $fodder=($col-($noletters%$col));
	   $trash=array("-");
	for ($arrayfod2=0;$arrayfod2<$fodder;$arrayfod2++)
	{ 
	}
	$nohope=$noletters;
		$noletters=$noletters+$fodder;
	
	

	
	$sample=array();
	$wheeloffortune =array_fill(0,$col,$sample);
	$x=0;
		foreach ($t as $axe){
		
	
	$tested =parseToCharacter($axe);
	
	
	if (ctype_space($tested)==false && ctype_punct($tested)==false &&ctype_cntrl($tested)==false&& $x<$nohope)
	{ $t= $x%$col;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$col;
		
		array_push($spaces,$x);
	}
	$x++;
	}
	for($x=$nohope;$x<$noletters;$x++)
	{
		array_push($spaces,$x);
	}
	
for ($r=0;$r<$col;$r++)
{
	shuffle($wheeloffortune[$r]);
} ?>
	
	
	<body>
<table border="1" style="width:100%">
<tbody>

<?php
for ($y=$noletters-1;$y>-1;$y--)
{
if ($y%$col==$col-1)
{ echo "<tr>";
}	

if (isset($wheeloffortune[$col-1-$y%$col][$y/$col]))
{ 
$alpha =$wheeloffortune[$col-1- $y%$col][$y/$col];
echo "<td>$alpha</td>";}
else {echo "<td>&#160</td>";}

if ($y%$col==0) 
{ echo "</tr>";
}
}
	

	

 
		
?>
  <table border="1" style="width:100%">
        <tbody>
            <tr>
		<?php	
			for ($y=0;$y<$noletters;$y++)
{
if ($y%$col==0)
{ echo "<tr>";
}	

if (in_array($y,$spaces)==false){
echo "<td>&#160</td>";}
else {
	echo "<td style=\"background-color:#000000;\"> 
	&#160
	</td>";}

if ($y%$col==$col-1) 
{ echo "</tr>";
}
}
echo "  </tbody>
    </table>
	</body> <br> <h1> Solution:";
echo $quote;
echo "</h1>";
	
	
	
	
}






Function FloatM($quote,$col)
{
		$quote=str_replace("\n"," ",$quote);
		$t=parseToCodePoints($quote);
	$noletters=Count($t);
	$spaces=array();
	
	
	

       $fodder=($col-($noletters%$col));
	   $trash=array(" ");
	for ($arrayfod2=0;$arrayfod2<$fodder;$arrayfod2++)
	{array_push($t, $trash);
	}
	$nohope=$noletters;
		$noletters=$noletters+$fodder;
	
	
	$sample=array();
	$wheeloffortune =array_fill(0,$col,$sample);
	$x=0;
		foreach ($t as $axe)
	{
		
	$tested =parseToCharacter($axe);
	
	
	if (ctype_space($tested)==false && ctype_punct($tested)==false&&ctype_cntrl($tested)==false&&$x<$nohope)
	{ $t= $x%$col;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$col;
	
		array_push($spaces,$x);
	}
	$x++;
	}
	
	
for ($r=0;$r<$col;$r++)
{
	shuffle($wheeloffortune[$r]);
} ?>
	
	
	<body>
  <table border="1" style="width:100%">
        <tbody>
            <tr>
		<?php	
			for ($y=0;$y<$noletters;$y++)
{
if ($y%$col==0)
{ echo "<tr>";
}	
$alpha =$wheeloffortune[$y%$col][$y/$col];
if (in_array($y,$spaces)==false){
echo "<td>&#160</td>";}
else {
	echo "<td style=\"background-color:#000000;\"> 
	&#160
	</td>";}

if ($y%$col==$col-1) 
{ echo "</tr>";
}
}
echo "  </tbody>";



for ($y=0;$y<$noletters;$y++)
{
if ($y%$col==0)
{ echo "<tr>";
}	
if (isset($wheeloffortune[$y%$col][$y/$col]))
{$alpha =$wheeloffortune[$y%$col][$y/$col];

echo "<td>$alpha</td>";}
else {echo "<td>&#160</td>";}
if ($y%$col==$col-1) 
{ echo "</tr>";
}
}
	



echo "<t/body> 
    </table>
	</body> <br> <h1> Solution:";
echo $quote;
echo "</h1>";
	
	
	
	
}



Function FloatDrop($quote,$quote2,$col)

{
	
		$quote=str_replace("\n"," ",$quote);
			$quote2=str_replace("\n"," ",$quote2);
		$t=parseToCodePoints($quote);
	$noletters=Count($t);
	$spaces=array();
	$spaces2=array();


	
	if (($noletters%$col) !=0)
	

       $fodder=($col-($noletters%$col));
	   $trash=array("-");
	for ($arrayfod2=0;$arrayfod2<$fodder;$arrayfod2++)
	{ array_push($t, $trash);
	}
	$nohope=$noletters;
		$noletters=$noletters+$fodder;
	
	

	
	$sample=array();
	$wheeloffortune =array_fill(0,$col,$sample);
	
	$wheeloffortune2 =array_fill(0,$col,$sample);
	$x=0;
		foreach ($t as $axe){
		
	
	$tested =parseToCharacter($axe);
	
	
	if (ctype_space($tested)==false && ctype_punct($tested)==false&&ctype_cntrl($tested)==false&&$x<$nohope)
	{ $tt= $x%$col;
		array_push($wheeloffortune[$tt],$tested);
	
	} else {
		
		array_push($spaces,$x);
	}
	$x++;
	}
	
	$t2=parseToCodePoints($quote2);
	$noletters2=Count($t2);
		if (($noletters2%$col) !=0)
	 

       $fodder=($col-($noletters2%$col));
	   for ($arrayfod2=0;$arrayfod2<$fodder;$arrayfod2++)
	{ array_push($t2, $trash);
	}
	$nohope2=$noletters2;
		$noletters2=$noletters2+$fodder;
	
	$x=0;
		foreach ($t2 as $axe){
				$tested =parseToCharacter($axe);
	
	
	if (ctype_space($tested)==false && ctype_punct($tested)==false&&ctype_cntrl($tested)==false&&$x<$nohope)
	{ $tt= $x%$col;
		array_push($wheeloffortune2[$tt],$tested);
	
	} else { 
		
		array_push($spaces2,$x);
	}
	$x++;
	}
			
			
			
		
	
	
	
	
	
	
	
	
	
	
	
	
for ($r=0;$r<$col;$r++)
{
	shuffle($wheeloffortune[$r]);
	shuffle($wheeloffortune2[$r]);
	SwapBoy($wheeloffortune[$r],$wheeloffortune2[$r]);
} ?>
	
	
	<body>
<table border="1" style="width:100%">
<tbody>

<?php
for ($y=$noletters-1;$y>-1;$y--)
{
if ($y%$col==$col-1) 
{ echo "<tr>";
}	

if (isset($wheeloffortune[$col-1-$y%$col][$y/$col]))
{
$alpha =$wheeloffortune[$col-1- $y%$col][$y/$col];

echo "<td>$alpha</td>";
} else {echo "<td>&#160</td>";
if ($y%$col==0)
{ echo "</tr>";
}
}
	
}
	

 
		
?>
  <table border="1" style="width:100%">
        <tbody>
            <tr>
		<?php	
			for ($y=0;$y<$noletters;$y++)
{
if ($y%$col==0)
{ echo "<tr>";
}	
$alpha =$wheeloffortune[$y%$col][$y/$col];
if (in_array($y,$spaces)==false){
echo "<td>&#160</td>";}
else {
	echo "<td style=\"background-color:#000000;\"> 
	&#160
	</td>";}

if ($y%$col==$col-1) 
{ echo "</tr>";
}
}
echo "  </tbody>";
	?>
	 <table border="1" style="width:100%">
        <tbody>
            <tr>
		<?php	
			for ($y=0;$y<$noletters2;$y++)
{
if ($y%$col==0)
{ echo "<tr>";
}	

if (in_array($y,$spaces2)==false){
echo "<td> &#160</td>";}
else {
	echo "<td style=\"background-color:#000000;\"> 
	&#160
	</td>";}

if ($y%$col==$col-1) 
{ echo "</tr>";
}
}
echo "  </tbody>";



for ($y=0;$y<$noletters2+1;$y++)
{
if ($y%$col==0)
{ echo "<tr>";
}	
if (isset($wheeloffortune2[$y%$col][$y/$col]))
{$alpha =$wheeloffortune2[$y%$col][$y/$col];

echo "<td>$alpha</td>";}else {echo "<td>&#160</td>";}
if ($y%$col==$col-1) 
{ echo "</tr>";
}
}
	



echo "<t/body> 
    </table>
	</body> <br> <h1> Solution:";
echo $quote;
echo " / "; 
echo $quote2;
echo "</h1>";
	
	
	
	
	
	
	
	
	
	
	
	
}


?>


















