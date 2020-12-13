<?php $page_title = 'Delete your quote'; ?>
<?php
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
require 'db_credentials.php';
include("./nav.php");

?>
<div class="container">
    <style>
        #title {
            text-align: center;
            color: darkgoldenrod;
        }
    </style>
    <?php
    include_once 'db_credentials.php';


    $sql = "SELECT * FROM quote_table
            WHERE id = '-1'";

    $db->set_charset("utf8");

    $touched = isset($_POST['ident']);
    if (!$touched) {
        echo 'You need to select an entry. Go back and try again. <br>';

    ?>
        <button><a class="btn btn-sm" href="list.php">Go back</a></button>
    <?php
    } else {
        $id = $_POST['ident'];
        $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";
    }

    if (!$result = $db->query($sql)) {
        die('There was an error running query[' . $connection->error . ']');
    } //end if


    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo '<form action="deleteTheQuote.php" method="POST" >
    <br>
    <h3 id="title">Delete Quote</h3><br>
   
    
       
     
      
        
    
      
      
        <table>
			<tr>
		<td style="width:100px> <label for="categoryx">ID</label> </td>
		 <td><input type="text" class="form-control" name="id" value="' . $row["id"] . '"  maxlength="5" readonly> </td>
		    </tr>
		<tr>
     <td style="width:100px> <label for="category">Author</label> </td>
      <td><input type="text" class="form-control" name="author" value="' . $row["author"] . '"  maxlength="50" size="50" readonly></td>
   </tr>
	      
	   	<tr>
    <td style="width:100px>  <label for="name">Topic</label></td>
    <td>  <input type="text" class="form-control" name="topic" value="' . $row["topic"] . '"  maxlength="50" size="50" readonly></td>
   </tr>
    
        
	<tr>
      <td style="width:100px><label for="level">Quote</label></td>
     <td> <input type="text" class="form-control" name="choice_1" value="' . $row["quote"] . '"  maxlength="300" size="200"  readonly></td>
 </tr>
    </table>    
  
           
    <br>
     <div align="center" class="text-left">
        <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center"> Delete Quote</button>
    </div>
    <br> <br>
    
    </form>';
        } //end while
    } //end if
    else {
        echo "0 results";
    } //end else

    ?>

</div>