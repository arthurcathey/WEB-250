<?php

class Dog
{
  public $name;
  public $breed;
  protected $canHerd = false;

  public function __construct($name, $breed)
  {
    $this->name = $name;
    $this->breed = $breed;
  }

  public function description()
  {
    return "{$this->name} is a {$this->breed}.";
  }

  public function ability()
  {
    if ($this->canHerd) {
      return "{$this->name} has strong herding instincts.";
    } else {
      return "{$this->name} does not herd livestock.";
    }
  }
}

class BorderCollie extends Dog
{
  protected $canHerd = true;

  public function work()
  {
    return "{$this->name} gathers and drives sheep efficiently.";
  }

  public function description()
  {
    return parent::description() . " Known for intelligence and agility.";
  }
}

class Bulldog extends Dog
{
  public $size;

  public function __construct($name, $breed, $size)
  {
    parent::__construct($name, $breed);
    $this->size = $size;
  }

  public function guard()
  {
    return "{$this->name} guards the home bravely despite its {$this->size} size.";
  }

  public function ability()
  {
    return "{$this->name} may not herd, but is loyal and protective.";
  }
}

$collie = new BorderCollie("Rex", "Border Collie");
echo $collie->description() . "<br>";
echo $collie->ability() . "<br>";
echo $collie->work() . "<br><br>";

$bulldog = new Bulldog("Max", "Bulldog", "medium");
echo $bulldog->description() . "<br>";
echo $bulldog->ability() . "<br>";
echo $bulldog->guard() . "<br>";
