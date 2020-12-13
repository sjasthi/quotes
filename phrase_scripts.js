/**
 * Class: ICS 325 Section 01 Summer 2019
 * Name: Samara Garrett
 * Assignment: Assignment 2
 * 
 * Reference
 *  https://www.w3schools.com/jsref/met_table_insertrow.asp
 *  https://www.w3schools.com/jsref/met_tablerow_deletecell.asp
 *  https://stackoverflow.com/questions/14643617/create-table-using-javascript
 */

/**
 * Generate game and solution grids, fill with both fillers and phrase, and add to end of document.
 * 
 * @param {boolean} starting Whether this function is being called when the page starts or not.
 */
function gen(starting) {
    // pull height and width from dropdowns
    var height = document.getElementById("height").value;
    var width = document.getElementById("width").value;

    // if gen has already been called, remove the grids so that they can be generated again
    if (!starting) {
        document.body.removeChild(document.getElementById("game"));
        document.body.removeChild(document.getElementById("solution"));
        document.body.removeChild(document.getElementById("linebreak"));
    }

    // create game grid
    var gameGrid = document.createElement("TABLE");
    document.body.appendChild(gameGrid);
    gameGrid.id = "game";
    generateGrid(height, width, gameGrid);

    // space between grids
    var linebreak = document.createElement("BR");
    document.body.appendChild(linebreak);
    linebreak.id = "linebreak"

    // create solution grid
    var solutionGrid = document.createElement("TABLE");
    document.body.appendChild(solutionGrid);
    solutionGrid.id = "solution";
    generateGrid(height, width, solutionGrid);

    // get phrase and fillers and parse into arrays
    var phraseChars = parseInputString(document.getElementById("phrase").value);
    var fillers = parseInputString(document.getElementById("fillers").value);

    /* hard coded values and locations for phrase
    var values = ["a","x","BC","U","Z","p","r","e","l","s","F","cd","y","N","g","y","TH","M","N","Bc","o","l","y","A","m","K","u","E","P","R","x","E","W","D","L","D","AB","T","O","D","cd","f","f","A","d","D","A","P","Z","F","f","X","c","S","a","LK","r","A","Z","X","X","a","h","F","B","u","O","p","I","a","a","m","B","x","y","G","i","b","Y","m","m","B","ab","a","b","c","d","e","P","I","k","B","e","r","t","h","g","f","F","O"];
    var locations = [[3,2],[4,3],[3,4],[2,5],[1,6],[2,7],[3,7],[4,6],[5,5]];
    */

    // generate random filler values and locations for phrase
    var values = gridValues(height, width, fillers);
    var locations = chooseLocations(height, width, phraseChars);

    // place filler values into the grids
    fillGrid(gameGrid, values);
    fillGrid(solutionGrid, values);

    // place the phrase into the grids
    placePhrase(locations, phraseChars, gameGrid, false);
    placePhrase(locations, phraseChars, solutionGrid, true);
}

/**
 * Use height and width to add the correct number of rows and cells to the input table.
 * 
 * @param {int} height The number of rows to be added.
 * @param {int} width The number of cells to be added to each row.
 * @param {table} grid The table to add the rows and cells to.
 */
function generateGrid(height, width, grid) {
    for (var i = 0; i < height; i++) {
        var row = grid.insertRow(0);
        for (var j = 0; j < width; j++) {
            row.insertCell(0);
        }
    }
}

/**
 * Takes an input string of one or more characters separated by commas, splits those characters groupings
 *  by comma, removes any proceeding or following whitespace, and returns an array of the results.
 * 
 * @param {string} string An input string of characters separated by commas.
 */
function parseInputString(string) {
    var inputs = string.split(",");
    for (var i = 0; i < inputs.length; i++) {
        inputs[i] = inputs[i].trim();
    }
    return inputs;
}

/**
 * Takes an array of filler values and returns an array of enough random values to fill a grid of the
 *  size height x width.
 * @param {int} height The number of rows in the grid to be filled.
 * @param {int} width The number of cells in each row of the grid to be filled.
 * @param {Array.<string>} fillers The array of possible filler values
 */
function gridValues(height, width, fillers) {
    var values = [];
    for (var i = 0; i < height; i++) {
        for (var j = 0; j < width; j++) {
            // pick a random value from the filler options for the location
            values[i * width + j] = fillers[Math.floor(Math.random() * fillers.length)];
        }
    }
    return values;
}

/**
 * Takes as input an array of strings and returns an array of locations (in the format 
 *  [height from top, width from left]) for them in a grid of size height x width.
 * 
 * @param {int} height The height of the grid.
 * @param {int} width The width of the grid.
 * @param {Array.<string>} phraseChars The strings to place in the grid.
 */
