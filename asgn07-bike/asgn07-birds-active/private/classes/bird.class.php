<?php

class Bird extends DatabaseObject
{
  static protected $table_name = 'birds';
  static protected $db_columns = [
    'id',
    'common_name',
    'habitat',
    'food',
    'nest_placement',
    'behavior',
    'conservation_id',
    'backyard_tips'
  ];

  public $id;
  public $common_name;
  public $habitat;
  public $food;
  public $nest_placement;
  public $behavior;
  public $conservation_id;
  public $backyard_tips;

  // HOW: Maps numeric conservation IDs to human-readable text.
  // WHY: Stores IDs efficiently in the database but displays friendly labels.
  public const CONSERVATION_OPTIONS = [
    1 => 'Low concern',
    2 => 'Moderate concern',
    3 => 'Extreme concern',
    4 => 'Extinct',
  ];

  public function __construct($args = [])
  {
    $this->common_name     = $args['common_name'] ?? '';
    $this->habitat         = $args['habitat'] ?? '';
    $this->food            = $args['food'] ?? '';
    $this->nest_placement  = $args['nest_placement'] ?? '';
    $this->behavior        = $args['behavior'] ?? '';
    $this->conservation_id = $args['conservation_id'] ?? 1; // default to low concern
    $this->backyard_tips   = $args['backyard_tips'] ?? '';
  }

  // Return a friendly "name" for the bird
  public function name()
  {
    return $this->common_name;
  }

  // Return human-readable conservation status
  public function conservation()
  {
    return self::CONSERVATION_OPTIONS[$this->conservation_id] ?? 'Unknown';
  }

  // Validate bird attributes
  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->common_name)) {
      $this->errors[] = "Common name cannot be blank.";
    }
    if (is_blank($this->habitat)) {
      $this->errors[] = "Habitat cannot be blank.";
    }
    if (is_blank($this->food)) {
      $this->errors[] = "Food cannot be blank.";
    }

    return $this->errors;
  }
}
