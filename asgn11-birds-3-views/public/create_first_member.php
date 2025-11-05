<?php
require_once('../private/initialize.php');

// Only run this once to create the first member
$member = new Member([
  'first_name' => 'Arthur',
  'last_name' => 'Cathey',
  'email' => 'arthur@example.com',
  'username' => 'arthur1234',
  'password' => 'Chopper1984$',
  'confirm_password' => 'Chopper1984$'
]);

$result = $member->save();

if ($result === true) {
  echo "Member created successfully. You can log in now!";
} else {
  echo display_errors($member->errors);
}
