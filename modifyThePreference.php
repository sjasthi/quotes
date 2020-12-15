<?php

include_once 'db_credentials.php';

   $column_count = mysqli_real_escape_string($db, $_POST['column_count']);
  $language = mysqli_real_escape_string($db, $_POST['language']);
  $home_page_display = mysqli_real_escape_string($db, $_POST['home_page_display']);
  $no_of_quotes_to_display = mysqli_real_escape_string($db, $_POST['no_of_quotes_to_display']);
  $feeling_lucky_mode = mysqli_real_escape_string($db, $_POST['feeling_lucky_mode']);
  $feeling_lucky_type = mysqli_real_escape_string($db, $_POST['feeling_lucky_type']);


  // id name value comments - is the table structure
  $sql = "UPDATE `preferences` SET `value`= $column_count WHERE `name`= 'DEFAULT_COLUMN_COUNT'";
  mysqli_query($db, $sql);
  
  $sql = "UPDATE `preferences` SET `value`= $language WHERE `name`= 'DEFAULT_LANGUAGE'";
  mysqli_query($db, $sql);
  
  $sql = "UPDATE `preferences` SET `value`= $home_page_display WHERE `name`= 'DEFAULT_HOME_PAGE_DISPLAY'";
  mysqli_query($db, $sql);

  $sql = "UPDATE `preferences` SET `value`= $no_of_quotes_to_display WHERE `name`= 'NO_OF_QUOTES_TO_DISPLAY'";
  mysqli_query($db, $sql);

  
  $sql = "UPDATE `preferences` SET `value`= $feeling_lucky_mode WHERE `name`= 'FEELING_LUCKY_MODE'";
  mysqli_query($db, $sql);

  $sql = "UPDATE `preferences` SET `value`= $feeling_lucky_type WHERE `name`= 'FEELING_LUCKY_TYPE'";
  mysqli_query($db, $sql);

  header('location: preferences.php?preferencesUpdated=Success');
