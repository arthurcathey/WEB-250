<?php
require_once('../private/initialize.php');

$first_name = 'Arthur';
$last_name = 'Cathey';
$email = 'arthur@example.com';
$username = 'arthur1234';
$password = 'Chopper1984$';

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$sql = "INSERT INTO members (first_name, last_name, email, username, hashed_password) VALUES (?, ?, ?, ?, ?)";

$stmt = $database->prepare($sql);
$stmt->bind_param('sssss', $first_name, $last_name, $email, $username, $hashed_password);
$stmt->execute();

if ($stmt->affected_rows === 1) {
  echo "User inserted successfully.";
} else {
  echo "Error inserting user.";
}
