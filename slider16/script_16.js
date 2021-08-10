var moves = 0;
var currTime = 0;
var currMoveCount = 0;
var table;
var rows;
var columns;
var textMoves;
var arrayForBoard;
var error = false;
var timer = null;

function start() {
    var button = document.getElementById("newGame");
    button.addEventListener("click", startNewGame, false);
    textMoves = document.getElementById("moves");
    table = document.getElementById("table");
    rows = 4;
    columns = 4;
    startNewGame();

}

function startNewGame() {

    var arrayOfNumbers = new Array();
    var arrayHasNumberBeenUsed;
    var randomNumber = 0;
    var count = 0;
    currTime = 0;
    moves = 0;

    rows = document.getElementById("rows").value;
    columns = document.getElementById("columns").value;
    textMoves.innerHTML = moves;
    clearTimeout(timer);
    timer = setInterval(showGameStats, 1000);
    document.querySelector("#output").className = "timer";
    // Create the sider Strings size.
    arrayForBoard = new Array(rows);

    if (rows >= 8) {
        error = true;
    } else if (columns >= 8) {
        error = true
    }

    if (!error) {
        for (var i = 0; i < rows; i++) {
            arrayForBoard[i] = new Array(columns);
        }
        // allocating unique numbers.
        arrayHasNumberBeenUsed = new Array(rows * columns);
        for (var i = 0; i < rows * columns; i++) {
            arrayHasNumberBeenUsed[i] = 0;
        }

        // Assign random numbers to the board.
        for (var i = 0; i < rows * columns; i++) {
            randomNumber = Math.floor(Math.random() * rows * columns);
            // If our random numer is unique, add it to the board.
            if (arrayHasNumberBeenUsed[randomNumber] == 0) {
                arrayHasNumberBeenUsed[randomNumber] = 1;
                arrayOfNumbers.push(randomNumber);
            }
            else // Our number is not unique. Try again.
            {
                i--;
            }
        }

        // Assign numbers to the game board.
        count = 0;
        for (var i = 0; i < rows; i++) {
            for (var j = 0; j < columns; j++) {
                arrayForBoard[i][j] = arrayOfNumbers[count];

                count++;
            }
        }
        showTable();
    } else {

        alert('row or colums should less then 7');
    }
}
var data_arr = ['ZI', 'ND', 'AG', 'IN', 'IK', 'AL', 'JA', 'TI', 'HA', 'IA', 'UR',
    'HU', 'MS', 'AB', 'PY', 'AR', 'KE', 'BI', 'NA', 'JE', 'EN', 'AS', 'EE', 'KH'
    , 'LE', 'TE', 'HA', 'IN', 'KO', 'UN', 'PY', 'AR', 'KO', 'MA', 'UK'];


function showTable() {
    console.table(arrayForBoard);
    var k = 0;
    error1 = false;
    var string = document.getElementById("quote").value;
    var string1 = document.getElementById("quote_arr").value;
    var string1_arr = JSON.parse(string1);

    var rows = document.getElementById("rows").value;
    var columns = document.getElementById("columns").value;
    var calculate_number_of_tiles = rows * columns - 1;
    var rem_space = string.split(" ").join("");
    //var splite_str = string.split("");
    //var splite_str = rem_space.split("");
    splite_str = string1_arr;
    console.log(splite_str);
    //var character_length = string.split(" ").join("").length;
    var character_length = splite_str.length;
    var loop_count = 1;
    var string_count_per_tiels = 0;
    var remainder = character_length % calculate_number_of_tiles;
    splite_str.forEach(function (item) {
        if (loop_count > calculate_number_of_tiles) {
            string_count_per_tiels++;
            loop_count = 1;
        }
        loop_count++;
    });
    if (loop_count > calculate_number_of_tiles) {
        string_count_per_tiels++;
        loop_count = 1;
    }
    console.log(string_count_per_tiels);
    var check_nub = calculate_number_of_tiles - remainder;
    console.log(check_nub);
    var arr = [];
    var concate_data = '';
    var index = 1;
    var index_for_tiles = 1;
    var loop_cuount_for_arr = 1;
    splite_str.forEach(function (item) {
        if (check_nub >= index_for_tiles) {
            concate_data = concate_data + item;
            index++;
            if (string_count_per_tiels < index) {
                arr.push(concate_data);
                concate_data = '';
                index = 1;
                index_for_tiles++;
            }
        } else {
            concate_data = concate_data + item;
            index++;
            if (string_count_per_tiels + 1 < index) {
                arr.push(concate_data);
                concate_data = '';
                index = 1;
                index_for_tiles++;
            }
        }
    });
    if (character_length < calculate_number_of_tiles) {
        alert('Selected quote too short');
        error1 = true;
    }
    if (!error1) {
        /*var splite = rem_space.split("");
        var concate_data = '';
        var prepare_data =[];
        var status = 1;*/

        /*splite.forEach(function (item) {
           var  k = k+1;
           if (character_length == 15) {
                   concate_data = concate_data+item;
                   prepare_data.push(concate_data);
                   status = 1;
                   concate_data = '';
   
           }else if (character_length > 15  && character_length < 70) {
               if (status==1) {
                   concate_data = concate_data+item;
                   status = 2;
               }else if (status ==2) {
                   concate_data = concate_data+item;
                   prepare_data.push(concate_data);
                   status = 1;
                   concate_data = '';
               }
           } else{
               if (status==1) {
                   concate_data = concate_data+item;
                   status = 2;
               }else if (status ==2) {
                   concate_data = concate_data+item;
                   status = 3;
               }else if (status ==3) {
                   concate_data = concate_data+item;
                   prepare_data.push(concate_data);
                   status = 1;
                   concate_data = '';
               }
           }
       });*/
        console.log(arr);
        var array_first = [];
        var array_second = [];
        var all_index = 1;
        arr.forEach(function (item) {
            if (all_index % 2) {
                array_second.push(item);
            } else {
                array_first.push(item);
            }
            all_index++;
        });
        var prepare_data = array_first.concat(array_second);;
        var index = 0;
        var outputString = "";
        console.log(prepare_data);
        for (var i = 0; i < rows; i++) {
            outputString += "<tr id='Classic_Mode' class='table_row'>";
            for (var j = 0; j < columns; j++) {
                if (prepare_data.length > 0) {
                    var data = prepare_data[index];
                } else {
                    var data = data_arr[index];
                }
                if (data === undefined) {
                    data = null;
                    var stylediv = 'style=\"background: black;\"';
                }
                if (arrayForBoard[i][j] == 0) {
                    outputString += "<td  class=\"blank\" onclick='moveThisTile(" + i + "," + j + ",this)'> </td>";
                } else {
                    outputString += "<td class=\"tile\" " + stylediv + " onclick=\"moveThisTile(" + i + ", " + j + ",this)\">" + data + "</td>";
                    index++;
                }

            }
            outputString += "</tr>";
        }

        table.innerHTML = outputString;

    }
}

