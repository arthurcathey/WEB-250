<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$connection = mysqli_connect('localhost', 'hqkmwgmy_webuser', 'Chopper1984$', 'hqkmwgmy_bird');

if (!$connection) {
  die("Database connection failed: " . mysqli_connect_error());
} else {
  echo "Database connection successful!";
}
