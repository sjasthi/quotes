<?php $page_title = ' Quote Split'; ?>
<?php 
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
  require 'db_credentials.php'; 
    include("./nav.php");
	//error_reporting(0);
	include ("puzzlemaker.php");
?>
<script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript" src="js/main.js"></script>

<form id="columnnumber_form" method="post">

<input type="submit" name="generate" id="generate" value="Generate" id="generate">
<!-- Width dropdown selector, default value is 10 -->
<label for="width">Columns:</label>
    <select name="width" id="width" autocomplete="off">
        <?php
        if (isset($_POST['width'])) {
            $width = $_POST['width'];
        } else {
            $width = get_preference('DEFAULT_COLUMN_COUNT');
            if (is_null($width)) {
                // if no datbase preference for width exists, default value is 16
                $width = "12";
            }
        }
        for ($i = 8; $i <= 13; $i++) {
            echo '<option value="' . $i . '"' . (($i == $width) ? ' selected' : '' ) .'>' . $i . '</option>';
        }
        ?>
    </select>

        <?php
                    echo '<input type="hidden" name="ident" value="'.$_POST["ident"].'"> ';
        ?>

</form>



<?php
include_once 'db_credentials.php'; 
include("./colorScheme.php");



  $sql = "SELECT * FROM quote_table
			WHERE id = '-1'";
			
			$db->set_charset("utf8");

$touched=isset($_POST['ident']);
if (!$touched) {
	echo 'You need to select an entry. Go back and try again. <br>';
	
	?>
		  <button><a class="btn btn-sm" href="admin.php">Go back</a></button>
	<?php
} else {     $id = $_POST['ident'];
    $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";
}

if (!$resultQuote = $db->query($sql)) {
    die ('There was an error running query[' . $connection->error . ']');
}

$punctuation=TRUE;
echo '<h2 id="title">Split Quote</h2><br>';
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

		//added in 
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
		//added in

	if ($resultQuote->num_rows > 0) {
	while($row = $resultQuote->fetch_assoc()){
	
		$quoteline = $row["quote"];
	
	} 
	if (isset($quoteline) == false){
		exit(0);
	}
	else {
		if ($punctuation == "FALSE"){
			$quoteline = str_replace(['?', '!', "'", '.', '-', ';', ':', '[', ']',
			 ',', '/','{', '}', ')', '('], '', $quoteline);
		}
		SplitMaker($quoteline, $nochars);
	}
}
?>
