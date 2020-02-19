
<?php $page_title = ' Modify Quote'; ?>
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

    
    
      

      echo '<h2 id="title">Modify Quote</h2><br>';
      echo '<form action="modifyTheQuote.php" method="POST" enctype="multipart/form-data">
      <br>
      <h3>'.$row["quote"].' </h3> <br>
      
      <div>
        <label for="id">Id</label>
        <input type="text" class="form-control" name="id" value="'.$row["id"].'"  maxlength="5" style=width:400px readonly><br>
      </div>
      
      <div>
        <label for="topic">Topic</label>
        <input type="text" class="form-control" name="topic" value="'.$row["topic"].'"  maxlength="255" style=width:400px required><br>
      </div>
      
      <div>
        <label for="author">author</label>
        <input type="text" class="form-control" name="author" value="'.$row["author"].'"  maxlength="255" style=width:400px required><br>
      </div>
          
      <div>
        <label for="quote">quote</label>
        <input type="text" class="form-control" name="quote" value="'.$row["quote"].'"  maxlength="255" style=width:400px required><br>
      </div>
          
    

      <br>
      <div class="text-left">
          <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Question</button>
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


