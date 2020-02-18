<?php
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";

  include("./nav.php");
  
  

$query = "SELECT * FROM quote_table";
  $GLOBALS['data'] = mysqli_query($db, $query);
 ?>

 <div class="right-content">
    <div class="container-fluid">

     
	     <h2 id="title">Quotelist</h2><br>
		  <button><a class="btn btn-sm" href="createQuote.php">Create a Quote</a></button>
		    <div id="customerTableView">
			  <table class="display" id="ceremoniesTable" style="width:100%">
            <div class="table responsive">
                <thead>
                <tr>
				<th>ID</th>
				<th>Author</th>
				<th>Topic</th>
				</tr>
                </thead>
				  <tbody>
                <?php
				
				if ($data->num_rows > 0) {
					
					 while($row = $data->fetch_assoc()) {
						        echo '<tr>
                                <td>'.$row["id"].'</td>
                                <td>'.$row["author"].' </span> </td>
                                <td>'.$row["topic"].'</td>
                         
                                <td>'.$row["quote"].' </span> </td>
                            
                            </tr>';
					 }
				}
					 else {
                    echo "0 results";
                }
				 ?>
				   </tbody>
            </div>
        </table>
    </div>
</div>

    

<?php include("./footer.php"); ?>


