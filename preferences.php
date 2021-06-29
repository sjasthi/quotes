<?php
session_start();
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";

$page_title = 'Preferences';
require 'db_credentials.php';
include("./nav.php");

// Here are the preferences we saved in $_SESSION in index dot php.
// DEFAULT_COLUMN_COUNT,
// DEFAULT_LANGUAGE,
// DEFAULT_HOME_PAGE_DISPLAY,
// DEFAULT_CHUNK_SIZE,
// NO_OF_QUOTES_TO_DISPLAY,
// FEELING_LUCKY_MODE,
// FEELING_LUCKY_TYPE,
// GRID_HEIGHT,
// GRID_WIDTH
// KEEP_PUNCTUATION_MARKS 
// Retrieve those and show the current values. 



$preferences = get_preferences();
$preference_array = array();
foreach ($preferences as $preference) {
	$preference_array[$preference['name']] = $preference['value'];
}

?>


<style>
	.container {
		position: center;
		text-align: left;
	}
</style>

<div class="right-content">
	<div class="container">

		<style>
			#title {
				text-align: center;
				color: darkgoldenrod;
			}
		</style>
		<html>

		<head>
			<title>Preferences</title>
			<style>
				input {
					text-align: center;
				}
			</style>
		</head>

		<body>
			<br>
			<h1 id="title">Update Preferences</h1><br>
		</body>
		<div class="container">
			<?php
			if (isset($_GET['preferencesUpdated'])) {
				if ($_GET["preferencesUpdated"] == "Success") {
					echo "<br><h3 align=center style='color:green'>Success! The Preferences have been updated!</h3>";
				}
			}
			?>

			<form action="modifyThePreferences.php" method="POST" align=center>
				<table style="width:500px" class="container">
					<tr>
						<th style="width:200px"></th>
						<th>Current Value</th>
						<th>Update Value</th>
					</tr>
					<tr>
						<td class="width:200px">Default Column Count:</td>
						<td><input disabled type="int" maxlength="2" size="15" value="<?php echo $preference_array['DEFAULT_COLUMN_COUNT']; ?>" title="Current value"></td>
						<td><input required type="int" name="column_count" maxlength="2" size="15" title="Enter the column count" value="<?php echo $preference_array['DEFAULT_COLUMN_COUNT']; ?>"></td>
					</tr>
					<tr>
						<td class="width:200px">Default Lanugage:</td>
						<td><input disabled type="text" maxlength="15" size="15" value="<?php echo $preference_array['DEFAULT_LANGUAGE']; ?>" title="Current value"></td>
						<td><input required type="text" name="language" maxlength="10" size="15" title="Enter the language (English, Telugu)" value="<?php echo $preference_array['DEFAULT_LANGUAGE']; ?>"></td>
					</tr>
					<tr>
						<td class="width:200px">Default Home Page Display:</td>
						<td><input disabled type="text" maxlength="4" size="15" value="<?php echo $preference_array['DEFAULT_HOME_PAGE_DISPLAY']; ?>" title="Current value"></td>
						<td><input required type="text" name="home_page_display" maxlength="10" size="15" title="Enter the display type for Home Page (Puzzles, Quote, Both)" value="<?php echo $preference_array['DEFAULT_HOME_PAGE_DISPLAY']; ?>"></td>
					</tr>
					<tr>
						<td style="width:200px">Default Chunk Size:</td>
						<td><input disabled type="int" maxlength="1" size="15" value="<?php echo $preference_array['DEFAULT_CHUNK_SIZE']; ?>" title="Current value"></td>
						<td><input required type="int" name="chunk_size" maxlength="1" size="15" title="Enter the chunk size for splitter" value="<?php echo $preference_array['DEFAULT_CHUNK_SIZE']; ?>"></td>
					</tr>
					<tr>
						<td style="width:200px">No. of Quotes to display::</td>
						<td><input disabled type="int" maxlength="3" size="15" value="<?php echo $preference_array['NO_OF_QUOTES_TO_DISPLAY']; ?>" title="Current value"></td>
						<td><input required type="int" name="no_of_quotes_to_display" maxlength="3" size="15" title="Enter the no. of quotes to display" value="<?php echo $preference_array['NO_OF_QUOTES_TO_DISPLAY']; ?>"></td>
					</tr>
					<tr>
						<td style="width:215px">Feeling Lucky Mode:</td>
						<td><input disabled type="text" maxlength="10" size="15" value="<?php echo $preference_array['FEELING_LUCKY_MODE']; ?>" title="Current value"></td>
						<td><input required type="text" name="feeling_lucky_mode" maxlength="10" size="15" title="Enter the ID selection (FIRST, LAST or RANDOM)" value="<?php echo $preference_array['FEELING_LUCKY_MODE']; ?>"></td>
					</tr>
					<tr>
						<td style="width:200px">Feeling Lucky Type:</td>
						<td><input disabled type="text" maxlength="10" size="15" value="<?php echo $preference_array['FEELING_LUCKY_TYPE']; ?>" title="Current value"></td>
						<td><input required type="text" name="feeling_lucky_type" maxlength="10" size="15" title="Enter the puzzle type (DropQuote, FloatQuote, DropFloat, Scrambler, Splitter, Slider16)" value="<?php echo $preference_array['FEELING_LUCKY_TYPE']; ?>"></td>
					</tr>
					<tr>
						<td style="width:200px">Grid Height:</td>
						<td><input disabled type="text" maxlength="10" size="15" value="<?php echo $preference_array['GRID_HEIGHT']; ?>" title="Current value"></td>
						<td><input required type="text" name="grid_height" maxlength="10" size="15" title="Enter the default grid height for Catch a Phrase" value="<?php echo $preference_array['GRID_HEIGHT']; ?>"></td>
					</tr>
					<tr>
					
						<td style="width:200px">Grid Width:</td>
						<td><input disabled type="text" maxlength="10" size="15" value="<?php echo $preference_array['GRID_WIDTH']; ?>" title="Current value"></td>
						<td><input required type="text" name="grid_width" maxlength="10" size="15" title="Enter the default grid width for Catch a Phrase" value="<?php echo $preference_array['GRID_WIDTH']; ?>"></td>
					</tr>
					<tr>
					
					<td style="width:200px">Keep Punctuation Marks:</td>
					<td><input disabled type="text" maxlength="10" size="15" value="<?php echo $preference_array['KEEP_PUNCTUATION_MARKS']; ?>" title="Current value"></td>
					<td><input required type="text"  maxlength="10" size="15" name="keep_punctuation_marks" title="Enter TRUE OR FALSE" value="<?php echo $preference_array['KEEP_PUNCTUATION_MARKS']; ?>"></td>
				</tr>
				
				<tr>
                    
                    <td style="width:200px">Square Color: </td>
                    <td><input disabled type="text" maxlength="10" size="15" value="<?php echo $preference_array['SQUARE_COLOR_PREFERENCE']; ?>" title="Current value"></td>
                    <td><input required type="text"  maxlength="10" size="15" name="square_color_preference" title="Enter Valid HTML Color for Squares " value="<?php echo $preference_array['SQUARE_COLOR_PREFERENCE']; ?>"></td>
                </tr>

                <tr>
                    
                    <td style="width:200px">Line Color: </td>
                    <td><input disabled type="text" maxlength="10" size="15" value="<?php echo $preference_array['LINE_COLOR_PREFERENCE']; ?>" title="Current value"></td>
                    <td><input required type="text"  maxlength="10" size="15" name="line_color_preference" title="Enter Valid HTML Color for Lines " value="<?php echo $preference_array['LINE_COLOR_PREFERENCE']; ?>"></td>
                </tr>

                <tr>
                    
                    <td style="width:200px">Fill Color: </td>
                    <td><input disabled type="text" maxlength="10" size="15" value="<?php echo $preference_array['FILL_COLOR_PREFERENCE']; ?>" title="Current value"></td>
                    <td><input required type="text"  maxlength="10" size="15" name="fill_color_preference" title="Enter Valid HTML Color for Fill " value="<?php echo $preference_array['FILL_COLOR_PREFERENCE']; ?>"></td>
                </tr>

                <tr>
                    
                    <td style="width:200px">Letter Color: </td>
                    <td><input disabled type="text" maxlength="10" size="15" value="<?php echo $preference_array['LETTER_COLOR_PREFERENCE']; ?>" title="Current value"></td>
                    <td><input required type="text"  maxlength="10" size="15" name="letter_color_preference" title="Enter Valid HTML Color for Letter " value="<?php echo $preference_array['LETTER_COLOR_PREFERENCE']; ?>"></td>
                </tr>
				
				</table>

				

				<br>
				<button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">UPDATE</button>
			</form>
		</div>
		</body>

		</html>

	</div>
</div>

<?php include("footer.php"); ?>
