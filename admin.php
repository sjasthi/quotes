<?php
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";

  include("./nav.php");
  
  

$query = "SELECT * FROM quote_table";

 ?>
 
 <style>
    #title {
        text-align: center;
        color: darkgoldenrod;
    }
    thead input {
        width: 100%;
    }
    .thumbnailSize{
        height: 100px;
        width: 100px;
        transition:transform 0.25s ease;
    }
    .thumbnailSize:hover {
        -webkit-transform:scale(3.5);
        transform:scale(3.5);
    }
</style>

 <div class="right-content">
    <div class="container-fluid">
   <?php
header('Content-type: text/html; charset=utf-8');
 if(isset($_GET['create'])){
            if($_GET["create"] == "Success"){
                echo '<br><h3>Success! Your quote has been added!</h3>';
            }
        }

 if(isset($_GET['deleted'])){
            if($_GET["deleted"] == "Success"){
                echo '<br><h3>We deleted that quote, do not worry</h3>';
            }
        }
 if(isset($_GET['updated'])){
            if($_GET["updated"] == "Success"){
                echo '<br><h3>yes yes, we changed it no worries </h3>';
            }
        }
		if (isset($_GET['id'])) {
			$a =$_GET['id'];
			$query="SELECT * FROM quote_table 
			WHERE author = '$a'";
		}
        
    $db->set_charset("utf8");
		   $data = mysqli_query($db, $query);
		   $inform = array(-1);
?>

<!-- 
Reference: https://www.w3schools.com/tags/att_button_formaction.asp
See the difference between action and formaction.
button formaction overrides form action attribute.
Since we are having specific action for each of the buttons,
it is NOT required to have a action attribute on the form -->

<form method ="POST">
	     <h2 id="title">Quotelist</h2><br>
        <button type = "submit" formaction ="createQuote.php">Create</button>	 
        <button type = "submit" formaction ="modifyQuote.php">Modify</button>
		<button type = "submit" formaction ="deleteQuote.php">Delete</button>
		<button type = "submit"formaction ="DropQuote.php">Drop Quote</button>
		<button type = "submit"formaction ="FloatQuote.php">Float Quote</button>
        <button type ="submit" formaction="FloatList.php">DropFloat</button>
		<button type = "submit"formaction ="Scramble.php">Scramble Quote</button>
        <button type = "submit"formaction ="Split.php">Split Quote</button>
        <button type ="submit" formaction="slider16.php">Slider16</button>
        <button type ="submit" formaction="slider.php">Slider(TBD)</button>
		<button type ="submit" formaction="catchAphrase.php">Catch a Phrase(TBD)</button>
        <button type ="submit" formaction="FeelingLucky.php">Feeling Lucky(TBD)</button>
	 
			
		    <div id="customerTableView">
			  <table class="display" id="ceremoniesTable" style="width:100%">
                 <div class="table responsive">
                <thead>
                <tr>
				<th></th>
				<th>ID</th>
				<th>Author</th>
				<th>Topic</th>
				<th>Quote</th>
				
				</tr>
                </thead>
				  <tbody>
                <?php
				
				if ($data->num_rows > 0) {
					
					 while($row = $data->fetch_assoc()) {
						        echo '<tr>
								<td><input type ="radio" name ="ident" value ='.$row["id"].'></td>
                                <td>'.$row["id"].'</td>
                                <td>'.$row["author"].' </span> </td>
                                <td>'.$row["topic"].'</td>
                         
                                <td>'.$row["quote"].'</td>
								
                            
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
		</form>							

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 


<!--Data Table-->
<script type="text/javascript" charset="utf8"
        src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

<script type="text/javascript" language="javascript">
    $(document).ready( function () {
        
        $('#ceremoniesTable').DataTable( {
            dom: 'lfrtBip',
            buttons: [
                'copy', 'excel', 'csv', 'pdf'
            ] }
        );

        $('#ceremoniesTable thead tr').clone(true).appendTo( '#ceremoniesTable thead' );
        $('#ceremoniesTable thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    
        var table = $('#ceremoniesTable').DataTable( {
            orderCellsTop: true,
            fixedHeader: true,
            retrieve: true
        } );
        
    } );

</script>
</body>
</html>





