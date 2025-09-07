<?php
class Guitar
{
  public $brand;
  protected $price = 0;

  public function setPrice($amount)
  {
    $this->price = $amount;
  }

  public function getPrice()
  {
    return $this->price;
  }
}

class ElectricGuitar extends Guitar
{
  public function applyDiscount($percent)
  {
    $discountAmount = ($percent / 100) * $this->price;
    $this->price -= $discountAmount;
  }
}

class AcousticGuitar extends Guitar
{
  public $bodyType;

  public function setBodyType($type)
  {
    $this->bodyType = $type;
  }

  public function describe()
  {
    return $this->brand . " acoustic guitar has a " . $this->bodyType . " body.";
  }
}

$electric = new ElectricGuitar();
$electric->brand = "Gibson";
$electric->setPrice(1200);
$electric->applyDiscount(10);
echo $electric->brand . " electric guitar now costs $" . $electric->getPrice() . "<br>";

$acoustic = new AcousticGuitar();
$acoustic->brand = "Taylor";
$acoustic->setPrice(900);
$acoustic->setBodyType("dreadnought");
echo $acoustic->brand . " acoustic guitar costs $" . $acoustic->getPrice() . "<br>";
echo $acoustic->describe() . "<br>";

$guitar = new Guitar();
$guitar->brand = "Fender";
$guitar->setPrice(800);
echo $guitar->brand . " guitar costs $" . $guitar->getPrice();
