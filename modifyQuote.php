<?php $page_title = ' Modify Quote'; ?>
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
  $db->set_charset("utf8");
  $sql = "SELECT * FROM quote_table
            WHERE id = -1";
  $sleep = true;
  $touched = isset($_POST['ident']);
  if (!$touched) {
    echo "You need to select an entry.";
  ?>
    <button><a class="btn btn-sm" href="list.php">Go back</a></button>
  <?php


  } else {
    $id = $_POST['ident'];
    $sql = "SELECT * FROM quote_table
            WHERE id = '$id'";
  }
  if ($touched) {
    if (!$result = $db->query($sql)) {
      die('There was an error running query[' . $connection->error . ']');
    } //end if
    //end if

    if ($result->num_rows > 0) {
      // output data of each row


      while ($row = $result->fetch_assoc()) {

        echo '<form action="modifyTheQuote.php" method="POST" enctype="multipart/form-data">
      <br>
     <h2 id="title">Modify Quote</h2><br>
      
           <table>
		   <tr>
       <td style="width:100px>   <label for="ida">Id</label> </td>
       <td> <input type="text" class="form-control" name="id" value="' . $row["id"] . '"  maxlength="255" readonly></td>
      </tr>
      
    <tr>
        <td style="width:100px>  <label for="topic">Topic</label></td>
     <td>    <input type="text" class="form-control" name="topic" value="' . $row["topic"] . '"  maxlength="255"  required></td>
  </tr>
      
      <tr>
        <td style="width:100px>  <label for="author">author</label></td>
    <td>     <input type="text" class="form-control" name="author" value="' . $row["author"] . '"  maxlength="255" required></td>
     </tr>
          
   <tr>
       <td style="width:100px>   <label for="quote">quote</label></td>
   <td>      <input type="text" class="form-control" name="quote" value="' . $row["quote"] . '"  maxlength="255" size="200"  required></td>
     </tr>
          
    </table>

      <br>
      <div class="text-left">
          <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Modify Question</button>
      </div>
      <br> <br>
      
      </form>';
      } //end while
    } //end if
  } else {
    echo "0 results";
  } //end else

  ?>

</div>