<?php
// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));		
define("PROJECT_PATH", dirname(PRIVATE_PATH));   
define("PUBLIC_PATH", PROJECT_PATH . '/public');	
define("SHARED_PATH", PRIVATE_PATH . '/shared');

//--------------------------------  Changes these two lines tocorrectly reflect the deployment details 
define("DEPLOYMENT_URL", "http://safe");
define("SERVER_ROOT_PATH", "htp://safe");
//--------------------------------------------------------------------------------------

// Assign the root URL to a PHP constant
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once "session_start.php";
require_once('functions.php');
require_once('database.php');
require_once('query_functions.php');
require_once('validation_functions.php');

$db = db_connect();
$errors = array();
$config = array();

define("DEBUG_MODE", "ON");

/*
// localhost
// this app's id
$app_id = ?; // TODO: check what this is
// links
DEFINE('LOGIN_LINK', "http://localhost/telugupuzzles/login.php?app_id=" . $app_id);
DEFINE('LOGOUT_LINK', "http://localhost/telugupuzzles/logout.php");
DEFINE('REGISTER_LINK', "http://localhost/telugupuzzles/register.php?app_id==" . $app_id);
*/
// live
// this app's id
$app_id = 21;
// links
DEFINE('LOGIN_LINK', "http://telugupuzzles.com/login.php?app_id=" . $app_id);
DEFINE('LOGOUT_LINK', "http://telugupuzzles.com/logout.php");
//DEFINE('REGISTER_LINK', "http://telugupuzzles.com/register.php?app_id=" . $app_id);