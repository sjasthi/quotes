var correctCards = 0;
$( init );

function init() {

 
  correctCards = 0;
  $('#cardPile').html( '' );
  $('#cardSlots').html( '' );

  var numbers = $('#scrableValue').val().split('');;

  var words = [];
  for ( var i=0; i<numbers.length; i++ ) {
    words.push('');

    $('<div><span>' + numbers[i] + '</span></div>').data( 'number',    [i] ).attr( 'id', 'card'+numbers[i] ).appendTo( '#cardPile' ).draggable( {
      containment: '#content',
      stack: '#cardPile span',
      cursor: 'move',
      revert: true
    } );
  }

  
  for ( var i=1; i<=numbers.length; i++ ) {

    $('<div>' + words[i-1] + '</div>').data( 'number', i ).appendTo( '#cardSlots' ).droppable( {
      accept: '#cardPile div',
      hoverClass: 'hovered',
      drop: handleCardDrop
    } );
  }

}

function handleCardDrop( event, ui ) {
  var slotNumber = $(this).data( 'number' );
  var cardNumber = ui.draggable.data( 'number' );
   ui.draggable.position( { of: $(this), my: 'left top', at: 'left top' } );
    ui.draggable.draggable( 'option', 'revert', false );
    correctCards++;
  // If the card was dropped to the correct slot,
  // change the card colour, position it directly
  // on top of the slot, and prevent it being dragged
  // again

/*  if ( slotNumber == cardNumber ) {
    ui.draggable.addClass( 'correct' );
    ui.draggable.draggable( 'disable' );
    $(this).droppable( 'disable' );
    ui.draggable.position( { of: $(this), my: 'left top', at: 'left top' } );
    ui.draggable.draggable( 'option', 'revert', false );
    correctCards++;
  } */
  
  // If all the cards have been placed correctly then display a message
  // and reset the cards for another go

/*  if ( correctCards == 10 ) {
    $('#successMessage').show();
    $('#successMessage').animate( {
      left: '380px',
      top: '200px',
      width: '400px',
      height: '100px',
      opacity: 1
    } );
  }*/

}