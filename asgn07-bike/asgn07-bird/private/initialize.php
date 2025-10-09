<?php

ob_start();

define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once('functions.php');
require_once('db_credentials.php');
foreach (glob(PRIVATE_PATH . '/classes/*.class.php') as $file) {
  require_once($file);
}

function my_autoload($class)
{
  if (preg_match('/\A\w+\Z/', $class)) {
    $file = PRIVATE_PATH . '/classes/' . $class . '.class.php';
    if (file_exists($file)) {
      include($file);
    } else {
    }
  }
}
spl_autoload_register('my_autoload');
$database = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
