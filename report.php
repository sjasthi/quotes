<?php
  $nav_selected = "REPORTS";
  $left_buttons = "NO";
  $left_selected = "";
 require 'db_credentials.php'; 
  include("./nav.php");
  $query = "SELECT * FROM quote_table";
  $db->set_charset("utf8");
  $GLOBALS['data'] = mysqli_query($db, $query);
 ?>
<?php
include_once 'db_credentials.php'; 

       $wheel=array();
   $samp = array();
     echo '<h2 id="title">Reports</h2><br>';


	if ($data->num_rows > 0) {
			 while($row = $data->fetch_assoc()) {
				 $writer = $row["author"];
				 
				 if (array_key_exists($writer,$wheel))
				 {
					 $wheel[$writer][0]++;
				 } else { 
				 
				
				 $wheel[$writer]=array();
				 $wheel[$writer][0]=1;
				 $wheel[$writer][1]=$writer;
				 
				 }
				 
			 }
			 
	} ?>
			  <table class="display" id="ceremoniesTable" style="width:100%">
  <tr>
    <th>Author</th>
    <th>Total</th>
    <th>Button</th>
  </tr> <?php
foreach ($wheel as $toy){
    echo '<tr>
                                <td>'.$toy[1].'</td>
                                <td>'.$toy[0].' </span> </td>
                         <td><a class="btn btn-warning btn-sm" href="list.php?id='.$toy[1].'">Lists</a></td>
                         
                            
								<td>yes</td>
          >
                            
                            </tr>';
}


?>

<?php include("./footer.php"); ?>
