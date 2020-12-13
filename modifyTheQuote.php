<?php

include_once 'db_credentials.php'; 

if (isset($_POST['id'])){

    $id = mysqli_real_escape_string($db, $_POST['id']);
    $topic = mysqli_real_escape_string($db, $_POST['topic']);
    $author = mysqli_real_escape_string($db, $_POST['author']);
    $quote = mysqli_real_escape_string($db, $_POST['quote']);
    
    
       
    
    
     
            
                 $sql = "UPDATE quote_table 
                  
				  SET  author = '$author',
				   topic = '$topic',
                    quote = '$quote'
                  WHERE id = '$id'"
				 ;

                mysqli_query($db, $sql);
                
                 header('location: admin.php?updated=Success');
                
    
}//end if



?>