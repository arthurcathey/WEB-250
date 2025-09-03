<?php

class bicycle
{
  var $brand;
  var $model;
  var $year;
  var $description = 'Used bicycle ';
  var $weight_kg = 0.0;

  function name()
  {
    return $this->brand . " " . $this->model . " (" . $this->year . ")";
  }

  function weight_lbs()
  {
    return floatval($this->weight_kg) * 2.2046226218;
  }

  function set_weight_lbs($value)
  {
    $this->weight_kg = floatval($value) / 2.2046226218;
  }
}

$rad = new Bicycle;
$rad->brand = 'Rad';
$rad->model = '3000B';
$rad->year = '2022';
$rad->weight_kg = 2.5;

$twoWheels = new Bicycle;
$twoWheels->brand = 'TwoWheels';
$twoWheels->model = 'Mountain';
$twoWheels->year = '2020';
$twoWheels->weight_kg = 3.5;

echo $rad->name() . "<br/>";
echo $twoWheels->name() . "<br/>";

echo $rad->weight_kg . " kg<br/>";
echo $rad->weight_lbs() . " lbs<br/>";

$rad->set_weight_lbs(3);
echo $rad->weight_kg . " kg<br/>";
echo $rad->weight_lbs() . " lbs<br/>";
