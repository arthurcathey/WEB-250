<?php
class Guitar
{
  // Properties 
  var $brand;
  var $type;
  var $model;
  var $color;
  var $price;

  // Methods
  function description()
  {
    return "This is a {$this->color}, {$this->brand} {$this->model} priced at \${$this->price}.";
  }
}
// Initialize properties

// Create a new guitar
$telecaster = new Guitar();
$telecaster->brand = "Fender";
$telecaster->model = "Telecaster";
$telecaster->color = "red";
$telecaster->price = 1000;


$martin = new Guitar();
$martin->brand = "Taylor";
$martin->model = "3000AC";
$martin->color = "purple";
$martin->price = 1850;

$telecaster->description();
echo $telecaster->description(); // Outputs "Fender Telecaster"
echo "<br>";
echo $martin->description();
