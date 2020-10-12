 <div class="container text-center">
          
        </div>
       
                
       <div class="quiz">
      
      <?php
      
   //echo"<div class='quiz'>";

        	      
               $arr=array();
               $ans=$quoteline;

               $s=trim($quoteline);
               
                
                $chnk=$nochars;
              
               
              

              for($i=0; $i<strlen($s); $i=$i+$chnk) {
               
                $sbs=substr($s,$i,$chnk);
                  array_push($arr, $sbs);

                   }
                   shuffle($arr);
                  foreach ($arr as $key => $value) {
                     echo"<div class='box text-center butNotHere'> <span>$value</span></div>  ";
                  }
                   
            
            
             
            
             
        
       // echo"</div><hr> ";
         
          ?>
          </div>
          <div class="row" style="clear: both;">
            <div class="col-md-4">
          <button class="btn btn-primary btn-large" onclick='showAns();'>See Answer</button>
          </div>
           <div class="col-md-7">

          <h4 id="answer"></h4>
          </div>
        </div>
         <script type="text/javascript">
          function showAns(){
              var ans = "<?php echo $ans ?>";
               document.querySelector('#answer').innerHTML=ans;
           }
         </script>