
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Quiz</title>
    <link rel="stylesheet" href="css/cjui.css">
    <script src="jquery/jquery.js"></script>
    <script src="jquery/jui.js"></script>
     <link rel="stylesheet" href="stylesjs.css">
     <script type="text/javascript" src="script_16.js"></script>

          <link rel="stylesheet" href="stylesjs.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
     <script type="text/javascript">
      $(document).ready(function(){
   
     $(".box").draggable({
      obstacle:".butNotHere",
    preventCollision: true,
  containment:".quiz",
  grid:[10,10],
  start: function(event, ui) {
    $(this).removeClass('butNotHere');
  },
  stop: function(event, ui) {
    $(this).addClass('butNotHere');
  }

         
       
     });
      
      });
   </script>
   
    
   <style media="screen">
   body{
   background:#fff;
   margin: 0;
  
   padding: 0;
   }
      .quiz{
        min-width:70vw;
        margin: 20px auto;
        border:1px solid #000;
         height:320px;
       overflow: scroll;
       
        padding: 3%;
        background:#fff;
        text-align:center;
        
      }
    
      .box{
        text-align: center;
        min-width:80px;
        height:50px;
        margin-top:25px;
        margin-left: 25px;
        background: #ffffff;
        float:left;
        border:1px solid #000;
       text-align:center;
       padding: 8px;
       font-size:22px;
       cursor:pointer;
      }
     ul {
           display: block;
           text-align: center;
      }
      li{
        display:inline-block;
        margin: 10px;
        padding: 5px;
        color: #000;
        font-weight: bolder;
      }
      li a{
 padding: 5px;
        color: #000;
      }
   
     
   </style>
      </head>
      <body>
             
       
             

    <?php $page_title = ' Quote Slider'; ?>
    <?php 
    $nav_selected = "LIST";
    $left_buttons = "NO";
    $left_selected = "";
    require 'db_credentials.php'; 
    include("./nav.php");

    ?>
       <br>
         
         <nav>
 
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="slider.php?custom">My Quote</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="slider.php?num">Number Puzzle</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="slider.php?slider_quote">slider quote</a>
      </li>
       <li class="nav-item">
        <a class="nav-link" href="slider.php?quote">quote puzzle</a>
      </li>
    </ul>
   
  </div>
</nav>

       <br>
    <?php

        include_once 'db_credentials.php'; 


    $sql = "SELECT * FROM quote_table
    WHERE id = '1'";

    $db->set_charset("utf8");

    $touched=isset($_POST['ident']);
    if (!$touched) {
   
    ?>

    <?php
    } else {  

    $id = $_POST['ident'];
    $sql = "SELECT * FROM quote_table
    WHERE id = '$id'";



    }

    if (!$result = $db->query($sql)) {
    die ('There was an error running query[' . $connection->error . ']');



    }


    if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
     $quoteline = $row["quote"];

    } }



    ?>
    <?php
        include 'slider16/index.php';
      

    ?>
    
           

       
 
      </body>
    </html>
