<?php

class Bird
{
  public static $instance_count = 0;
  public static $egg_num = 0;

  public $name = "generic bird";
  public $habitat;
  public $food;
  public $nesting = "tree";
  public $conservation;
  public $song = "chirp";
  public $flying = "yes";

  public static function create()
  {
    self::$instance_count++;
    return new self;
  }

  public function can_fly()
  {
    return $this->name . " " . (($this->flying == "yes") ? "can fly" : "cannot fly and is stuck on the ground");
  }
}

class Flycatcher extends Bird
{
  public static $egg_num = "3-4, sometimes 5.";

  public $name = "yellow-bellied flycatcher";
  public $diet = "mostly insects.";
  public $song = "flat chilk";
}

class Kiwi extends Bird
{
  public $name = "kiwi";
  public $diet = "omnivorous";
  public $flying = "no";
}
