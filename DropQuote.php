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
include("./colorScheme.php");

$flagged = true;
$db->set_charset("utf8");

$nocol = 12;

//if (!$columncount) {
    //fetch the default column count from the database
    //} else{
        //get the column count from $POST
//}

//change default 16 to variable

$nocol = 12;

if (!(isset($_POST['ident']))) {
	echo 'No entry selected. Go back and try again. <br>';
?>
	<button style="background:rgb(15,155,205)"><a style="color:white" class="btn btn-sm" href="admin.php">Go Back</a></button><br>
<?php
} else {
	$sql = "SELECT * FROM quote_table WHERE id = ".$_POST['ident'];
	$result = mysqli_query($db, $sql);
	$quoteline = mysqli_fetch_array($result);

	echo '<h2 id="title">Drop Quote</h2> ';
	?>
	<label for="columncount"> </label>
	<select id="columncount" name="columncount">
				<option value="blank">Column Size:</option>
					 <option value="6">6</option>
				<option value="7">7</option>
				<option value="8">8</option>
				<option value="9">9</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
			</select>
	<?php
	
	$sqColor= 'BLUE';
    $sqx = "SELECT * FROM preferences WHERE name = 'SQUARE_COLOR_PREFERENCE'";
    $resultSq = mysqli_query($db,$sqx);

    while ($rowSq =mysqli_fetch_array($resultSq))
    { 
        $sqColor=$rowSq["value"];
    }

    $letterColor= 'BLUE';
    $sqx = "SELECT * FROM preferences WHERE name = 'LETTER_COLOR_PREFERENCE'";
    $resultLetter = mysqli_query($db,$sqx);

    while ($rowLetter =mysqli_fetch_array($resultLetter))
    { 
        $letterColor=$rowLetter["value"];
    }

    $fillColor= 'BLUE';
    $sqx = "SELECT * FROM preferences WHERE name = 'FILL_COLOR_PREFERENCE'";
    $resultFill = mysqli_query($db,$sqx);

    while ($rowFill =mysqli_fetch_array($resultFill))
    { 
        $fillColor=$rowFill["value"];
    }

    $lineColor= 'BLUE';
    $sqx = "SELECT * FROM preferences WHERE name = 'LINE_COLOR_PREFERENCE'";
    $resultLine = mysqli_query($db,$sqx);

    while ($rowLine =mysqli_fetch_array($resultLine))
    { 
        $lineColor=$rowLine["value"];
    }
	
	$columnCountSQL = "SELECT * FROM preferences WHERE name = 'DEFAULT_COLUMN_COUNT'";
	$result2 = mysqli_query($db, $columnCountSQL);
	$columnCount = mysqli_fetch_array($result2);

	$punctuationSQL = "SELECT * FROM preferences WHERE name = 'KEEP_PUNCTUATION_MARKS'";
	$result2 = mysqli_query($db, $punctuationSQL);
	$punctuation = mysqli_fetch_array($result2);

$uninpo = 1;
$sqx = "SELECT * FROM preferences WHERE id = '$uninpo'";
$result2 = mysqli_query($db, $sqx);
while ($row2 = mysqli_fetch_array($result2)) {
	$nocol = $row2["value"];
}
	if(isset($quoteline)){

		if($punctuation['value'] == 'FALSE'){
			$regex = '/[^a-z\s]/i';
			$quoteline = preg_replace($regex, '', $quoteline);
		}

		DropMaker($quoteline['quote'], $columnCount['value']);
	}

}
?>
