<?php
require_once './initialize.php';
?>

<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="stylesheet" href="styles/main_style.css" type="text/css">
         -->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <!-- Latest compiled JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
  <title> Quotes</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/css/dataTables.bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="./mainStyleSheet.css">
  <link rel="stylesheet" href="css/cjui.css">
  <script src="jquery/jquery.js"></script>
  <script src="jquery/jui.js"></script>
  <!--<script src="scramble.js"></script>-->
</head>

<body class="body_background">
  <div id="wrap">
    <div id="nav">
      <ul>
        <a href="index.php">
          <li class="horozontal-li-logo">
            <img src="./images/app_logo.png">
            <br />Quotes</li>
        </a>

        <a href="index.php">
          <li <?php if ($nav_selected == "HOME") {
                echo 'class="current-page"';
              } ?>>
            <img src="./images/home.png">
            <br />Home</li>
        </a>

        <?php if (is_admin()) { ?>
        <a href="admin.php">
          <li <?php if ($nav_selected == "ADMIN") {
                echo 'class="current-page"';
              } ?>>
            <img src="./images/admin.png">
            <br />Admin</li>
        </a>
        <?php }?>

        <a href="report.php">
          <li <?php if ($nav_selected == "REPORT") {
                echo 'class="current-page"';
              } ?>>
            <img src="./images/reports.png">
            <br />Reports</li>
        </a>

        <?php if (is_admin()) { ?>
        <a href="preferences.php">
          <li <?php if ($nav_selected == "PREF") {
                echo 'class="current-page"';
              } ?>>
            <img src="./images/preferences.png">
            <br />Preferences</li>
        </a>
        <?php }?>

        <a href="about.php">
          <li <?php if ($nav_selected == "PREF") {
                echo 'class="current-page"';
              } ?>>
            <img src="./images/about.png">
            <br />About</li>
        </a>

        <?php
        if (!is_logged_in()) {
        ?>
        <a href="<?php echo LOGIN_LINK; ?>">
          <li <?php if ($nav_selected == "PREF") {
                echo 'class="current-page"';
              } ?>>
            <img src="./images/login.png">
            <br />Login</li>
        </a>

        <?php
        } else {
        ?>
        <a href="<?php echo LOGOUT_LINK; ?>">
          <li <?php if ($nav_selected == "PREF") {
                echo 'class="current-page"';
              } ?>>
            <img src="./images/logout.png">
            <br />Logout</li>
        </a>

        <?php } ?>
        <a href="feelingLucky.php">
          <li <?php if ($nav_selected == "PREF") {
                echo 'class="current-page"';
              } ?>>
            <img src="./images/feelingLucky.png">
            <br />Feeling Lucky</li>
        </a>


        </a>

      </ul>
      <br />
    </div>


    <table style="width:1250px">
      <tr>
        <?php
        if ($left_buttons == "YES") {
        ?>

          <td style="width: 120px;" valign="top">
            <?php
            if ($nav_selected == "HOME") {
              include("./index.php");
            } elseif ($nav_selected == "LIST") {
              include("./left_menu_list.php");
            } else {
              include("./left_menu.php");
            }
            ?>
          </td>
          <td style="width: 1100px;" valign="top">
          <?php
        } else {
          ?>
          <td style="width: 100%;" valign="top">
          <?php
        }
          ?>