<?php $page_title = ' Quote Scramble'; ?>
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
} else {     $id = $_POST['ident'];
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
			
			ScrambleMaker($quoteline);?>