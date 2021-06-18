<?php $page_title = ' Quote Drop'; ?>

<?php
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
require 'db_credentials.php';
include("./nav.php");
include("puzzlemaker.php");
//error_reporting(0);
?>

<script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<?php

include_once 'db_credentials.php';
$spaces = array();
$sql = "SELECT * FROM quote_table
			WHERE id = '-1'";
$flagged = true;
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

$nocol = 16;
echo '<h2 id="title">Drop Quote</h2><br>';

$uninpo = 1;
$sqx = "SELECT * FROM preferences WHERE id = '$uninpo'";
$result2 = mysqli_query($db, $sqx);
while ($row2 = mysqli_fetch_array($result2)) {
	$nocol = $row2["value"];
}


if ($result->num_rows > 0) {
	while ($row = $result->fetch_assoc()) {
		$quoteline = $row["quote"];
	}
}
// echo $quoteline."<br>";
if(isset($quoteline)){
	DropM($quoteline, $nocol, $touched);
}
?>
