<?php
  ini_set('display_errors', 1);
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";
  require 'db_credentials.php';
  include("./nav.php");
  include("puzzlemaker.php");
?>
<style media="screen">
  body {
    background: #fff;
    margin: 0;
    padding: 0;
  }
  .quiz {
    min-width: 70vw;
    margin: 20px auto;
    border: 1px solid #000;
    height: 320px;
    overflow: scroll;

    padding: 3%;
    background: #fff;
    text-align: center;
  }

  .box {
    text-align: center;
    min-width: 80px;
    height: 50px;
    margin-top: 25px;
    margin-left: 25px;
    background: #ffffff;
    float: left;
    border: 1px solid #000;
    text-align: center;
    padding: 8px;
    font-size: 22px;
    cursor: pointer;
  }

  ul {
    display: block;
    text-align: center;
  }

  li {
    display: inline-block;
    margin: 10px;
    padding: 5px;
    color: #000;
    font-weight: bolder;
  }

  li a {
    padding: 5px;
    color: #000;
  }
</style>

<link type="text/css" media="all" href="phrase_style.css" rel="stylesheet" />
<script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<button><a class="btn btn-sm" href="admin.php">Go back</a></button>

<?php
  $spaces = array();
  //Use id given if game is played from home screen
  if(isset($_GET['id'])){
    $sql = "SELECT * FROM quote_table WHERE id =".$_GET['id'];
  }else{
    //Puzzle generation dependant on feeling_lucky_mode when no id is given
    $modeType = "SELECT * FROM preferences WHERE name = 'FEELING_LUCKY_MODE'";
    $result = mysqli_query($db, $modeType);
    $mode = mysqli_fetch_array($result);

    if($mode['value'] == 'FIRST'){
      $sql = "SELECT * FROM quote_table limit 1";
    }elseif ($mode['value'] == 'LAST') {
      $sql = "SELECT * FROM quote_table order by id DESC limit 1";
    }else{
      $length = "SELECT * FROM quote_table order by id DESC limit 1";
      $result = mysqli_query($db,$length);
      $lastID = mysqli_fetch_array($result);
      $id = mt_rand(1,$lastID['id']);
      $randomID = $id;
      //echo($randomID);
      $sql = "SELECT * FROM quote_table where id = ".$id;
      //Check the data to determine if a quote was retrieved. Quote generation
      //Defaults to the last quote when no quote was retrieved.
      $check = mysqli_query($db, $sql);
      $row = mysqli_fetch_array($check);
      if($row['quote'] == ''){
        $sql = "SELECT * FROM quote_table order by id DESC limit 1";
        $randomID = $lastID['id'];
      }
    }
  }

  $flagged = true;
  $db->set_charset("utf8");

  if (!$result = $db->query($sql)) {
    die('There was an error running query[' . $connection->error . ']');
  }

  $nocol = $norows =  16; //later i'll update this to take from preferences
  echo '<h2 id="title">Drop Quote</h2><br>';

  $default_column_count = "SELECT * FROM preferences WHERE name = 'DEFAULT_COLUMN_COUNT'";
  $result2 = mysqli_query($db, $default_column_count);

  while ($row2 = mysqli_fetch_array($result2)) {
    $nocol = $row2["value"];
  }

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $quoteline = $row["quote"];
    }
  }

  if(isset($quoteline)){
    DropM($quoteline, 20, $nocol);
  }
?>
<hr />

<?php
  error_reporting(1);

  if (!$result = $db->query($sql)) {
    die('There was an error running query[' . $connection->error . ']');
  }

  $norows = 16;
?>

<div id="convert-to-image">

<?php
  echo '<h2 id="title">Float Quote</h2><br>';
  $result2 = mysqli_query($db, $default_column_count);

  while ($row2 = mysqli_fetch_array($result2)) {
    $norows = $row2["value"];
  }

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $quoteline = $row["quote"];
      //makes an array from the line
    }
  }
  if(isset($quoteline)){
    FloatM($quoteline, 20, $norows);
  }
?>
</div>

<hr />

<?php
  echo '<h2 id="title">Scramble Quote</h2><br>';

  $db->set_charset("utf8");

  if (!$result = $db->query($sql)) {
    die('There was an error running query[' . $connection->error . ']');
  }

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $quoteline = $row["quote"];
    }
  }
  if(isset($quoteline)){
    $words  = ScrambleMaker($quoteline);
    $arrWord =  str_split_unicode($words);
//    $arrWord =  str_split($words);
  }
  if ($words == '') die;
?>

<input type="hidden" id="scrableValue" value="<?php echo $quoteline; ?>">

<div id="cardPile">
  <?php
    foreach ($arrWord as $key => $val) {
      if ($val == ' ') {
        echo '<div class="blank-box" style="border: 1px solid #fff;"></div>';
      } else {
  ?>
  <div class="blank-box">
    <div id="card<?php echo  $val; ?>" draggable="true" ondragstart="drag(event)">
      <span><?php echo  $val; ?></span>
    </div>
  </div>
  <?php
    }
  }
  ?>

</div>

<div id="cardSlots">
  <?php
  foreach ($arrWord as $key => $val) {
    if ($val == ' ') {
      echo '<div style="border: 1px solid #fff;"></div>';
    } else {
  ?>
  <div ondrop="drop(event)" ondragover="allowDrop(event)"></div>
  <?php
    }
  }
  ?>
