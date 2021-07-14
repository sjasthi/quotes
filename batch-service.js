const dropQuote = "Drop";
const floatQuote = "Float";
const dropFloatQuote = "Drop-Float";
const scrambleQuote = "Scramble";
const splitQuote = "Split";
const slider16Quote = "Slider-16";
const catchAPhraseQuote  = "Catch-A-Phrase";
const puzzles = [dropQuote, floatQuote, dropFloatQuote, scrambleQuote, splitQuote, slider16Quote, catchAPhraseQuote];


window.onload = function(){
  createDropdownOption();
}

function generatePDF(){
  const element = document.getElementById("PuzzleContainer");
  html2pdf()
  .from(element)
  .save();
}

function createDropdownOption(){
  var select = document.getElementById("dropContainer");
  for (const puzzle of puzzles){
    var option = document.createElement("option");
    option.value = puzzle;
    var text = document.createElement("P");
    text.innerText = puzzle;
    option.appendChild(text);
    select.appendChild(option);
  }
}

//Code section originates from the user JoÃ£o Paulo Macedo on stackOverflow
//https://stackoverflow.com/questions/13952686/how-to-make-html-input-tag-only-accept-numerical-values
function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}