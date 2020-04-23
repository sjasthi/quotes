<?php $page_title = ' MultiPuzzle'; ?>
<?php 
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
  require 'db_credentials.php'; 
    include("./nav.php");
	include ("puzzlemaker.php");
	error_reporting(0);
	
	
	$puzzles = $_POST['nums'];
	$topic =$_POST['type'];
	$method = $_POST['ptype'];
	
	//we go over all entries that have the topic in the database, and push them to an array
$sql =  "SELECT * FROM quote_table
		  WHERE topic = '$topic'";
		  
		  $db->set_charset("utf8");

$quotecol=array();


    if (!$result = $db->query($sql)) {
        die ('There was an error running query');
	  
	  }	
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){

array_push($quotecol,$row['quote']);
	}
}


$uninpo=1;
	$sqx = "SELECT * FROM pref WHERE id = '$uninpo'";
	$result2 = mysqli_query($db,$sqx);
	while ($row2 =mysqli_fetch_array($result2))
	{
		$norows=$row2["value"];
		
	}
$max=count($quotecol);

for ($x=0;$x<$puzzles;$x++)
{
	$r=rand(0,$max);
	$s=$quotecol[$r];
	
	if ($method =="split")
	{SplitMaker($s);} 
else if ($method=="scramble") {ScrambleMaker($s);} 
else if ($method=="drop"){DropM($s,$norows);} 
else {FloatM($s,$norows);}
	
	
}





















	?>