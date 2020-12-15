<?php
session_start();
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";

$page_title = 'Preferences';
require 'db_credentials.php';
include("./nav.php");
?>

<style>
.container{
    position:center;
    text-align:left;
}
</style>

<div class="right-content">
    <div class="container">
        <h1>Quotes --> Preferences</h1>

<style>#title {text-align: center;color: darkgoldenrod;}</style>
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
<!-- ======================================
Here are the preferences we saved in $_SESSION in index dot php.
DEFAULT_COLUMN_COUNT, 
DEFAULT_LANGUAGE, 
DEFAULT_HOME_PAGE_DISPLAY,  
DEFAULT_CHUNK_SIZE, 
NO_OF_QUOTES_TO_DISPLAY, 
FEELING_LUCKY_MODE, 
FEELING_LUCKY_TYPE
Retrieve those and show the current values. 
======================================-->


				<form action="modifyThePreferences.php" method="POST" align=center>
					<table style="width:500px" class="container">
						<tr>
							<th style="width:200px"></th>
							<th>Current Value</th> 
							<th>Update Value</th>
						</tr>
						<tr>
							<td class="width:200px">Default Column Count:</td>
							<td><input disabled type="int" maxlength="2" size="10" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>" title="Current value"></td> 
							<td><input required type="int" name="app_rows" maxlength="2" size="10" title="Enter a number" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>"></td>
						</tr>
						<tr>
							<td class="width:200px">Default Lanugage:</td>
							<td><input disabled type="int" maxlength="2" size="10" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>" title="Current value"></td> 
							<td><input required type="int" name="app_show" maxlength="3" size="10" title="Enter a number" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>"></td>
						</tr>
                        <tr>
							<td class="width:200px">Default Home Page Display:</td>
							<td><input disabled type="int" maxlength="4" size="10" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>" title="Current value"></td> 
							<td><input required type="int" name="app_height" maxlength="4" size="10" title="Enter a number" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>"></td>
						</tr>
                        <tr>
							<td style="width:200px">Default Chunk Size:</td>
							<td><input disabled type="int" maxlength="4" size="10" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>" title="Current value"></td> 
							<td><input required type="int" name="app_width" maxlength="4" size="10" title="Enter a number" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>"></td>
						</tr>
                        <tr>
							<td style="width:200px">No. of Quotes to display::</td>
							<td><input disabled type="int" maxlength="2" size="10" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>" title="Current value"></td> 
							<td><input required type="int" name="puzzle_rows" maxlength="2" size="10" title="Enter a number" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>"></td>
						</tr>
						<tr>
							<td style="width:215px">Feeling Lucky Mode:</td>
							<td><input disabled type="int" maxlength="2" size="10" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>" title="Current value"></td> 
							<td><input required type="int" name="puzzle_show" maxlength="3" size="10" title="Enter a number" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>"></td>
						</tr>
                        <tr>
							<td style="width:200px">Feeling Lucky Type:</td>
							<td><input disabled type="int" maxlength="4" size="10" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>" title="Current value"></td> 
							<td><input required type="int" name="puzzle_height" maxlength="4" size="10" title="Enter a number" value="<?php echo $_SESSTION['DEFAULT_COLUMN_COUNT']; ?>"></td>
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
