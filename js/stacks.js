console.log(letterList);

//function for testing contents of arrays after moving characters
function printArrays() {
    console.log("pyramid puzzle");
    console.log(pyramidPuzzleArray);
    console.log("step up puzzle");
    console.log(stepUpPuzzleArray);
    console.log("step down puzzle");
    console.log(stepDownPuzzleArray);
    console.log("letter list");
    console.log(letterList);
    console.log("attempt");
    console.log(attempt);
}

var attempt = new Array(wordList.length);
for(var i = 0; i < wordList.length; i++) {
    attempt[i] = new Array(wordList[i].length);
    for(var j = 0; j < wordList[i].length; j++) {
        attempt[i][j] = '';
    }
}

console.log("puzzles");

const puzzles = document.getElementsByClassName('puzzleLetter');

console.log(puzzles.length);

for(var i =0; i < puzzles.length; i++) {
    console.log(puzzles[i].innerHTML);
}

console.log("guesses");

const guesses = document.getElementsByClassName('guess');

console.log(guesses.length);

for(var i =0; i < guesses.length; i++) {
    console.log(guesses[i].innerHTML);
}

for(var i = 0; i < guesses.length; i++) {
    guesses[i].addEventListener('dragover', dragOver);
    guesses[i].addEventListener('drop', dragDrop);
    guesses[i].addEventListener('dragstart', dragStart);
}

for(var i = 0; i < puzzles.length; i++) {
    puzzles[i].addEventListener('dragover', dragOver);
    puzzles[i].addEventListener('drop', dragDrop);
    puzzles[i].addEventListener('dragstart', dragStart);
}

var tdDragStart;
var tdDragDrop;

function dragStart(ev) {
    ev.dataTransfer.setData("text", ev.target.innerHTML);
    //console.log(ev.dataTransfer.getData("text"));
    tdDragStart = ev.target;
}

function dragEnter(ev) {
    ev.preventDefault();
}

function dragLeave(ev) {
    ev.preventDefault();
}

function dragDrop(ev) {
    ev.preventDefault();
    //console.log(ev.dataTransfer.getData("text"));
    var target = ev.target;
    var setHTML = ev.dataTransfer.getData("text");
    var placeholder = target.innerHTML;
    target.innerHTML = setHTML;
    tdDragStart.innerHTML = placeholder;
    // console.log('letters puzzle type');
    // console.log(lettersPuzzleType);
    // console.log('words puzzle type');
    // console.log(puzzleType);
    printArrays();
    updateArrays(setHTML, placeholder, ev.target);
    sendArrays();
}

function dragOver(ev) {
    ev.preventDefault();
}

