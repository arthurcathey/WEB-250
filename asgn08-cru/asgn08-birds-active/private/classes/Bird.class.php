<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

  // Properties
  public $id;
  public $common_name;
  public $habitat;
  public $food;
  public $nest_placement;
  public $behavior;
  public $conservation_id;
  public $backyard_tips;
  public $errors = [];

  // Conservation status options
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
    $this->conservation_id = $args['conservation_id'] ?? 1;
    $this->backyard_tips   = $args['backyard_tips'] ?? '';
  }

  // ✅ Relationship: fetch all related images
  public function images()
  {
    return Image::find_by_bird_id($this->id);
  }

  // ✅ Human-readable name
  public function name()
  {
    return $this->common_name;
  }

  // ✅ Human-readable conservation label
  public function conservation()
  {
    return self::CONSERVATION_OPTIONS[$this->conservation_id] ?? 'Unknown';
  }

  // ✅ Validation
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
