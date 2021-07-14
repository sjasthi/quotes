<?php
  $nav_selected = "LIST";
  $left_buttons = "NO";
  $left_selected = "";

  include('batch-helper.php');
  include('nav.php');
  include('puzzlemaker.php');
 // include('grabzit/lib/GrabzItClient.php');
 // include('grabzit/lib/GrabzItPDFOptions.php');
  include_once 'db_credentials.php';
?>

<script type="text/javascript" src="js/main.js"></script>
<script type="text/javascript" src="js/html2canvas.js"></script>
<script type="text/javascript" src="batch-service.js"></script>
<script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
<style>

.puzzleHeader{
  background-color: rgb(55,95,145);
  color: white;
  height: 55px;
  padding-top: 10px;
}
</style>

<link rel="stylesheet" href="batch.css">
<div id="wrap">
    <div id="colorScheme">
    
   <input type="button" id="cs1" value="PowerPoint Generate" onclick="setScheme(this)"></input>


    </div>

<?php
  $removeForm = false;
  if(isset($_POST['remove'])){
    $removeForm = true;
  }

  if($removeForm == true){
    echo '<div onload="createDropdownOption()" class="container" style="display:none">';
  }else{
    echo '<div onload="createDropdownOption()" class="container">';
  }
?>
  <h1>Batch</h1>
  <form method="post">
    <select class="dropContainer" id="dropContainer" name="selectedPuzzle" style="padding-left:19px">
      <option value ="">Select puzzle type</option>
    </select>
    <select name="printType" class="dropContainer">
      <option value="A">A</option>
      <option value="B">B</option>
      <option value="C">C</option>
    </select>
    <br>
    <label>START</label>
    <input name="startID" type="textarea" placeholder="Enter quote id" id="start" style="border-radius:4px;
    margin-right:23px;margin-top:3px" onkeypress="return isNumberKey(event)">
    <br>
    <label>END</label>
    <!-- Input fields only accepts numerical characters -->
    <input name="endID" type="textarea" placeholder="Enter quote id" id="end" style="border-radius:4px;"
     onkeypress="return isNumberKey(event)"><br>

    <input name="remove" style="visibility: hidden"><br>
    <input type="submit" value="Generate">
  </form>
</div>

