<?php

include_once 'db_credentials.php'; 



$id=1;
    $language= mysqli_real_escape_string($db, $_POST['omega']);
    $colnum = mysqli_real_escape_string($db, $_POST['alpha']);
   
    
    
       
    
     
            
                 $sql = "UPDATE pref
                  
				  SET 
				   COLUMNS = '$colnum',
                    Language = '$language'
                  WHERE id = '$id'"
				 ;

                mysqli_query($db, $sql);
                
                 header('location: preferences.php?updated=Success');
                




?>