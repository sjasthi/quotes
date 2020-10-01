

   <div id="wrapper">

    
    <button id="Classic_Mode_btn" class="btn-border" onclick="changeGameMode('Classic_Mode',this)">Classic Mode</button>
    <button id='Leap_Mode_btn' onclick="changeGameMode('Leap_Mode',this)">Leap Mode</button>

    <div id="content">
        <!-- #this is where you place the contents of your web page -->
        <table id="table">
        </table>
        <br>
        <br>
        <label>Quote<input type="text" name="quote" id="quote" value="<?php echo $quoteline; ?>"  style=" width: 200px;"></label>
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
</div>

