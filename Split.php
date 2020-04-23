<?php $page_title = ' Quote Split'; ?>
<?php 
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
  require 'db_credentials.php'; 
    include("./nav.php");
	include ("telugu_parser.php");
?>

<?php
include_once 'db_credentials.php'; 


  $sql = "SELECT * FROM quote_table
			WHERE id = '-1'";
			
			$db->set_charset("utf8");

$touched=isset($_POST['ident']);
if (!$touched) {
	echo 'You need to select an entry. Go back and try again. <br>';
	
	?>
		  <button><a class="btn btn-sm" href="list.php">Go back</a></button>
	<?php
} else {     $id = $_POST['ident'];
    $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";
    

	
}

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
  

	
	
	
	
	
} $nochars=3;
  echo '<h2 id="title">Split Quote</h2><br>';
$uninpo=1;
	$sqx = "SELECT * FROM pref WHERE id = '$uninpo'";
	$result2 = mysqli_query($db,$sqx);
	
	while ($row2 =mysqli_fetch_array($result2))
	{ 
	$nochars=$row2["Chunks"];
		
	}
	

	
	
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	
	$quoteline = $row["quote"];
	
	$arrayfod=parsetoCodePoints($quoteline);
	
	$noletters=count($arrayfod);
	
	if ($noletters%$nochars ==0)
	{ $fodder=0;
	} else $fodder=1;
	$fodder2= ($noletters/$nochars)+$fodder;
	
	$sample=array();
	$wheeloffortune =array_fill(0,$fodder2,$sample);
	
	for ($x=0;$x<$noletters;$x++)
	{ $tested =parseToCharacter($arrayfod[$x]);

array_push($wheeloffortune[$x/3],$tested);
	}
	shuffle($wheeloffortune);
	}
}


	$counter=0;
		echo '<font size="18">';

	foreach($wheeloffortune as $value)
	
	{ foreach ($value as $value2)
		{ echo $value2;
		
		}
		
	
		 echo "<br>";
		
	}echo '</font>';
	

?>