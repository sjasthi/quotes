<?php
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";

  include("./nav.php");
  
  

$query = "SELECT * FROM quote_table";

 
 
 
 ?>
 
 
 <?php
 
 $data = mysqli_query($db, $query);
 $list=array();
 if ($data->num_rows > 0) {
					
					 while($row = $data->fetch_assoc()) {
						 
						 $tested=$row['topic'];
						 if (!in_array($tested,$list))
						 {
							 array_push($list,$tested);
						 }
						 
						 
					 }
					 
 }
 ?>
 <form action=combolist.php method ="post">
 <input type="number" list="nums" name="nums" max="100" min="10" required> 
 <datalist id="nums">
  <option value =10>
  <option value =25>
  <option value =50>
 <option value =100>
 </datalist> <br>
 <?php foreach($list as $axe) {
	 echo "<input type=\"radio\" id=\"$axe\" name=\"type\" value=\"$axe\" required> 
	 <label for=\"$axe\"> $axe</label><br>";
	 
	 
	 
 }
 ?>
 <input type="radio" id="split" name="ptype" value="split" checked >
 <label for "split">Split Puzzles</label> <br>
 
 <input type="radio" id="scramble" name="ptype" value="scramble">
 <label for "scramble">Scramble Puzzles</label> <br>
 
 <input type="radio" id="drop" name="ptype" value="drop">
 <label for "drop">Drop Puzzles</label> <br>
 
 
 <input type="radio" id="float" name="ptype" value="float">
 <label for "float">Float Puzzles</label> <br>
 
  <input type="radio" id="Dual" name="ptype" value="dual">
 <label for "Dual">Float-Drop Puzzles</label> <br>
  <input type="submit"> 
 
 
 
 <?php
 ?>