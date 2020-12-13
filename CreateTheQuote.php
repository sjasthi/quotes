<?php
   
include_once 'db_credentials.php';
	
	  $man = mysqli_real_escape_string($db,$_POST['man']);
	  $subject = mysqli_real_escape_string($db,$_POST['subject']);
	  $quoted = mysqli_real_escape_string($db,$_POST['quoted']);
	  
	    $sql = "INSERT INTO quote_table(author,topic,quote)
                VALUES ('$man','$subject','$quoted')
                ";

                mysqli_query($db, $sql);
                header('location: admin.php?create=Success');
?>