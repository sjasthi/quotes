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
  .backButton{
    border-radius: 10px;
    background-color: rgb(13,70,155);
  }
</style>

<link type="text/css" media="all" href="phrase_style.css" rel="stylesheet" />
<script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<button class="backButton"><a class="btn btn-sm" href="index.php" style="color:white;">Return</a></button>

<?php

  $flagged = true;
  $db->set_charset("utf8");

  $mode;
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
      $randomID = mt_rand(1,$lastID['id']);
      $sql = "SELECT * FROM quote_table where id = ".$randomID;
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

  //Retrieve the puzzle preferences to determine what type of puzzle to Generate
  //as well as how to generate it
  $puzzleTypeSQL = 'SELECT * FROM preferences WHERE name = "FEELING_LUCKY_TYPE"';
  $pTypeResult = mysqli_query($db,$puzzleTypeSQL);
  $puzzleType = mysqli_fetch_array($pTypeResult);

  $columnCountSQL = "SELECT * FROM preferences WHERE name = 'DEFAULT_COLUMN_COUNT'";
  $cCountResult = mysqli_query($db, $columnCountSQL);
  $columnCount = mysqli_fetch_array($cCountResult) ;

  $chunkSizeSQL = "SELECT * FROM preferences WHERE name = 'DEFAULT_CHUNK_SIZE'";
  $cSizeResult = mysqli_query($db, $chunkSizeSQL);
  $chunkSize = mysqli_fetch_array($cSizeResult);

  $punctuationSQL = "SELECT * FROM preferences WHERE name = 'KEEP_PUNCTUATION_MARKS'";
  $punctResult = mysqli_query($db, $punctuationSQL);
  $punctuation = mysqli_fetch_array($punctResult);

  if (!$result = $db->query($sql)) {
    die('There was an error running query[' . $connection->error . ']');
  }

  if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $quoteline = $row["quote"];
  }

  if(isset($quoteline)){
    if($punctuation['value'] == 'FALSE'){
      $regex = '/[^a-z\s]/i';
      $quoteline = preg_replace($regex, '', $quoteline);
    }
  }

  switch($puzzleType['value']){

    case 'DROPQUOTE':
      echo '<h2 id="title">Drop Quote</h2><br>';
      DropMaker($quoteline, $columnCount['value']);
        break;

    case 'FLOATQUOTE':
      echo '<h2 id="title">Float Quote</h2><br>';
      error_reporting(1);
      FloatMaker($quoteline, $columnCount['value']);
        break;

    case 'SCRAMBLE':
      echo '<h2 id="title">Scramble Quote</h2><br>';

      $words  = ScrambleMaker($quoteline);
      $arrWord =  str_split_unicode($words);

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
      <?php
          break;

      case 'SPLIT':
        echo '<h2 id="title">Split Quote</h2><br>';
        SplitMaker($quoteline, $chunkSize['value']);
          break;

      case 'SLIDER16':
        echo'<h2 id="title">Slider 16</h2><br ';
        ?>
        <link rel="stylesheet" href="css/cjui.css">
        <script src="jquery/jquery.js"></script>
        <script src="jquery/jui.js"></script>
        <link rel="stylesheet" href="stylesjs.css">
        <script type="text/javascript" src="script_16.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
      <?php
        $arr = parseToCodePoints($quoteline);
        $quote_arr = array();
        foreach ($arr as $ch) {
          $ch = parseToCharacter($ch);
          if ($ch == " ") {
            continue;
          }
          array_push($quote_arr, $ch);
        }
        include 'slider16/index.php';
          break;

        case 'DROPFLOAT':
          error_reporting(0);
          echo'<h2>Drop Float</h2>';

          if($mode != null){
            $quoteline2 = '';
            $invalid = true;

            if($mode['value'] == "FIRST"){
              $index = 2;
              while($invalid){
                $sql = "SELECT * FROM quote_table WHERE id = ".$index;
                $result = mysqli_query($db, $sql);
                $candidate = mysqli_fetch_array($result);
                $quoteline2 = $candidate['quote'];
                if($quoteline2 != ''){
                  $invalid = false;
                }
                $index++;
              }
            } else{
                $length = "SELECT * FROM quote_table order by id DESC limit 1";
                $result = mysqli_query($db,$length);
                $lastID = mysqli_fetch_array($result);

                if($mode['value'] == "LAST"){
                  $index = $lastID['id'] - 1;
                  while($invalid){
                    $sql = "SELECT * FROM quote_table WHERE id = ".$index;
                    $result = mysqli_query($db, $sql);
                    $candidate = mysqli_fetch_array($result);
                    $quoteline2 = $candidate['quote'];
                    if($quoteline2 != ''){
                      $invalid = false;
                    }
                    $index--;
                  }
                } else if($mode['value'] == "RANDOM"){
                  $index = mt_rand(1,$lastID['id']);
                  while($invalid){
                    $sql = "SELECT * FROM quote_table WHERE id = ".$index;
                    $result = mysqli_query($db, $sql);
                    $candidate = mysqli_fetch_array($result);
                    $quoteline2 = $candidate['quote'];
                    if($quoteline2 != ''){
                      $invalid = false;
                    }
                    $index = mt_rand(1,$lastID['id']);
                  }
                }
            }

            if($punctuation['value'] == 'FALSE'){
              $regex = '/[^a-z\s]/i';
              $quoteline2 = preg_replace($regex, '', $quoteline2);
            }

            FloatDropMaker($quoteline, $quoteline2, $columnCount['value']);
          }
          break;

        case 'CATCH':
          echo'<h2>Catch a Phrase</h2>';
          ?>
          <script src="phrase_scripts.js"></script>
          <!-- input form for phrase and filler values -->
          <form action="javascript:" method="get" onsubmit="event.preventDefault(); gen(false)">
            <!-- phrase values, each character should be separated by commas -->
            <label for="phrase" id="phraseLabel">Phrase</label>

            <?php
            $arr = str_split_unicode($quoteline);
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
            <?php
          break;
        }
        ?>
        <br><br>
      </div>

    </body>
</html>
