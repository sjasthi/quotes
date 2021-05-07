<?php
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

/**
 * A function which connects to the database using PDO.
 * 
 * @return object pdo database connection.
 */
function pdo_connect_to_db() {
    // Set DSN - data source name
    $dsn = 'mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME . ";charset=utf8";

    // Create PDO instance
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}