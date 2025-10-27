<?php

// Turn on error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start(); // Turn on output buffering
// session_start(); // Uncomment if you use sessions

// Define path constants
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

// Find the position of "/public" in the URL
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

// Include required files (no class files here)
require_once(PRIVATE_PATH . '/functions.php');
require_once(PRIVATE_PATH . '/validation_functions.php');
require_once(PRIVATE_PATH . '/status_error_functions.php');
require_once(PRIVATE_PATH . '/db_credentials.php');
require_once(PRIVATE_PATH . '/db_functions.php');

// ✅ Autoload all class definitions automatically
spl_autoload_register(function ($class) {
  // Map special class names to exact filenames
  $special_cases = [
    'Bicycle' => 'bike.class.php',
    'Bird' => 'Bird.class.php',
    'DatabaseObject' => 'DatabaseObject.class.php', // match exact filename
    'Image' => 'image.class.php' // match exact filename
  ];

  if (isset($special_cases[$class])) {
    $file = PRIVATE_PATH . '/classes/' . $special_cases[$class];
  } else {
    // Default: class name matches filename exactly
    $file = PRIVATE_PATH . '/classes/' . $class . '.class.php';
  }

  if (file_exists($file)) {
    require_once($file);
  } else {
    echo "Autoload could not find class file: " . htmlspecialchars($file);
  }
});

// Database connection
$database = db_connect();
DatabaseObject::set_database($database);
