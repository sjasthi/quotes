<?php
include_once './db_credentials.php';
require_once './query_functions.php';

// Update each row with the new value
if ($_POST['column_count'] != "") {
    update_preference('DEFAULT_COLUMN_COUNT', $_POST['column_count']);
}

if ($_POST['language'] != "") {
    update_preference('DEFAULT_LANGUAGE', $_POST['language']);
}

if ($_POST['home_page_display'] != "") {
    update_preference('DEFAULT_HOME_PAGE_DISPLAY', $_POST['home_page_display']);
}

if ($_POST['chunk_size'] != "") {
    update_preference('DEFAULT_CHUNK_SIZE', $_POST['chunk_size']);
}

if ($_POST['no_of_quotes_to_display'] != "") {
    update_preference('NO_OF_QUOTES_TO_DISPLAY', $_POST['no_of_quotes_to_display']);
}

if ($_POST['feeling_lucky_mode'] != "") {
    $update = strtoupper($_POST['feeling_lucky_mode']);
    if(!($update == 'FIRST' || $update == 'LAST')){
      $update = 'RANDOM';
    }
    update_preference('FEELING_LUCKY_MODE', $update);
}

if ($_POST['feeling_lucky_type'] != "") {
  $update = strtoupper($_POST['feeling_lucky_type']);
  if(!($update == "DROPQUOTE" || $update == "FLOATQUOTE" || $update == 'DROPFLOAT' || $update == 'SCRAMBLE'
    || $update == 'SLIDER16' || $update == 'SPLIT' || $update == 'CATCH')){
      $update = 'DROPQUOTE';
    }
  update_preference('FEELING_LUCKY_TYPE', $update);
}

if ($_POST['grid_height'] != "") {
    update_preference('GRID_HEIGHT', $_POST['grid_height']);
}

if ($_POST['grid_width'] != "") {
    update_preference('GRID_WIDTH', $_POST['grid_width']);
}

if ($_POST['keep_punctuation_marks'] != ""){
  $update = strtoupper($_POST['keep_punctuation_marks']);
  if($update == 'TRUE' || $update == 'FALSE'){
    update_preference('KEEP_PUNCTUATION_MARKS', $update);
  }
}

header('location: preferences.php?preferencesUpdated=Success');
