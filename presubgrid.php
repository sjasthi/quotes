<?php

include_once 'db_credentials.php'; 

$id=1;

    $height = mysqli_real_escape_string($db, $_POST['height']);
	$width =mysqli_real_escape_string($db, $_POST['width']);    
            
        $sql = "UPDATE pref                  
				SET 
				VALUE = '.$height.'
                WHERE NAME = 'GRID_HEIGHT'"
				;

                mysqli_query($db, $sql);
				
		$sql = "UPDATE pref                  
				SET 
				VALUE = '.$width.'
                WHERE NAME = 'GRID_WIDTH'"
				;

                mysqli_query($db, $sql);
                
         header('location: preferences.php?updated=Success');
