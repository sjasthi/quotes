<?php $page_title = 'Pref'; ?>
<?php 
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";

 require 'db_credentials.php'; 
   include("./nav.php");
 ?>

<?php 
 if(isset($_GET['updated'])){
            if($_GET["updated"] == "Success"){
                echo '<br><h3>yes yes, we changed it no worries </h3>';
            }
        }





$sql = "SELECT * FROM pref WHERE  ID = '1'";


   
   
    if (!$result = $db->query($sql)) {
	die ('There was an error running query[' . $connection->error . ']');}
	
	if ($result->num_rows > 0) {
 
    while($row = $result->fetch_assoc()) {
		
	echo '<form action="presub.php" method="post">
		Number of Rows: <input type ="number" name="alpha" min="1"><br>
		<input type ="radio" id="e" name="omega" value ="English"> 
		<label for "e"> English</label><br>
		<input type ="radio" id="t" name="omega" value ="Telugu"> 
		<label for "t"> Telugu</label><br>      
		<input type ="radio" id="a1" name="quote" value ="Puzzles"> 
		<label for "a1"> Display Puzzles</label><br>    
		<input type ="radio" id="a2" name="quote" value ="Quotes"> 
		<label for "a2"> Display Quotes</label><br>    
		<input type ="radio" id="a3" name="quote" value ="Both"> 
		<label for "a3"> Display Both</label><br>    
<input type="submit" value="submit">
		</form>';
	}
	}
   ?>