function updateArrays(setHTML, placeholder, target) {
    var update = new Array(2);
    
    if(target.getAttribute('class').includes('puzzleLetter')) {
        if(tdDragStart.getAttribute('class').includes('guess')) {
            if(puzzleType == "pyramid") {
                update = pyramidDetermineIndex(tdDragStart);
                // updatePyramidArrayIndex(row, column, placeholder);
                // updatestepUpArrayIndex(row, (wordList[row].length + column - 1), placeholder);
                // updatestepDownArrayIndex(row, column, placeholder);
                updateAttemptIndex(update[0], update[1], placeholder);
            } else {
                update = genericDetermineIndex(tdDragStart);
                if (puzzleType == "stepdown") {
                    // updatePyramidArrayIndex(row, column, placeholder);
                    // updatestepUpArrayIndex(row, (wordList[row].length + column - 1), placeholder);
                    // updatestepDownArrayIndex(row, column, placeholder);
                    updateAttemptIndex(update[0], update[1], placeholder);
                } else if (puzzleType == "stepup") {
                    // updatePyramidArrayIndex(row, column - (pyramidArray[row].length - wordList[row].length), placeholder);
                    // updateStepUpArrayIndex(row, column, letter);
                    // updatestepDownArrayIndex(row, column - (stepDownArray[row].length - wordList[row].length), placeholder);
                    updateAttemptIndex(update[0], update[1] - (stepDownArray[update[0]].length - wordList[update[0]].length), placeholder);
                }
            }
        } else if (tdDragStart.getAttribute('class').includes('puzzleLetter')) {
            if(lettersPuzzleType == "pyramid") {
                update = pyramidDetermineIndex(tdDragStart);
                updatePyramidPuzzleArrayIndex(update[0], update[1], placeholder);
                updateStepUpPuzzleArrayIndex(update[0], update[1] + (stepDownArray[update[0]].length - wordList[update[0]].length), placeholder);
                updateStepDownPuzzleArrayIndex(update[0], update[1], placeholder);
                updateLetterListIndexFromLetters(update[0], update[1], placeholder);
            } else {
                update = genericDetermineIndex(tdDragStart);
                if(lettersPuzzleType == "stepup") {
                    updatePyramidPuzzleArrayIndex(update[0], update[1] - (pyramidArray[update[0]].length - wordList[update[0]].length), placeholder);
                    updateStepUpPuzzleArrayIndex(update[0], update[1], placeholder);
                    updateStepDownPuzzleArrayIndex(update[0], update[1] - (stepDownArray[update[0]].length - wordList[update[0]].length), placeholder);
                    updateLetterListIndexFromLetters(update[0], update[1] - (stepDownArray[update[0]].length - wordList[update[0]].length), placeholder)
                } else if (lettersPuzzleType == "stepdown") {
                    updatePyramidPuzzleArrayIndex(update[0], update[1], placeholder);
                    updateStepUpPuzzleArrayIndex(update[0], update[1] + (stepDownArray[update[0]].length - wordList[update[0]].length), placeholder);
                    updateStepDownPuzzleArrayIndex(update[0], update[1], placeholder);
                    updateLetterListIndexFromLetters(update[0], update[1], placeholder);
                }
            }
        }

        if(lettersPuzzleType == "pyramid") {
            update = pyramidDetermineIndex(target);
            updatePyramidPuzzleArrayIndex(update[0], update[1], setHTML);
            updateStepUpPuzzleArrayIndex(update[0], update[1] + (stepDownArray[update[0]].length - wordList[update[0]].length), setHTML);
            updateStepDownPuzzleArrayIndex(update[0], update[1], setHTML);
            updateLetterListIndexFromLetters(update[0], update[1], setHTML);
        } else {
            update = genericDetermineIndex(target);
            if(lettersPuzzleType == "stepup") {
                updatePyramidPuzzleArrayIndex(update[0], update[1] - (pyramidArray[update[0]].length - wordList[update[0]].length), setHTML);
                updateStepUpPuzzleArrayIndex(update[0], update[1], setHTML);
                updateStepDownPuzzleArrayIndex(update[0], update[1] - (stepDownArray[update[0]].length - wordList[update[0]].length), setHTML);
                updateLetterListIndexFromLetters(update[0], update[1] - (stepDownArray[update[0]].length - wordList[update[0]].length), setHTML)
            } else if (lettersPuzzleType == "stepdown") {
                updatePyramidPuzzleArrayIndex(update[0], update[1], setHTML);
                updateStepUpPuzzleArrayIndex(update[0], update[1] + (stepDownArray[update[0]].length - wordList[update[0]].length), setHTML);
                updateStepDownPuzzleArrayIndex(update[0], update[1], setHTML);
                updateLetterListIndexFromLetters(update[0], update[1], setHTML);
            }
        }

    } else if (target.getAttribute('class').includes('guess')) {
        if(tdDragStart.getAttribute('class').includes('guess')) {
            if(puzzleType == "pyramid") {
                update = pyramidDetermineIndex(tdDragStart);
                // updatePyramidArrayIndex(row, column, placeholder);
                // updatestepUpArrayIndex(row, (wordList[row].length + column - 1), placeholder);
                // updatestepDownArrayIndex(row, column, placeholder);
                updateAttemptIndex(update[0], update[1], placeholder);
            } else {
                update = genericDetermineIndex(tdDragStart);
                if (puzzleType == "stepdown") {
                    // updatePyramidArrayIndex(row, column, placeholder);
                    // updatestepUpArrayIndex(row, (wordList[row].length + column - 1), placeholder);
                    // updatestepDownArrayIndex(row, column, placeholder);
                    updateAttemptIndex(update[0], update[1], placeholder);
                } else if (puzzleType == "stepup") {
                    // updatePyramidArrayIndex(row, column - (pyramidArray[row].length - wordList[row].length), placeholder);
                    // updateStepUpArrayIndex(row, column, letter);
                    // updatestepDownArrayIndex(row, column - (stepDownArray[row].length - wordList[row].length), placeholder);
                    updateAttemptIndex(update[0], update[1] - (stepDownArray[update[0]].length - wordList[update[0]].length), placeholder);
                }
            }
        } else if (tdDragStart.getAttribute('class').includes('puzzleLetter')) {
            if(lettersPuzzleType == "pyramid") {
                update = pyramidDetermineIndex(tdDragStart);
                updatePyramidPuzzleArrayIndex(update[0], update[1], placeholder);
                updateStepUpPuzzleArrayIndex(update[0], update[1] + (stepDownArray[update[0]].length - wordList[update[0]].length), placeholder);
                updateStepDownPuzzleArrayIndex(update[0], update[1], placeholder);
                updateLetterListIndexFromWords(update[0], update[1], placeholder);
            } else {
                update = genericDetermineIndex(tdDragStart);
                if(lettersPuzzleType == "stepup") {
                    updatePyramidPuzzleArrayIndex(update[0], update[1] - (pyramidArray[update[0]].length - wordList[update[0]].length), placeholder);
                    updateStepUpPuzzleArrayIndex(update[0], update[1], placeholder);
                    updateStepDownPuzzleArrayIndex(update[0], update[1] - (stepDownArray[update[0]].length - wordList[update[0]].length), placeholder);
                    updateLetterListIndexFromWords(update[0], update[1] - (stepDownArray[update[0]].length - wordList[update[0]].length), placeholder)
                } else if (lettersPuzzleType == "stepdown") {
                    updatePyramidPuzzleArrayIndex(update[0], update[1], placeholder);
                    updateStepUpPuzzleArrayIndex(update[0], update[1] + (stepDownArray[update[0]].length - wordList[update[0]].length), placeholder);
                    updateStepDownPuzzleArrayIndex(update[0], update[1], placeholder);
                    updateLetterListIndexFromWords(update[0], update[1], placeholder);
                }
            }
        }

        if(puzzleType == "pyramid") {
            update = pyramidDetermineIndex(target);
            // updatePyramidArrayIndex(row, column, placeholder);
            // updatestepUpArrayIndex(row, (wordList[row].length + column - 1), placeholder);
            // updatestepDownArrayIndex(row, column, placeholder);
            updateAttemptIndex(update[0], update[1], setHTML);
        } else {
            update = genericDetermineIndex(target);
            if (puzzleType == "stepdown") {
                // updatePyramidArrayIndex(row, column, placeholder);
                // updatestepUpArrayIndex(row, (wordList[row].length + column - 1), placeholder);
                // updatestepDownArrayIndex(row, column, placeholder);
                updateAttemptIndex(update[0], update[1], setHTML);
            } else if (puzzleType == "stepup") {
                // updatePyramidArrayIndex(row, column - (pyramidArray[row].length - wordList[row].length), placeholder);
                // updateStepUpArrayIndex(row, column, letter);
                // updatestepDownArrayIndex(row, column - (stepDownArray[row].length - wordList[row].length), placeholder);
                updateAttemptIndex(update[0], update[1] - (stepDownArray[update[0]].length - wordList[update[0]].length), setHTML);
            }
        }
    }
}

