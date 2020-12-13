<?php
include("./nav.php");
include("./telugu_parser.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>
		Catch a Phrase (Snake)
	</title>
	<link type="text/css" media="all" href="phrase_style.css" rel="stylesheet" />
	<script src="phrase_scripts.js"></script>
</head>

<body>
	<!-- input form for phrase and filler values -->
	<form action="javascript:" method="get" onsubmit="event.preventDefault(); gen(false)">
		<!-- phrase values, each character should be separated by commas -->
		<label for="phrase" id="phraseLabel">Phrase</label>
		<?php
		$query = "SELECT * FROM quote_table where id=" . $_POST['ident'];
		$db->set_charset("utf8");
		$data = mysqli_query($db, $query);
		$row = $data->fetch_assoc();
		$quote = $row["quote"];
		//$arr = str_split_unicode($row["quote"]);
		$arr = parseToCodePoints($quote);
		$phrase = "";
		foreach ($arr as $ch) {
			$ch = parseToCharacter($ch);
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

		function str_split_unicode($str, $l = 0)
		{
			if ($l > 0) {
				$ret = array();
				$len = mb_strlen($str, "UTF-8");
				for ($i = 0; $i < $len; $i += $l) {
					$ret[] = mb_substr($str, $i, $l, "UTF-8");
				}
				return $ret;
			}
			return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
		}
		?>

		<br><br>


		<!-- Height dropdown selector, default value is 10 -->
		<label for="height">Grid Height:</label>
		<select name="height" id="height" autocomplete="off">

			<?php
			$sql = "SELECT VALUE FROM pref WHERE  NAME = 'GRID_HEIGHT'";
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
			$sql = "SELECT VALUE FROM pref WHERE  NAME = 'GRID_WIDTH'";
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