<?php
require_once './initialize.php';
require_once './indic-wp.php';


?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="styles/main_style.css" type="text/css">
         -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles/custom_colorScheme.css" type="text/css">
  <title> Quotes</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./mainStyleSheet.css">
  <link rel="stylesheet" href="css/cjui.css">
  <script src="jquery/jquery.js"></script>
  <script src="jquery/jui.js"></script>
  <!--<script src="scramble.js"></script>-->
</head>

<body class="body_background">
  <div id="wrap">
    <div id="colorScheme">
    
   <input type="button" id="cs1" value="1" onclick="setScheme(this)"></input>
   <input type="button" id="cs2" value="2" onclick="setScheme(this)"></input>
   <input type="button" id="cs3" value="3" onclick="setScheme(this)"></input>

    </div>
    <script>
<?php
/*
$sqColor1 = 'yellow';
$lineColor1 = 'red';
$letterColor1 = 'green';
$fillColor1 = 'black';
*/

     $sqx = "SELECT name, value FROM preferences WHERE name LIKE '%COLOR%'";
     $sqColorResult = mysqli_query($db,$sqx);

     while ($rowSqColor = mysqli_fetch_array($sqColorResult))
     { 
         echo $rowSqColor["name"].'="'.$rowSqColor["value"].'"; ';
         if (  $rowSqColor["name"] == "SQUARE_COLOR_PREFERENCE") {
                $sqColor1 = $rowSqColor["value"];

         }
         if (  $rowSqColor["name"] == "LINE_COLOR_PREFERENCE") {
                $lineColor1 = $rowSqColor["value"];

         }
         if (  $rowSqColor["name"] == "LETTER_COLOR_PREFERENCE") {
                $letterColor1 = $rowSqColor["value"];

         }
         if (  $rowSqColor["name"] == "FILL_COLOR_PREFERENCE") {
                $fillColor1 = $rowSqColor["value"];

         }
    }
    ?> 
    sqColor1 = SQUARE_COLOR_PREFERENCE;
    lineColor1 = LINE_COLOR_PREFERENCE;
    letterColor1 = LETTER_COLOR_PREFERENCE;
    fillColor1 = FILL_COLOR_PREFERENCE;

function setScheme(src) {

        try {
                document.getElementById("convert").style.backgroundColor = eval("SQUARE_COLOR_" + src.value);
                document.getElementById("convert").style.color = eval("LETTER_COLOR_" + src.value);
                $('td').css('border-color', eval("LINE_COLOR_" + src.value));
                $('.black-box').css('background-color', eval("FILL_COLOR_" + src.value));

                //added bc preferences page
                document.getElementById("convert").style.backgroundColor = SQUARE_COLOR_PREFERENCE.value;
                document.getElementById("convert").style.color = LETTER_COLOR_PREFERENCE.value.value;
                $('td').css('border-color', FILL_COLOR_PREFERENCE.value);
                $('.black-box').css('background-color', LINE_COLOR_PREFERENCE.value);
        }
        catch (e) {
                //alert("Error in set scheme: " + e);
        }

}
</script>
</body>