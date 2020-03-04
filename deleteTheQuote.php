<?php

include_once 'db_credentials.php';

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);
 

   

    $sql = "DELETE FROM quote_table
            WHERE id = '$id'";

    mysqli_query($db, $sql);
    header('location: list.php?deleted=Success');
}//end if
?>

