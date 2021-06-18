<?php 

	//error_reporting(0);
	include ("puzzlemaker.php");
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
		  <button><a class="btn btn-sm" href="slider.php">Go back</a></button>
	<?php
} else {     $id = $_POST['ident'];
    $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";
    

	
}

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
  
	
} $nochars=3;
  echo '<h2 id="title">Split Quote view as Slider</h2><br>';
  $punctuation=TRUE;
  $sqx = "SELECT * FROM preferences WHERE name = 'KEEP_PUNCTUATION_MARKS'";
  $resultPunct = mysqli_query($db,$sqx);
  
  while ($rowPunct =mysqli_fetch_array($resultPunct))
  { 
  	$punctuation=$rowPunct["value"];	
  }


$nochars=3;
	$sqx = "SELECT * FROM preferences WHERE name = 'DEFAULT_CHUNK_SIZE'";
	$result2 = mysqli_query($db,$sqx);
	
	while ($row2 =mysqli_fetch_array($result2))
	{ 
		$nochars=$row2["value"];
	}
	$result2 = mysqli_query($db,$sqx);
	
	while ($row2 =mysqli_fetch_array($result2))
	{ 
	$nochars=$row2["Chunks"];
		
	}
	

	
	
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	
	$quoteline = $row["quote"];
	
	
	} }
SplitMaker($quoteline,$nochars);


?>