<?php

include_once 'db_credentials.php'; 



$id=1;
    $language= mysqli_real_escape_string($db, $_POST['omega']);
    $colnum = mysqli_real_escape_string($db, $_POST['alpha']);
   $display =mysqli_real_escape_string($db, $_POST['quote']);
    
    
       
    
     
            
                 $sql = "UPDATE preferences
                  
				  SET 
				   value = '$colnum',
                   
                  WHERE id = '1'"
				 ;
				      mysqli_query($db, $sql);

				      $sql = "UPDATE preferences
                  
				  SET 
				   value = '$language',
                   
                  WHERE id = '2'"
				 ;

           
                mysqli_query($db, $sql);
				
				    $sql = "UPDATE preferences
                  
				  SET 
				   value = '$display',
                   
                  WHERE id = '3'"
				 ;
				
				      mysqli_query($db, $sql);
                
                 header('location: preferences.php?updated=Success');
                




?>