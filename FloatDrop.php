<?php $page_title = ' Double Puzzle'; ?>

<?php
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
require 'db_credentials.php';
include("./nav.php");
include("puzzlemaker.php");
error_reporting(0);
?>

<script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<?php

include_once 'db_credentials.php';
include("./colorScheme.php");

$sql = "SELECT * FROM quote_table
			WHERE id = '-1'";
$db->set_charset("utf8");

$flagged = true;
$spaces = array();
$touched = isset($_POST['ident']);
$touched2 = isset($_POST['first']);
if (!$touched || !$touched2) {
	echo 'You need to select an entry. Go back and try again. <br>';

?>
	<button><a class="btn btn-sm" href="admin.php">Go back</a></button>
<?php
} else {
	$id = $_POST['first'];
	$sql = "SELECT * FROM quote_table
            	WHERE id = '$id'";
	$id2 = $_POST['ident'];

	$sql2 = "SELECT * FROM quote_table
            	WHERE id = '$id2'";
}

if (!$result = $db->query($sql)) {
	die('There was an error running query[' . $connection->error . ']');
}

echo '<h2 id="title">Double Puzzle</h2><br>';
$norows = 16;
$uninpo = 1;

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
	}
}
if (isset($quoteline) == false){
	exit(0);
}

if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$result3 = mysqli_query($db, $sql2);
		$quoteline = $row["quote"];
		while ($row3 = mysqli_fetch_array($result3)) {
			$quoteline2 = $row3["quote"];
		}
	}
}
else {
		if ($punctuation == "FALSE"){
			$quoteline = str_replace(['?', '!', "'", '.', '-', ';', ':', '[', ']',
			 ',', '/','{', '}', ')', '('], '', $quoteline);
		}

	FloatDrop($quoteline, $quoteline2, $norows, $touched2);
}
?>