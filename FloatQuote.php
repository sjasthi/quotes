<?php $page_title = ' Quote Drop'; ?>

<?php
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
require 'db_credentials.php';
include("./nav.php");
?>


<?php
error_reporting(0);
include_once 'db_credentials.php';

$sql = "SELECT * FROM quote_table
			WHERE id = '-1'";
$flagged = true;
$spaces = array();
$touched = isset($_POST['ident']);
$db->set_charset("utf8");

if (!$touched) {
	echo 'You need to select an entry. Go back and try again. <br>';

?>

	<button><a class="btn btn-sm" href="admin.php">Go back</a></button>

<?php
} else {
	$id = $_POST['ident'];
	$sql = "SELECT * FROM quote_table
		        WHERE id = '$id'";
}

if (!$result = $db->query($sql)) {
	die('There was an error running query[' . $connection->error . ']');
}

$norows = 16;
?>

<script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<div id="convert-to-image">
	<?php

	echo '<h2 id="title">Float Quote</h2><br>';

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
	$result2 = mysqli_query($db, $sqx);
	while ($row2 = mysqli_fetch_array($result2)) {
		$norows = $row2["value"];
	}



	if ($result->num_rows > 0) {
		while ($row = $result->fetch_assoc()) {
			$quoteline = $row["quote"];
			//makes an array from the line
		}
	}
	if (isset($quoteline) == false){
		exit(0);
	}
	include("puzzlemaker.php");
	FloatM($quoteline, $norows, $touched);
	?>
</div>