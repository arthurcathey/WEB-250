<?php

class Bird
{
  var $commonName;
  var $food;
  var $nestPlacement;
  var $conservationLevel;
  var $birdSong;

  function song()
  {
    return $this->birdSong;
  }

  function canFly()
  {
    return "This bird can fly";
  }

  function displayInfo($label)
  {
    echo "\${$label}<br/>";
    echo "Properties<br/>";
    echo "_____________<br/>";
    echo "commonName = {$this->commonName}<br/>";
    echo "food = {$this->food}<br/>";
    echo "nestPlacement = {$this->nestPlacement}<br/>";
    echo "conservationLevel = {$this->conservationLevel}<br/>";
    echo "Methods<br/>";
    echo "_____________<br/>";
    echo "song = {$this->song()}<br/>";
    echo "canFly = {$this->canFly()}<br/><br/>";
  }
}

$bird1 = new Bird;
$bird1->commonName = "Eastern Towhee";
$bird1->food = "seeds, fruits, insects, spiders";
$bird1->nestPlacement = "Ground";
$bird1->conservationLevel = "Low";
$bird1->birdSong = "drink-your-tea!";

$bird2 = new Bird;
$bird2->commonName = "Indigo Bunting";
$bird2->food = "small seeds, berries, buds, and insects";
$bird2->nestPlacement = "roadsides, and railroad rights-of-way, fields and on the edges of woods";
$bird2->conservationLevel = "Low";
$bird2->birdSong = "whatwhat!!";

$bird1->displayInfo("bird1");
$bird2->displayInfo("bird2");
