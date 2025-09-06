<?php

class User
{

  var $is_admin = false;

  var $first_name;
  var $last_name;
  var $username;

  function full_name()
  {
    return $this->first_name . " " . $this->last_name;
  }
}

class Customer extends User
{
  var $city;
  var $state;
  var $country;

  function location()
  {
    return $this->city . ", " . $this->state . ", " . $this->country;
  }
}

class AdminUser extends User
{
  var $is_admin = true;

  function full_name()
  {
    return $this->first_name . " " . $this->last_name . " (Admin)";
  }
}

$u = new user;
$u->first_name = 'Buster';
$u->last_name = 'Bluth';
$u->username = 'bbluth';

$c = new Customer;
$c->first_name = 'Michael';
$c->last_name = 'Bluth';
$c->username = 'bbluth';
$c->city = 'Asheville';
$c->state = 'NC';
$c->country = 'USA';

echo $u->full_name() . "<br/>";
echo $c->full_name() . "<br/>";

echo $c->location() . "<br/>";
// echo $u->location() . "<br/>"; // no method error

echo get_class($u) . "<br/>";
echo get_class($c) . "<br/>";

if (is_subclass_of($c, 'User')) {
  echo "Customer is a subclass of User.<br/>";
}

$parents = class_parents($c);
echo implode(', ', $parents) . "<br/>";
