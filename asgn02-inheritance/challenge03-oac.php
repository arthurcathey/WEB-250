<?php

class Bicycle
{
  public $brand;
  public $model;
  protected $year;
  private $weightKg;

  public function name()
  {
    return "{$this->brand} {$this->model} ({$this->year})";
  }

  public function setWeightKg($value)
  {
    $this->weightKg = $value;
  }

  public function getWeightKg()
  {
    return $this->weightKg . " kg";
  }

  public function weightLbs()
  {
    return ($this->weightKg * 2.20462) . " lbs";
  }
}

class Unicycle extends Bicycle
{
  public $wheels = 1;

  public function wheelDetails()
  {
    return "It has {$this->wheels} wheel.";
  }
}

class RoadBike extends Bicycle
{
  public $wheels = 2;

  public function wheelDetails()
  {
    return "It has {$this->wheels} wheels.";
  }
}

$bike = new RoadBike();
$bike->brand = "Trek";
$bike->model = "Domane";
$bike->setWeightKg(8);
echo $bike->name() . "<br>";
echo "Weight: " . $bike->getWeightKg() . " / " . $bike->weightLbs() . "<br>";
echo $bike->wheelDetails() . "<br><br>";

$uni = new Unicycle();
$uni->brand = "Schwinn";
$uni->model = "OneWheel";
$uni->setWeightKg(5);
echo $uni->name() . "<br>";
echo "Weight: " . $uni->getWeightKg() . " / " . $uni->weightLbs() . "<br>";
echo $uni->wheelDetails() . "<br>";
