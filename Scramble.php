<?php 

$page_title = ' Quote Scramble'; ?>

<?php 
	$nav_selected = "LIST";
	$left_buttons = "NO";
	$left_selected = "";
	require 'db_credentials.php'; 
		include("./nav.php");
		include ("puzzlemaker.php");		
?>

<?php
	include_once 'db_credentials.php'; 
  		echo '<h2 id="title">Scramble Quote</h2><br>';

  	$sql = "SELECT * FROM quote_table
			WHERE id = '-1'";
			
	$db->set_charset("utf8");

	$touched=isset($_POST['ident']);
	if (!$touched) {
		echo 'You need to select an entry. Go back and try again. <br>';		
?>
	<button><a class="btn btn-sm" href="list.php">Go back</a></button>

<?php
	} else {     
		$id = $_POST['ident'];
		$sql = "SELECT * FROM quote_table
				WHERE id = '$id'";		
	}

		if (!$result = $db->query($sql)) {
			die ('There was an error running query[' . $connection->error . ']');
		
		}
		
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){							
				$quoteline = $row["quote"];						
			} 
		}

		$words  = ScrambleMaker($quoteline);
		$arrWord =  str_split_unicode($words);
//		$arrWord =  str_split($words);
		
		if($words == '')die;			
?>	
					
<input type="hidden" id="scrableValue" value="<?php echo $quoteline;?>" >

<div id="cardPile">
	<?php 
		foreach($arrWord as $key => $val){
			if($val == ' '){
				echo '<div class="blank-box" style="border: 1px solid #fff;"></div>';
			}else{
				?>
					<div class="blank-box">
						<div id="card<?php echo  $val;?>" draggable="true" ondragstart="drag(event)">
							<span><?php echo  $val;?></span>
						</div>
					</div>
				<?php
			}
		}
	?>

</div>


<div id="cardSlots">
	<?php 
		foreach($arrWord as $key => $val){
			if($val == ' '){
				echo '<div style="border: 1px solid #fff;"></div>';
			}else{
	?>
	<div ondrop="drop(event)" ondragover="allowDrop(event)"></div>
	
	<?php
			}
		}
	?>
</div>
<div>
	
<button id="submit-game" onclick="checkStats()">Submit</button>
</div>