</div>
<div>
  <button id="submit-game" onclick="checkStats()">Submit</button>
</div>

<hr />

<?php $page_title = ' Quote Split'; ?>
<?php

  $db->set_charset("utf8");

  if (!$result = $db->query($sql)) {
    die('There was an error running query[' . $connection->error . ']');
    }
  echo '<h2 id="title">Split Quote</h2><br>';

  $default_chunk = "SELECT * FROM quote_table WHERE name ='DEFAULT_CHUNK_SIZE'";
  $result2 = mysqli_query($db, $default_chunk);

  $nochars = 3;
  while ($row2 = mysqli_fetch_array($result2)) {
    $nochars = $row2["value"];
  }

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $quoteline = $row["quote"];
    }
  }

  if(isset($quoteline)){
    SplitMaker($quoteline, $nochars);
  }
?>

<hr />

<script type="text/javascript" src="script_16.js"></script>

<link rel="stylesheet" href="stylesjs.css">

<script type="text/javascript">
  $(document).ready(function() {

    $(".box").draggable({
      obstacle: ".butNotHere",
      preventCollision: true,
      containment: ".quiz",
      grid: [10, 10],
      start: function(event, ui) {
        $(this).removeClass('butNotHere');
      },
      stop: function(event, ui) {
        $(this).addClass('butNotHere');
      }

    });

  });
</script>

<?php $page_title = ' Quote Slider'; ?>

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

  if (!$result = $db->query($sql)) {
    die('There was an error running query[' . $connection->error . ']');
  }

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $quoteline = $row["quote"];
    }
  }
//"అ,హిం,స,కు,మిం,చి,న,ఆ,యు,ధం,లే,దు,.]";
  include 'slider16/index.php';
?>

<hr />

<script src="phrase_scripts.js"></script>
<!-- input form for phrase and filler values -->
<form action="javascript:" method="get" onsubmit="event.preventDefault(); gen(false)">
  <!-- phrase values, each character should be separated by commas -->
  <label for="phrase" id="phraseLabel">Phrase</label>


  <?php
  if(isset($_GET['id'])){
    $query = "SELECT * FROM quote_table WHERE id=".$_GET['id'];
  }else if($mode['value'] == 'FIRST'){
    $query = "SELECT * FROM quote_table WHERE id='1'";
  }else if($mode['value'] == 'LAST'){
    $query = "SELECT * FROM quote_table WHERE id=".$_lastID['id'];
  }else{
    $query = "SELECT * FROM quote_table WHERE id=".$randomID;
  }
  $db->set_charset("utf8");
  $data = mysqli_query($db, $query);
  $row = $data->fetch_assoc();
  $quote = $row["quote"];
  $arr = str_split_unicode($row["quote"]);
  $phrase = "";
  foreach ($arr as $ch) {
    if ($ch == " ") {
      continue;
    }
    if ($phrase == "") {
      $phrase = $ch;
    } else {
      $phrase = $phrase . "," . $ch;
    }
  }
  //$arr = implode(', ', $arr);
  echo '<input type="text" class="inputBox" name="phrase" id="phrase" value="' . $phrase . '"
        title="characters should be separated by commas, e.g.: a,bc, d"
        spellcheck="false" autocomplete="off" required>';

  ?>

  <br><br>

  <?php
  $myfile = fopen("fillers.txt", "r") or die("Unable to open file!");
  $filler = fread($myfile, filesize("fillers.txt"));
  fclose($myfile);



  echo '<label for="fillers" id="fillersLabel">Fillers</label>
        <textarea name="fillers" class="inputBox" id="fillers"
        title="characters should be separated by commas, e.g.: a,bc, d"
        spellcheck="false" autocomplete="off" required> ' . $filler . '</textarea>';


  ?>

  <br><br>


  <!-- Height dropdown selector, default value is 10 -->
  <label for="height">Grid Height:</label>
  <select name="height" id="height" autocomplete="off">

    <?php
    $sql = "SELECT VALUE FROM preferences WHERE  NAME = 'GRID_HEIGHT'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $height = $row["VALUE"];
    $arr = array("10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25");

    foreach ($arr as $val) {
      if ($val == $height) {
        echo '<option value="' . $val . '" selected>' . $val . '</option>';
      } else {
        echo '<option value="' . $val . '">' . $val . '</option>';
      }
    }
    ?>
  </select>
  <br><br>

  <!-- Width dropdown selector, default value is 10 -->
  <label for="width">Grid Width:</label>
  <select name="width" id="width" autocomplete="off">

    <?php
    $sql = "SELECT VALUE FROM preferences WHERE  NAME = 'GRID_WIDTH'";
    $result = $db->query($sql);
    $row = $result->fetch_assoc();
    $width = $row["VALUE"];
    $arr = array("10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25");
    foreach ($arr as $val) {
      if ($val == $width) {
        echo '<option value="' . $val . '" selected>' . $val . '</option>';
      } else {
        echo '<option value="' . $val . '">' . $val . '</option>';
      }
    }
    ?>

  </select>
  <br><br>

  <input type="submit" name="generate" id="generate" value="Generate" id="generate">
  <br><br>

  <!-- show grids on startup -->
  <script>
    gen(true);
  </script>

</form>

</body>

</html>
