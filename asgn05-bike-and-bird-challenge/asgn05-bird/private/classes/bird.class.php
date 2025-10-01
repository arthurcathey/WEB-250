<?php

class Bird
{

  // Public properties matching CSV columns
  public $common_name;
  public $habitat;
  public $food;
  public $nest_placement;
  public $behavior;
  public $conservation_id;
  public $backyard_tips;

  // Protected constant mapping conservation_id to text
  protected const CONSERVATION_OPTIONS = [
    1 => 'Low concern',
    2 => 'Moderate concern',
    3 => 'Extreme concern',
    4 => 'Extinct'
  ];

  // Constructor accepts an associative array of $args
  public function __construct($args = [])
  {
    $this->common_name     = $args['common_name'] ?? '';
    $this->habitat         = $args['habitat'] ?? '';
    $this->food            = $args['food'] ?? '';
    $this->nest_placement  = $args['nest_placement'] ?? '';
    $this->behavior        = $args['behavior'] ?? '';
    $this->conservation_id = $args['conservation_id'] ?? 1;
    $this->backyard_tips   = $args['backyard_tips'] ?? '';
  }

  // Returns the conservation status as a human-readable string
  public function conservation()
  {
    return self::CONSERVATION_OPTIONS[$this->conservation_id] ?? 'Unknown';
  }
}
