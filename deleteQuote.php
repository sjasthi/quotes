
<?php $page_title = 'Delete your quote'; ?>
<?php 
   
  require 'db_credentials.php'; 
  

?>
<div class="container">
<style>#title {text-align: center; color: darkgoldenrod;}</style>
<?php
include_once 'db_credentials.php';

if (isset($_GET['id'])){

    $id = $_GET['id'];
    
    $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";

    if (!$result = $db->query($sql)) {
        die ('There was an error running query[' . $connection->error . ']');
    }//end if
}//end if

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo '<form action="deleteTheQuote.php" method="POST">
    <br>
    <h3 id="title">Delete Quote</h3><br>
   
    
    <div class="form-group col-md-4">
      <label for="id">Id</label>
      <input type="text" class="form-control" name="id" value="'.$row["id"].'"  maxlength="5" readonly>
    </div>
    
    <div class="form-group col-md-8">
      <label for="name">Topic</label>
      <input type="text" class="form-control" name="topic" value="'.$row["topic"].'"  maxlength="100" readonly>
    </div>
    
    <div class="form-group col-md-4">
      <label for="category">Author</label>
      <input type="text" class="form-control" name="author" value="'.$row["author"].'"  maxlength="100" readonly>
    </div>
        
    <div class="form-group col-md-4">
      <label for="level">Quote</label>
      <input type="text" class="form-control" name="choice_1" value="'.$row["quote"].'"  maxlength="300" readonly>
    </div>
        
  
           
    <br>
    <div class="text-left">
        <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Confirm Delete Quote</button>
    </div>
    <br> <br>
    
    </form>';

    }//end while
}//end if
else {
    echo "0 results";
}//end else

?>

</div>