function sendArrays() {
    //this function will update the arrays in PHP to draw them correctly upon switching puzzle orientations
}

function changeLetterType(type) {
    lettersPuzzleType = type;
    // types are:
    // pyramid
    // stepup
    // stepdown
    // rectangle
}

function changePuzzleType(type) {
    puzzleType = type;
    // types are:
    // pyramid
    // stepup
    // stepdown
}

function pyramidDetermineIndex(targetCell) {
    for(var i=0; i < pyramidArray.length; i++) {
        for(var j=0; j < pyramidArray[i].length; j++) {
            if (targetCell.getAttribute('id') == ("row" + i + "column" + j)) {
                return [i, j];
            }
        }
    }
}

function genericDetermineIndex(targetCell) {
    var cellColumn = targetCell.cellIndex;
    var cellRow = targetCell.parentNode.rowIndex;
    console.log("cell row " + cellRow + " cell column " + cellColumn);
    return [cellRow, cellColumn];
}

function updatePyramidPuzzleArrayIndex(row, column, letter) {
    pyramidPuzzleArray[row][column] = letter;
}

function updateStepUpPuzzleArrayIndex(row, column, letter) {
    stepUpPuzzleArray[row][column] = letter;
}

function updateStepDownPuzzleArrayIndex(row, column, letter) {
    stepDownPuzzleArray[row][column] = letter;
}

function updateLetterListIndexFromLetters(row, column, letter) {
    var letterRow = 0;
	var letterColumn = 0;
	var count = 0;
    console.log("passing row " + row + " and column " + column);
    if (lettersPuzzleType != "rectangle") {
        if(row > 0) {
            for (var i = 0; i < row; i++) {
                count = count + wordList[i].length;
            }
        }
		count += column;
		letterRow = Math.floor(count/letterList[0].length);
        letterColumn = count % letterList[0].length;   
    } else {
        letterRow = row;
        letterColumn = column;

    }
    console.log("row: " + letterRow + " column: " + letterColumn);
    letterList[letterRow][letterColumn] = letter;
}

function updateLetterListIndexFromWords(row, column, letter) {
    var letterRow;
	var letterColumn;
    var count = 0;
    console.log("passing row " + row + " and column " + column);
    if(row > 0) {
        for (var i = 0; i < row; i++) {
            count = count + wordList[i].length;
        }
    }
	count += column;
	letterRow = Math.floor(count/letterList[0].length);
    letterColumn = count % letterList[0].length;
    console.log("row: " + letterRow + " column: " + letterColumn);
    letterList[letterRow][letterColumn] = letter;
}

function updateAttemptIndex(row, column, letter) {
    attempt[row][column] = letter;
    if(checkAnswer()) {alert("Congratulations!!!");}
}

function checkAnswer() {
    for(var i=0; i < attempt.length; i++) {
        for(var j=0; j < attempt[i].length; j++) {
            if(attempt[i][j] != wordList[i][j]) {
                return false;
            }
        }
    }
    return true;
}