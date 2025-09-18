<?php
class Bird
{
  public string $commonName;
  public string $latinName;

  public function __construct(string $commonName, string $latinName)
  {
    $this->commonName = $commonName;
    $this->latinName = $latinName;
  }

  public function summary(): string
  {
    return "Common name: {$this->commonName}<br>" .
      "Latin name: {$this->latinName}";
  }
}

$bird1 = new Bird("American Robin", "Turdus migratorious");
$bird2 = new Bird("Eastern Towhee", "Pipilo erythrophthalmus");

echo $bird1->summary() . "<br><hr>";
echo $bird2->summary() . "<br>";
