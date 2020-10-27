<?php

  // set the current page to one of the main buttons
  $nav_selected = "HOME";

  // make the left menu buttons visible; options: YES, NO
  $left_buttons = "NO";

  // set the left menu button selected; options will change based on the main selection
  $left_selected = "";

  include("./nav.php");

  $query = "SELECT quote FROM quote_table ORDER BY RAND() LIMIT 1";
  $query2="SELECT * FROM pref";
?>

<html>

<head>
<style>
table.center {
    margin-left:auto; 
    margin-right:auto;
  }
  span.block {
	  background-color: black;
	  position:relative; 
 color: white;	  
	    margin: 20px;
  padding: 30px;
  line-height:1.6;
  }
</style>
<link rel="stylesheet" href="css/cjui.css">
    <script src="jquery/jquery.js"></script>
    <script src="jquery/jui.js"></script>
</head>

<body>
<h2 style = "color: #01B0F1; margin:40px">Welcome to QuoteMaster </h3>
</body>
<?php 
header('Content-type: text/html; charset=utf-8');
$db->set_charset("utf8");
   $data = mysqli_query($db, $query);
    $data2 = mysqli_query($db, $query2);
	
	 if ($data->num_rows > 0) {
					
					 while($row2 = $data2->fetch_assoc()) {
						 $axe=$row2['display'];
						 $value =$row2['value'];
						 
						if( strcmp($axe,"Both")==0){ $axis=rand(1,2) ;//selects a random variable
						}else if( strcmp($axe,"Quotes")==0)
						{$axis=3;
						}else{$axis=4;}
					 }
	
	 }
	
	
	
   if ($data->num_rows > 0) {
					
					
					
					 while($row = $data->fetch_assoc()) {
						 if($axis==1||$axis==3){
					echo ' <span class="block">
					
					
					'.$row["quote"].'
</span> ';					
					
						 
   } else {
	     include("puzzlemaker.php");
	   DropM($row["quote"],$value);
   }
   }
   }
 
 
 ?>

</html>