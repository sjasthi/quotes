


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
Function ScrambleMaker($quote)
{
	
	
	$t=parseToCodePoints($quote);
	shuffle($t);
	$a="";
	foreach($t as $axe)
	{
		$a .=parseToCharacter($axe);
	}
	echo $a;
	return;
}

Function SplitMaker($quote)
{
	$t=parseToCodePoints($quote);
	$noletters=Count($t);
	
		if ($noletters%3 ==0)
	{ $fodder=0;
	} else $fodder=1;
	$fodder2= ($noletters/3)+$fodder;
	
	$sample=array();
	$wheeloffortune =array_fill(0,$fodder2,$sample);
	
	for ($x=0;$x<$noletters;$x++)
	{ $tested =parseToCharacter($t[$x]);

array_push($wheeloffortune[$x/3],$tested);
	}
	shuffle($wheeloffortune);
	
	
	$a="";
	
	$counter=0;
	foreach($wheeloffortune as $value)
	{ foreach ($value as $value2)
		{ $a .= $value2;
		
		}$a .=  " _  " ;
		$counter++;
		if ($counter%4==0)
		{ $a .=  "<br>";
		}
	}
	echo $a;
	return;
}


Function DropM($quote , $col)
{
	
		$t=parseToCodePoints($quote);
	$noletters=Count($t);
	$spaces=array();
	


	
	

       $fodder=($col-($noletters%$col));
	   $trash=array("-");
	for ($arrayfod2=0;$arrayfod2<$fodder;$arrayfod2++)
	{ array_push($t, $trash);
	}
	$nohope=$noletters;
		$noletters=$noletters+$fodder;
	
	

	
	$sample=array();
	$wheeloffortune =array_fill(0,$col,$sample);
	$x=0;
		foreach ($t as $axe){
		
	
	$tested =parseToCharacter($axe);
	
	
	if (ctype_space($tested)==false && ctype_punct($tested)==false &&$x<$nohope)
	{ $t= $x%$col;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$col;
		array_push($wheeloffortune[$t],"-");
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

<?php
for ($y=0;$y<$noletters;$y++)
{
if ($y%$col==0)
{ echo "<tr>";
}	
$alpha =$wheeloffortune[$y%$col][$y/$col];

echo "<td>$alpha</td>";

if ($y%$col==$col-1) 
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
$alpha =$wheeloffortune[$y%$col][$y/$col];
if (in_array($y,$spaces)==false){
echo "<td></td>";}
else {
	echo "<td style=\"background-color:#000000;\"> 
	
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
	
	
	if (ctype_space($tested)==false && ctype_punct($tested)==false&&$x<$nohope)
	{ $t= $x%$col;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$col;
		array_push($wheeloffortune[$t],"-");
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
echo "<td></td>";}
else {
	echo "<td style=\"background-color:#000000;\"> 
	
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
$alpha =$wheeloffortune[$y%$col][$y/$col];

echo "<td>$alpha</td>";

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
	
	
		$t=parseToCodePoints($quote);
	$noletters=Count($t);
	$spaces=array();
	


	
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
	$x=0;
		foreach ($t as $axe){
		
	
	$tested =parseToCharacter($axe);
	
	
	if (ctype_space($tested)==false && ctype_punct($tested)==false&&$x<$nohope)
	{ $t= $x%$col;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$col;
		array_push($wheeloffortune[$t],"-");
		array_push($spaces,$x);
	}
	$x++;
	}
	
	$t2=parseToCodePoints($quote2);
	$noletters2=Count($t2);
		if (($noletters%$col) !=0)
	 

       $fodder=($col-($noletters%$col));
	   for ($arrayfod2=0;$arrayfod2<$fodder;$arrayfod2++)
	{ array_push($t2, $trash);
	}
	$nohope2=$noletters2;
		$noletters2=$noletters2+$fodder;
	
	$x=0;
		foreach ($t2 as $axe){
				$tested =parseToCharacter($axe);
	
	
	if (ctype_space($tested)==false && ctype_punct($tested)==false&&$x<$nohope)
	{ $t= $x%$col;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$col;
		array_push($wheeloffortune[$t],"-");
		array_push($spaces,($x+$noletters));
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

<?php
for ($y=0;$y<$noletters;$y++)
{
if ($y%$col==0)
{ echo "<tr>";
}	
$alpha =$wheeloffortune[$y%$col][$y/$col];

echo "<td>$alpha</td>";

if ($y%$col==$col-1) 
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
$alpha =$wheeloffortune[$y%$col][$y/$col];
if (in_array($y,$spaces)==false){
echo "<td></td>";}
else {
	echo "<td style=\"background-color:#000000;\"> 
	
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
			for ($y=$noletters;$y<$noletters+$noletters2;$y++)
{
if ($y%$col==0)
{ echo "<tr>";
}	
$alpha =$wheeloffortune[$y%$col][$y/$col];
if (in_array($y,$spaces)==false){
echo "<td> </td>";}
else {
	echo "<td style=\"background-color:#000000;\"> 
	
	</td>";}

if ($y%$col==$col-1) 
{ echo "</tr>";
}
}
echo "  </tbody>";



for ($y=$noletters;$y<$noletters+$noletters2;$y++)
{
if ($y%$col==0)
{ echo "<tr>";
}	
$alpha =$wheeloffortune[$y%$col][$y/$col];

echo "<td>$alpha</td>";

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


