function chooseLocations(height, width, phraseChars) {
    var legitimatePlacement = false;
    var startOver = true;

    // continue until a full set of legitimate placements have been found
    while (startOver) {
        startOver = false;

        // choose a random location for the first character
        var locations = [[Math.floor(Math.random() * height), Math.floor(Math.random() * width)]];

        // choose random locations for the other characters such that no character touches an earlier character
        for (var i = 1; i < phraseChars.length; i++) { // TODO account for getting stuck
            var newLocation;
            var placementOptions = 8;
            var badPlacements = [];
            while (!legitimatePlacement && !startOver) {
                // pick a random location for the next character
                var placement = Math.floor(Math.random() * placementOptions);

                // adjust placement based on which placements have been determined to be bad
                for (var j = 0; j < badPlacements.length; j++) {
                    if (j <= placement) {
                        if (badPlacements[j] === true) {
                            placement += 1;
                        }
                    }
                }

                // the location in vertical and horizontal coordinates of the grid
                newLocation = [];
                if (placement < 8) {
                    switch (placement) {
                        case 0:
                            newLocation[0] = locations[i - 1][0] - 1;
                            newLocation[1] = locations[i - 1][1] - 1;
                            break;
                        case 1:
                            newLocation[0] = locations[i - 1][0] - 1;
                            newLocation[1] = locations[i - 1][1];
                            break;
                        case 2:
                            newLocation[0] = locations[i - 1][0] - 1;
                            newLocation[1] = locations[i - 1][1] + 1;
                            break;
                        case 3:
                            newLocation[0] = locations[i - 1][0];
                            newLocation[1] = locations[i - 1][1] + 1;
                            break;
                        case 4:
                            newLocation[0] = locations[i - 1][0] + 1;
                            newLocation[1] = locations[i - 1][1] + 1;
                            break;
                        case 5:
                            newLocation[0] = locations[i - 1][0] + 1;
                            newLocation[1] = locations[i - 1][1];
                            break;
                        case 6:
                            newLocation[0] = locations[i - 1][0] + 1;
                            newLocation[1] = locations[i - 1][1] - 1;
                            break;
                        case 7:
                            newLocation[0] = locations[i - 1][0];
                            newLocation[1] = locations[i - 1][1] - 1;
                            break;
                    }
                    // check if the location chosen is legitimate (is not outside the grid or touching a previous character in the phrase)
                    legitimatePlacement = legitimate(locations, newLocation, height, width);
                } else {
                    startOver = true;
                }

                // if the placement is not legitimate, record it as bad
                if (!legitimatePlacement) {
                    badPlacements[placement] = true;
                    placementOptions -= 1;
                }
            }

            // if all possible locations have been checked and none of them are legitimate, start over
            if (startOver) {
                break;
            }

            // when a legitmate placement is found, add it to the locations list
            locations[i] = newLocation;
            legitimatePlacement = false;
        }
    }
    return locations;
}

/**
 * True if the placement of a string is legitimate, false otherwise. A placement is legitimate if:
 *  a. It does not fall outside the grid.
 *  b. It does not touch any previous placement (other than the placement directly before it).
 * 
 * @param {Array.<Array.<int>>} locations The previous placements.
 * @param {Array.<int>} newLocation The prospective new placement.
 * @param {int} height The height of the grid.
 * @param {int} width The width of the grid.
 */
function legitimate(locations, newLocation, height, width) {
    // check if new location out of bounds
    if (newLocation[0] < 0 || newLocation[0] >= height || newLocation[1] < 0 || newLocation[1] >= width) {
        return false;
    }

    // check if new location touches an old location
    for (var i = 0; i < locations.length - 1; i++) {
        // the new location touches an old location if it is within the 3x3 square surrounding the old location
        if (newLocation[0] <= (locations[i][0] + 1) && newLocation[0] >= (locations[i][0] - 1)
            && newLocation[1] <= (locations[i][1] + 1) && newLocation[1] >= (locations[i][1] - 1)) {
            return false;
        }
    }

    // otherwise, placement is legitimate
    return true;
}

/**
 * Fill the input table cells with the input values. The number of input values will match the number
 *  of cells exactly.
 * 
 * @param {table} grid The table to fill with values.
 * @param {Array.<string>} values The values to fill the table with.
 */
function fillGrid(grid, values) {
    var rows = grid.getElementsByTagName("TR");
    for (var i = 0; i < rows.length; i++) {
        var cells = rows[i].getElementsByTagName("TD");
        for (var j = 0; j < cells.length; j++) {
            cells[j].innerText = values[i * (cells.length) + j];
        }
    }
}

/**
 * Place the input phrase at the locations chosen in the input table. If the input table is the
 *  solution grid, change the background color of the cells.
 * 
 * @param {Array.<Array.<int>>} locations The locations to place the phrase strings.
 * @param {Array.<string>} phraseChars The phrase strings to be placed.
 * @param {table} grid The table to place the phrase into.
 * @param {boolean} solution Whether the table is the solution table or not.
 */
function placePhrase(locations, phraseChars, grid, solution) {
    var rows = grid.getElementsByTagName("TR");
    for (var i = 0; i < phraseChars.length; i++) {
        // place the phrase characters at the locations in the grid
        rows[locations[i][0]].getElementsByTagName("TD")[locations[i][1]].innerText = phraseChars[i];

        // if the table is the solution table, change the background color of the cells
        if (solution) {
            rows[locations[i][0]].getElementsByTagName("TD")[locations[i][1]].style.backgroundColor = "green";
        }
    }
}