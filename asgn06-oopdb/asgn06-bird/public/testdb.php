<?php
$mysqli = new mysqli("localhost", "hqkmwgmy_webuser", "Chopper1984$", "hqkmwgmy_birds");

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
echo "Database connected successfully!";
