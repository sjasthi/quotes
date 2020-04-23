<?php

  // set the current page to one of the main buttons
  $nav_selected = "HOME";

  // make the left menu buttons visible; options: YES, NO
  $left_buttons = "NO";

  // set the left menu button selected; options will change based on the main selection
  $left_selected = "";

  include("./nav.php");
  $query = "SELECT quote FROM quote_table ORDER BY RAND() LIMIT 1";
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
 color: white;	  
	    margin: 20px;
  padding: 20px;
  }
</style>
</head>

<body>
<h2 style = "color: #01B0F1; margin:40px">Welcome to ABC </h3>
</body>
<?php 
header('Content-type: text/html; charset=utf-8');
$db->set_charset("utf8");
   $data = mysqli_query($db, $query);
   
   if ($data->num_rows > 0) {
					
					 while($row = $data->fetch_assoc()) {
					echo ' <span class="block">
					
					
					'.$row["quote"].'
</span> ';					
					
						 
					 }
   }
 
 
 ?>

</html>