<?php $page_title = ' Quote Drop'; ?>
<?php 
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
  require 'db_credentials.php'; 
    include("./nav.php");
?>

<?php
include_once 'db_credentials.php'; 

if (isset($_GET['id'])){

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
}
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	
	$quoteline = $row["quote"];
	$norows = 16; //later i'll update this to take from preferences
	$noletters=strlen($quoteline);
	if (($noletters%$norows) !=0)
	{ 

       $fodder=(16-($noletters%$norows));
	
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
if ($y%16==0)
{echo "<br>";}
echo $wheeloffortune[$y%16][$y/16];
 if ($y/16==15) 
 {echo "<br>";}


}
	echo "<br> NOW...CAN YOU SOLVE IT? <br>" ;
	for ($z=0;$z<$noletters;$z++)
{ 
if ($z%16==0)
{echo "<br>";}
	$tested =substr($quoteline,$z,1);
	if ((ctype_space($tested)||empty($tested))==false)
	{ 
		echo "_";
	
	} else { 
	echo "-";}
 if ($z/16==15) 
 {echo "<br>";}



	
	}
}

else {
    echo "0 results";
}


?>





</div>