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
    update_preference('FEELING_LUCKY_MODE', $_POST['feeling_lucky_mode']);
}

if ($_POST['feeling_lucky_type'] != "") {
    update_preference('FEELING_LUCKY_TYPE', $_POST['feeling_lucky_type']);
}

if ($_POST['grid_height'] != "") {
    update_preference('GRID_HEIGHT', $_POST['grid_height']);
}

if ($_POST['grid_width'] != "") {
    update_preference('GRID_WIDTH', $_POST['grid_width']);
}
if ($_POST['keep_punctuation_marks'] != "") {
    update_preference('KEEP_PUNCTUATION_MARKS', $_POST['keep_punctuation_marks']);
}
header('location: preferences.php?preferencesUpdated=Success');