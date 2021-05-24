<?php
$nav_selected = "ADMIN";
$left_buttons = false;
include "./nav.php";
//include "./telugu_parser.php";
include 'indic-wp.php';

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

$language = "Telugu";
$wordProcessor = new WordProcessor($phrase, $language);

// parse quote into characters separated by commas
$arr = $wordProcessor->parseToCodePoints($phrase);
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
	</script>
</form>
<link type="text/css" media="all" href="phrase_style.css" rel="stylesheet">
<?php
include "./footer_no_query.php";
?>