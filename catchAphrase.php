<?php
include "./nav.php";
include "./telugu_parser.php";
require_once "./db_functions.php";

if (isset($_POST["phrase"])) {
	// get phrase from posted value
	$phrase = $_POST["phrase"];
} elseif (isset($_POST['ident'])) {
	// get phrase from database
	$phrase = get_quote($_POST['ident']);
} else {
	// use default phrase
	$phrase = "తెలుగు పజిల్స్";
}

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
		$height = get_preference('GRID_HEIGHT');
		if (is_null($height)) {
			// if no datbase preference for height exists, default value is 10
			$height = "10";
		}
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
		$width = get_preference('GRID_HEIGHT');
		if (is_null($width)) {
			// if no datbase preference for width exists, default value is 10
			$width = "10";
		}
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
	<br><br><br>

	<table id="game"></table>
	<br>
	<button type="button" id="toggleSolution" name="toggleSolution">Show Solution</button>
	<br><br>
	<table id="solution"></table>

	<!-- show grids on startup -->
	<script>
		gen();
		document.getElementById("toggleSolution").addEventListener("click", toggleSolution);
	</script>
</form>
<link type="text/css" media="all" href="phrase_style.css" rel="stylesheet">
<?php
include "./footer_no_query.php";
?>