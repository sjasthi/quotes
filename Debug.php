<?php $page_title = ' Quote Drop'; ?>
<?php
$nav_selected = "LIST";
$left_buttons = "NO";
$left_selected = "";
require 'db_credentials.php';
include("./nav.php");
include("usefultool.php");
error_reporting(0);
?>

<?php
$debug1 = array(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);
$debug2 = array(2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2);
SwapBoy($debug1, $debug2);
foreach ($debug1 as $axe) {
  echo $axe;
}

?>