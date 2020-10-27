<?php
error_reporting(0);
DEFINE('DB_SERVER', 'localhost');
DEFINE('DB_NAME', 'quotes_db');
DEFINE('DB_USER', 'root');
DEFINE('DB_PASS', '');



$db = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
$db->set_charset("utf8");

function run_sql($sql_script)
{
    global $db;
    // check connection
	$db->set_charset("utf8");
    if ($db->connect_error)
    {
        trigger_error(print_r(debug_backtrace()).'.Database connection failed: '  . $db->connect_error, E_USER_ERROR);
    }   else
    {
        $result = $db->query($sql_script);
        if($result === false)
        {
            trigger_error('Stack Trace: '.print_r(debug_backtrace()).'Invalid SQL: ' . $sql_script . '; Error: ' . $db->error, E_USER_ERROR);
        }
        else if(strpos($sql_script, "INSERT")!== false)
        {
            return $db->insert_id;
        }
        else
        {
            return $result;
        }
    }
}
















?>
