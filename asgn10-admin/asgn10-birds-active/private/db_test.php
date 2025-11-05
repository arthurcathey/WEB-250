<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once(__DIR__ . '/db_credentials.php');
require_once(__DIR__ . '/db_functions.php');

$db = db_connect();
if ($db) {
  echo "Database connection successful!<br>";
} else {
  echo "Database connection failed!<br>";
}

// Load DatabaseObject first
require_once(__DIR__ . '/classes/DatabaseObject.class.php');
// Then load Bird
require_once(__DIR__ . '/classes/Bird.class.php');

echo "Bird class file found!";