function moveThisTile(tableRow, tableColumn, that) {
    var id = that.parentNode.id;
    if (id == 'Classic_Mode') {
        if (checkIfMoveable(tableRow, tableColumn, "up") ||
            checkIfMoveable(tableRow, tableColumn, "down") ||
            checkIfMoveable(tableRow, tableColumn, "left") ||
            checkIfMoveable(tableRow, tableColumn, "right")) {
            incrementMoves();
        }
        else {
            alert("ERROR: Cannot move tile!\nTile must be next to a blank space.");
        }

    } else if (id == 'Leap_Mode') {
        var blank = document.getElementsByClassName("blank")[0];
        var click_value = that.textContent;
        that.innerHTML = "";
        that.classList.add("blank");
        that.classList.remove("tile");
        blank.innerHTML = click_value;
        blank.classList.add("tile");
        blank.classList.remove("blank");
    }

}

function checkIfMoveable(rowCoordinate, columnCoordinate, direction) {
    rowOffset = 0;
    columnOffset = 0;
    if (direction == "up") {
        rowOffset = -1;
    }
    else if (direction == "down") {
        rowOffset = 1;
    }
    else if (direction == "left") {
        columnOffset = -1;
    }
    else if (direction == "right") {
        columnOffset = 1;
    }

    // If it can, move it and return true.
    if (rowCoordinate + rowOffset >= 0 && columnCoordinate + columnOffset >= 0 &&
        rowCoordinate + rowOffset < rows && columnCoordinate + columnOffset < columns
    ) {
        if (arrayForBoard[rowCoordinate + rowOffset][columnCoordinate + columnOffset] == 0) {
            arrayForBoard[rowCoordinate + rowOffset][columnCoordinate + columnOffset] = arrayForBoard[rowCoordinate][columnCoordinate];
            arrayForBoard[rowCoordinate][columnCoordinate] = 0;
            showTable();
            return true;
        }
    }
    return false;
}

function checkIfWinner() {
    var count = 1;
    for (var i = 0; i < rows; i++) {
        for (var j = 0; j < columns; j++) {
            if (arrayForBoard[i][j] != count) {
                if (!(count === rows * columns && arrayForBoard[i][j] === 0)) {
                    return false;
                }
            }
            count++;
        }
    }

    return true;
}

function incrementMoves() {
    moves++;
    if (textMoves) {
        textMoves.innerHTML = moves;
    }
}

function showGameStats() {
    var output = document.querySelector("#output");
    currTime++;
    var minutes = Math.floor(currTime / 60);
    var seconds = currTime % 60;
    output.innerHTML = "Time: " + minutes + ":" + seconds + "";
}
function changeGameMode(data, that) {
    var class_name = document.getElementsByClassName('table_row');
    class_name[0].setAttribute('id', data);
    class_name[1].setAttribute('id', data);
    class_name[2].setAttribute('id', data);
    if (class_name[3]) {
        class_name[3].setAttribute('id', data);
    }
    var Classic_Mode_btn = document.getElementById('Classic_Mode_btn');
    var Leap_Mode_btn = document.getElementById('Leap_Mode_btn');
    Classic_Mode_btn.classList.remove("btn-border");
    Leap_Mode_btn.classList.remove("btn-border");
    that.classList.add("btn-border");
}

function checkStats() {
    if (checkIfWinner()) {
        alert("Congratulation! You solved the puzzle in " + moves + " moves.");
        startNewGame();
    }
    else {
        alert('Try again');
        startNewGame();
    }
}

window.addEventListener("load", start, false);