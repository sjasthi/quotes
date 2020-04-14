<?php

include_once 'db_credentials.php'; 



$id=1;
    $language= mysqli_real_escape_string($db, $_POST['omega']);
    $colnum = mysqli_real_escape_string($db, $_POST['alpha']);
	  $display =mysqli_real_escape_string($db, $_POST['quote']);
    
   
    
    
       
    
     
            
                 $sql = "UPDATE pref
                  
				  SET 
				   value = '$colnum',
                    Language = '$language',
					display ='$display'
                  WHERE id = '$id'"
				 ;

                mysqli_query($db, $sql);
                
                 header('location: preferences.php?updated=Success');
                




?>