<div id="PuzzleContainer">
  <?php
  if((isset($_POST['startID'])) && (isset($_POST['endID']))){
    if($_POST['startID'] !== '' && $_POST['endID'] !== ''){
      if(validResponse($_POST['selectedPuzzle'], $_POST['startID'], $_POST['endID']) == '1'){
        $flagged = true;
        $db->set_charset("utf8");

        echo '<button class="genButton" onclick="generatePDF()">Export to PDF</button>';

        $modeType = "SELECT * FROM preferences WHERE name = 'FEELING_LUCKY_MODE'";
        $modeResult = mysqli_query($db, $modeType);
        $mode = mysqli_fetch_array($modeResult);

        $columnCountSQL = "SELECT * from preferences WHERE name = 'DEFAULT_COLUMN_COUNT'";
        $columnResult = mysqli_query($db, $columnCountSQL);
        $columnCount = mysqli_fetch_array($columnResult);

        $chunkSizeSQL = "SELECT * FROM preferences WHERE name = 'DEFAULT_CHUNK_SIZE'";
        $cSizeResult = mysqli_query($db, $chunkSizeSQL);
        $chunkSize = mysqli_fetch_array($cSizeResult);

        $punctuationSQL = "SELECT * FROM preferences WHERE name = 'KEEP_PUNCTUATION_MARKS'";
        $punctResult = mysqli_query($db, $punctuationSQL);
        $punctuation = mysqli_fetch_array($punctResult);

        $gridHeightSQL = "SELECT * FROM preferences WHERE name = 'GRID_HEIGHT'";
        $heightResult = mysqli_query($db, $gridHeightSQL);
        $height = mysqli_fetch_array($heightResult);

        $gridWidthSQL = "SELECT * FROM preferences WHERE name = 'GRID_WIDTH'";
        $widthResult = mysqli_query($db, $gridWidthSQL);
        $width = mysqli_fetch_array($widthResult);

        $count = 0;
        for ($i = parseInt( $_POST['startID'] ); $i <= parseInt( $_POST['endID'] ); $i++ ){
          //Begin generating puzzles
          $quoteSQL = "SELECT * FROM quote_table WHERE id = ".$i;
          $quoteResult = mysqli_query($db, $quoteSQL);
          $count++;
          if($quoteResult->num_rows > 0){
            $quoteline = mysqli_fetch_array($quoteResult);
            $quote = $quoteline['quote'];

            if($punctuation['value'] == 'FALSE'){
              $regex = '/[^a-z\s]/i';
              $quote = preg_replace($regex, '', $quote);
            }

            switch($_POST['selectedPuzzle']){
              case 'Drop':
                echo '<h2 class="puzzleHeader" id="title">Drop Puzzle: '.$count.'</h2><br>';
                DropPrint($quote, $columnCount['value']);
                break;
              case 'Float':
                echo '<h2 class="puzzleHeader" id="title">Float Puzzle: '.$count.'</h2><br>';
                error_reporting(1);
                FloatPrint($quote, $columnCount['value']);
                break;
              case 'Drop-Float':
                error_reporting(0);
                echo'<h2 class="puzzleHeader">Drop-Float: '.$count.'</h2>';

                if($mode != null){
                  $quoteline2 = '';
                  $invalid = true;

                  if($mode['value'] == "FIRST"){
                    $index = 2;
                    while($invalid){
                      $sql = "SELECT * FROM quote_table WHERE id = ".$index;
                      $result = mysqli_query($db, $sql);
                      $candidate = mysqli_fetch_array($result);
                      if($candidate->num_rows > 0){
                        $quoteline2 = $candidate['quote'];
                        if($quoteline2 != ''){
                          $invalid = false;
                        }
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
                  FloatDropPrint($quote, $quoteline2, $columnCount['value']);
                }
                break;
              case 'Scramble':
                echo '<h2 class="puzzleHeader" id="title">Scramble Puzzle: '.$count.'</h2><br>';
                ScramblePrint($quote);
                break;
              case 'Split':
                echo '<h2 class="puzzleHeader" id="title">Split Puzzle: '.$count.'</h2><br>';
                SplitPrint($quote, $chunkSize['value']);
                break;
              case 'Slider-16':
                echo'<h2 id="title">Slider 16</h2><br ';
                slider16Print($quote, $width["value"], $height["value"]);

                break;
              case 'Catch-A-Phrase':
                echo'<h2>Catch a Phrase</h2>';
                $nav_selected = "ADMIN";
                $left_buttons = false;
                $phrase;

                if (isset($_POST["phrase"])) {
                	// get phrase from posted value
                	$phrase = $_POST["phrase"];
                }else {
                	// use default phrase
                	$phrase = $quote;
                }

                $language = "Telugu";

                // parse quote into characters separated by commas
                $arr = parseToCodePoints($phrase);
                $processed_phrase = "";
                foreach ($arr as $ch) {
                	$ch = parseToCharacter($ch);
                	if ($ch == " " || ctype_punct($ch) || $ch == "") {
                		// skip over spaces, blanks, and punctuation
                		continue;
                	}
                	if ($processed_phrase == "") {
                		$processed_phrase = $ch;
                	} else {
                		$processed_phrase = $processed_phrase . "," . $ch;
                	}
                }

                // get filler values
                $myfile = fopen("fillers.txt", "r") or die("Unable to open file!");
                $filler = fread($myfile, filesize("fillers.txt"));
                fclose($myfile);
                ?>
                <script src="phrase_scripts.js"></script>

                <!-- input form for phrase and filler values -->
                <form id="catch_a_phrase_form" method="post">
                	<!-- phrase -->
                	<label for="phrase" id="phraseLabel">Phrase</label>
                	<input type="text" class="inputBox" name="phrase" id="phrase" value="<?php echo $phrase; ?>"
                		title="type in your phrase here"
                		spellcheck="false" autocomplete="off" required>
                	<br><br>

                	<!-- phrase values, each character should be separated by commas -->
                	<label for="processedPhrase" id="processedPhraseLabel">Processed<br>Phrase</label>
                	<input type="text" class="inputBox" name="processedPhrase" id="processedPhrase" value="<?php echo $processed_phrase; ?>"
                		title="characters should be separated by commas, e.g.: a,b,c,d"
                		spellcheck="false" autocomplete="off" required>
                	<br><br>

                  	<label for="fillers" id="fillersLabel">Fillers</label>
                  	<textarea name="fillers" class="inputBox" id="fillers" title="characters should be separated by commas, e.g.: a,bc, d"
                  	spellcheck="false" autocomplete="off" required><?php echo $filler; ?></textarea>
                  	<br><br>

                  	<!-- Height dropdown selector, default value retrieved from database -->
                  	<label for="height">Grid Height:</label>
                  	<select name="height" id="height" autocomplete="off">
                  		<?php
                  		if (isset($_POST['height'])) {
                  			$height = $_POST['height'];
                  		} else {
                  			$height = get_preference('GRID_HEIGHT');
                  			if (is_null($height)) {
                  				// if no datbase preference for height exists, default value is 12
                  				$height = "12";
                  			}
                  		}
                  		for ($i = 10; $i <= 25; $i++) {
                              echo '<option value="' . $i . '"' . (($i == $height) ? ' selected' : '' ) .'>' . $i . '</option>';
                          }
                  		?>
                  	</select>
                  	<br><br>

                  	<!-- Width dropdown selector, default value is 10 -->
                  	<label for="width">Grid Width:</label>
                  	<select name="width" id="width" autocomplete="off">
                  		<?php
                  		if (isset($_POST['width'])) {
                  			$width = $_POST['width'];
                  		} else {
                  			$width = get_preference('GRID_WIDTH');
                  			if (is_null($width)) {
                  				// if no datbase preference for width exists, default value is 16
                  				$width = "16";
                  			}
                  		}
                  		for ($i = 10; $i <= 25; $i++) {
                              echo '<option value="' . $i . '"' . (($i == $width) ? ' selected' : '' ) .'>' . $i . '</option>';
                          }
                  		?>
                  	</select>
                  	<br><br>

                  	<label for="show_solution">Hide Solution on Generate:</label>
                  	<input type="checkbox" id='hide_solution' name="hide_solution" value="true" <?php if (isset($_POST['hide_solution']) && $_POST['hide_solution'] == 'true') echo "checked"; ?>>
                  	<br><br>


                	<input type="submit" name="generate" id="generate" value="Generate" id="generate">
                	<br><br><br>

                	<table id="game"></table>
                	<br>
                	<table id="solution"></table>
                	<br>
                	<button type="button" id="toggleSolution" name="toggleSolution">Show Solution</button>

                	<!-- show grids on startup -->
                	<script>
                		gen(<?php echo ((isset($_POST['hide_solution']) && $_POST['hide_solution'] == 'true') ? "true" : "false"); ?>);
                		document.getElementById("toggleSolution").addEventListener("click", function() { toggleSolution(false); });
                	
                  function createPowerpoint (src) {
                    try {

                    }

                    catch (e) {

                    }
                  }
                  </script>
                </form>
                <link type="text/css" media="all" href="phrase_style.css" rel="stylesheet">
                <?php
                break;
          }
        }
      }//end of for loop
      ?>
      </div>
      <?php
    }
  }
}
  ?>