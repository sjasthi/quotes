<?php $page_title = ' Quote Scramble'; ?>
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
  echo '<h2 id="title">Scramble Quote</h2><br>';

  $sql = "SELECT * FROM quote_table
            WHERE id = '-1'";

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
  

	
	
	
	
	
}
	$uninpo=1;
	$sqx = "SELECT * FROM pref WHERE id = '$uninpo'";
	$result2 = mysqli_query($db,$sqx);
	
		while ($row2 =mysqli_fetch_array($result2))
	{
		
		$lang=$row2["Language"];
	}
	
		if  (strcmp($lang, "English")==0){
			if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
			$quoteline = $row["quote"];
			$sample=array();
			$sample2=array();
			$noletters=strlen($quoteline);
			for ($x = 0;$x <= $noletters;$x++)
	{
		
	$tested =substr($quoteline,$x,1);
	
	array_push($sample, $tested) ;//array 1: keeps track of the original quote, so we can keep the correct length + non letter placement
	if ( ctype_digit($tested) || ctype_alpha($tested)){ //if a letter or number...
			array_push ($sample2,$tested); //pushes it to a second array, so we can shuffle it! 
			
			
		}
		}
	}
		shuffle($sample2);
		
		$counter=0;
				for ($y = 0;$y <= $noletters;$y++)
	{ $tested =$sample[$y];
if ( ctype_digit($tested) || ctype_alpha($tested))
{ echo $sample2[$counter];
$counter++;
} else  { echo $tested;}


		
		}
		}
			}
		else  {
			
		} ?>