<?php
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";

  include("./nav.php");
  
  

$query = "SELECT * FROM quote_table";
  $GLOBALS['data'] = mysqli_query($db, $query);
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
?>
     
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
				<th>Quote</th>
				<th>Modify</th>
				<th>Delete</th>
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
								<td><a class="btn btn-warning btn-sm" href="modifyQuote.php?id='.$row["id"].'">Modify</a></td>
                                <td><a class="btn btn-danger btn-sm" href="deleteQuote.php?id='.$row["id"].'">Delete</a></td>
                            
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





