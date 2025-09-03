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

  function name()
  {
    return $this->commonName . "  " . $this->nestPlacement . "  " . $this->conservationLevel;
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
$bird2->nestPlacement = "Fields, roadsides, and edges of woods";
$bird2->conservationLevel = "Low";
$bird2->birdSong = "whatwhat!!";

echo $bird1->name() . "<br/>";
echo $bird2->name() . "<br/>";

echo "Bird 1 song: " . $bird1->song() . "<br/>";
echo "Bird 1 can fly? " . $bird1->canFly() . "<br/>";

echo "Bird 2 song: " . $bird2->song() . "<br/>";
echo "Bird 2 can fly? " . $bird2->canFly() . "<br/>";
