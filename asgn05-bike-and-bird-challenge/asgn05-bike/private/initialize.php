<?php
ob_start(); // Turn on output buffering

// session_start(); // Uncomment if sessions are needed

define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

require_once('functions.php');

// Autoload class definitions
function my_autoload($class)
{
  // Special case: Bicycle class is in bike.class.php
  if ($class === 'Bicycle') {
    $file = PRIVATE_PATH . '/classes/bike.class.php';
    if (file_exists($file)) {
      include($file);
      return;
    } else {
      echo "Autoload could not find class file: " . $file;
      return;
    }
  }

  if (preg_match('/\A\w+\Z/', $class)) {
    $file = PRIVATE_PATH . '/classes/' . $class . '.class.php';
    if (file_exists($file)) {
      include($file);
    } else {
      echo "Autoload could not find class file: " . $file;
    }
  }
}
spl_autoload_register('my_autoload');
