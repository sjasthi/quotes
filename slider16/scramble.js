function allowDrop(event) {
  event.preventDefault();
}

function drag(event) {
  event.dataTransfer.setData("text", event.target.id);
}

function drop(event) {
  event.preventDefault();
  var data = event.dataTransfer.getData("text");
  event.target.appendChild(document.getElementById(data));
}

function checkStats() {
  
  if (checkIfWinner()) {
    alert("Congratulations!  Well Played!");
  }
  else {
    alert('Incorrect Answer! Please try again!');

  }
}


function checkIfWinner() {

  var scrableValue = $('#scrableValue').val();
  scrableValue = scrableValue.replace(/\s/g, '');
  var userScrableValue = $('#cardSlots span').text();
  if (scrableValue == userScrableValue) {
    return true;
  }
  return false;


  /*    return true;*/
}
