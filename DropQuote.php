<?php $page_title = ' Quote Drop'; ?>
<?php 
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
  require 'db_credentials.php'; 
    include("./nav.php");
	include ("telugu_parser.php");
?>
<div class="container">
<style>#title {text-align: center; color: darkgoldenrod;}</style>
<?php
include_once 'db_credentials.php'; 

  $sql = "SELECT * FROM quote_table
            WHERE id = '-1'";

$touched=isset($_POST['ident']);
if (!$touched) {
	echo 'You need to select an entry. Go back and try again. <br>';
} else {     $id = $_POST['ident'];
    $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";
    

	
}

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
  

	
	
	
	
	
}	$norows = 16; //later i'll update this to take from preferences
  echo '<h2 id="title">Drop Quote</h2><br>';

	$uninpo=1;
	$sqx = "SELECT * FROM pref WHERE id = '$uninpo'";
	$result2 = mysqli_query($db,$sqx);
	while ($row2 =mysqli_fetch_array($result2))
	{
		$norows=$row2["value"];
		$lang=$row2["Language"];
	}
	
	if  (strcmp($lang, "English")==0){
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	
	$quoteline = $row["quote"];


	$noletters=strlen($quoteline);
	if (($noletters%$norows) !=0)
	{ 

       $fodder=($norows-($noletters%$norows));
	
		$noletters=$noletters+$fodder;
	}
	$sample=array();
	$wheeloffortune =array_fill(0,$norows,$sample);
	

	for ($x = 0;$x <= $noletters;$x++)
	{
		
	$tested =substr($quoteline,$x,1);
	
	
	if (ctype_space($tested)==false)
	{ $t= $x%$norows;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$norows;
		array_push($wheeloffortune[$t],"-");
	}
	}
	}


for ($r=0;$r<$norows;$r++)
{
	shuffle($wheeloffortune[$r]);
}



for ($y=0;$y<$noletters;$y++)
{ 
if ($y%$norows==0)
{echo "<br>";}
echo $wheeloffortune[$y%$norows][$y/$norows];
 if ($y/$norows==$norows-1) 
 {echo "<br>";}


}
	echo "<br> NOW...CAN YOU SOLVE IT? <br>" ;
	for ($z=0;$z<$noletters;$z++)
{ 
if ($z%$norows==0)
{echo "<br>";}
	$tested =substr($quoteline,$z,1);
	if ((ctype_space($tested)||empty($tested))==false)
	{ 
		echo "_";
	
	} else { 
	echo "-";}
 if ($z/$norows==$norows-1) 
 {echo "<br>";}



	
	}
}

else {
    echo "0 results";
}
	}else {
		if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	
	$quoteline = $row["quote"];
	//makes an array from the line
	$arrayfod=parsetoCodePoints($quoteline);
	$noletters=count($arrayfod);
	if (($noletters%$norows) !=0)
	{ 

       $fodder=($norows-($noletters%$norows));
	   $trash=array(" ");
	for ($arrayfod2=0;$arrayfod2<$fodder+1;$arrayfod2++)
	{array_push($arrayfod, $trash);
	}
	
		$noletters=$noletters+$fodder;
	}
	
	$sample=array();
	$wheeloffortune =array_fill(0,$norows,$sample);
	

	for ($x = 0;$x <= $noletters;$x++)
	{
		
	$tested =parseToCharacter($arrayfod[$x]);
	
	
	if (ctype_space($tested)==false)
	{ $t= $x%$norows;
		array_push($wheeloffortune[$t],$tested);
	
	} else { $t= $x%$norows;
		array_push($wheeloffortune[$t],"-");
	}
	}
	}


for ($r=0;$r<$norows;$r++)
{
	shuffle($wheeloffortune[$r]);
}



for ($y=0;$y<$noletters;$y++)
{ 
if ($y%$norows==0)
{echo "<br>";}
echo $wheeloffortune[$y%$norows][$y/$norows];
 if ($y/$norows==$norows-1) 
 {echo "<br>";}


}
	echo "<br> NOW...CAN YOU SOLVE IT? <br>" ;
	for ($z=0;$z<$noletters;$z++)
{ 
if ($z%$norows==0)
{echo "<br>";}
	$tested =substr($quoteline,$z,1);
	if ((ctype_space($tested)||empty($tested))==false)
	{ 
		echo "_";
	
	} else { 
	echo "-";}
 if ($z/$norows==$norows-1) 
 {echo "<br>";}



	
	}
}

else {
    echo "0 results";
}
	}
?>





</div>