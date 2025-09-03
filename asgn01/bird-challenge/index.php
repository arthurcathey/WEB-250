<?php
class Bird
{
  public $commonName;
  public $food;
  public $nestPlacement;
  public $conservationLevel;
  private $birdSong;

  public function __construct($commonName, $food, $nestPlacement, $conservationLevel, $birdSong)
  {
    $this->commonName = $commonName;
    $this->food = $food;
    $this->nestPlacement = $nestPlacement;
    $this->conservationLevel = $conservationLevel;
    $this->birdSong = $birdSong;
  }

  public function song()
  {
    return $this->birdSong;
  }

  public function canFly()
  {
    return "This bird can fly";
  }

  public function displayInfo()
  {
    echo "Properties\n";
    echo "<br>";
    echo "------------\n";
    echo "<br>";
    echo "commonName = {$this->commonName}\n";
    echo "<br>";
    echo "food = {$this->food}\n";
    echo "<br>";
    echo "nestPlacement = {$this->nestPlacement}\n";
    echo "<br>";
    echo "conservationLevel = {$this->conservationLevel}\n\n";
    echo "<br>";

    echo "Methods\n";
    echo "<br>";
    echo "------------\n";
    echo "<br>";
    echo "song = {$this->song()}\n";
    echo "<br>";
    echo "canFly = {$this->canFly()}\n";
    echo "<br>";
    echo "\n";
  }
}

$bird1 = new Bird(
  "Eastern Towhee",
  "seeds, fruits, insects, spiders",
  "Ground",
  "Low",
  "drink-your-tea!"
);

$bird2 = new Bird(
  "Indigo Bunting",
  "small seeds, berries, buds, and insects",
  "roadsides, and railroad rights-of-wafields and on the edges of woods",
  "Low",
  "whatwhat!!"
);

echo "\$bird1\n\n";
$bird1->displayInfo();

echo "\$bird2\n\n";
$bird2->displayInfo();
