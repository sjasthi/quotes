<?php $page_title = ' Quote Drop'; ?>
<?php 
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
  require 'db_credentials.php'; 
    include("./nav.php");
	
	include ("puzzlemaker.php");
?>


<?php
error_reporting(0);
include_once 'db_credentials.php'; 

  $sql = "SELECT * FROM quote_table
            WHERE id = '-1'";
$flagged=true;
$spaces=array();
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
  

	
	
	
	
	
}	$norows = 16; //later i'll update this to take from preferences
  echo '<h2 id="title">Float Quote</h2><br>';

	$uninpo=1;
	$sqx = "SELECT * FROM pref WHERE id = '$uninpo'";
	$result2 = mysqli_query($db,$sqx);
	while ($row2 =mysqli_fetch_array($result2))
	{
		$norows=$row2["value"];
		
	}
	

		if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
	
	$quoteline = $row["quote"];
	//makes an array from the line
		}}
		FloatM($quoteline,$norows);