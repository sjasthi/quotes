
<div id="wrapper">
<button><a class="btn btn-sm" href="createQuote.php" data-abc="true">Create a Quote</a></button>
    <button id="Classic_Mode_btn" class="btn-border" onclick="changeGameMode('Classic_Mode',this)">Classic Mode</button>
    <button id='Leap_Mode_btn' onclick="changeGameMode('Leap_Mode',this)">Leap Mode</button>

    <div id="content">
        <!-- #this is where you place the contents of your web page -->
        <table id="table">
        </table>
        <br>
        <br>
        <label>Rows <input type="text" name="rows" id="rows" value="4" size="2"></label>
        <label>Columns <input type="text" name="columns" id="columns" value="4" size="2"></label>
        <input type="button" id="newGame" value="Start New Game">
        <br>
        <br>
        Number Of Moves: <span id="moves">0</span>
        <br>
        <div id="output"></div>
        <button id="submit-game" onclick="checkStats()">Submit</button>
        

    </div>

    

 <?php
  /*
 $sql = "SELECT * FROM quote_table ORDER BY RAND ( )  
LIMIT 6";
$retval=mysqli_query($db, $sql);

if(mysqli_num_rows($retval) > 0){
    while($row = mysqli_fetch_assoc($retval)){
        echo'<div id="story_div"><button class="story" onclick="story(this)">'.$row['quote'].'</button></div><br>';
    }
}
*/
?>

 <?php
 $sql = "SELECT * FROM quote_table ORDER BY RAND ( ) ";
$retval=mysqli_query($db, $sql);
if(mysqli_num_rows($retval) > 0){
echo '<select class="select-quote" id="story_div">';
    while($row = mysqli_fetch_assoc($retval)){
        echo'<option class="story" value="'.$row['quote'].'" >'.$row['quote'].'</option>';
    }
echo '</select>';
}
?>


</div>
<br>
        <br>
 
</body>
</html>