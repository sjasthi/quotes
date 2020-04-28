

<?php $page_title = ' Float and Drop Quote'; ?>
<?php 
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
 require 'db_credentials.php'; 
    include("./nav.php");
 

$query = "SELECT * FROM quote_table";

?>


<div class="container">
<style>#title {text-align: center; color: darkgoldenrod;}</style>

<?php
include_once 'db_credentials.php'; 

  $sql = "SELECT * FROM quote_table
            WHERE id = -1";
			$sleep=true;
		$db->set_charset("utf8");
$touched=isset($_POST['ident']);
if (!$touched) {
      header ("Location:http://localhost/quotes/list.php/",FALSE);
	
		
		
} else {     $id = $_POST['ident'];

    $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";
  $sleeper=mysqli_query($db,$sql);
  while ($row2 =mysqli_fetch_array($sleeper))
  {
	  $awake=$row2['id'];
	  
  }
       $data = mysqli_query($db, $query);

	
} ?>
		
		<form action=FloatDrop.php method ="post"> <?php
		echo ' <input type="hidden" id="first" name="first" value='.$awake.'> '?>
		 <button type = "submit">Continue</button>
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
	