<?php

class Bird
{
  public static $instance_count = 0;
  public static $egg_num = 0;

  protected $name = "DefaultBird";
  protected $habitat;
  protected $food;
  protected $nesting = "tree";
  protected $conservation;
  protected $song = "chirp";
  protected $flying = "yes";

  public function __construct($name = null, $song = null, $flying = null)
  {
    $this->name   = $name   ?? $this->name;
    $this->song   = $song   ?? $this->song;
    $this->flying = $flying ?? $this->flying;
  }

  public static function create()
  {
    static::$instance_count++;
    return new static();
  }

  public function can_fly()
  {
    return $this->flying === "yes" ? "can fly" : "is stuck on the ground";
  }

  public function info()
  {
    return sprintf(
      "%s | %s | Song: %s | %s | Eggs: %s",
      get_class($this),
      $this->name,
      $this->song,
      $this->can_fly(),
      static::$egg_num
    );
  }
}

class Flycatcher extends Bird
{
  public static $instance_count = 0;
  public static $egg_num = "3-4, sometimes 5";

  protected $name = "yellow-bellied flycatcher";
  protected $diet = "mostly insects";
  protected $song = "flat chilk";

  public function __construct($name = null, $song = null, $flying = null)
  {
    parent::__construct($name ?? $this->name, $song ?? $this->song, $flying ?? $this->flying);
  }
}

class Kiwi extends Bird
{
  public static $instance_count = 0;
  public static $egg_num = 1;

  protected $name = "kiwi";
  protected $diet = "omnivorous";
  protected $flying = "no";

  public function __construct($name = null, $song = null, $flying = null)
  {
    parent::__construct($name ?? $this->name, $song ?? $this->song, $flying ?? $this->flying);
  }
}
