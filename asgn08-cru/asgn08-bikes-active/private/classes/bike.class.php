<?php

class Bicycle extends DatabaseObject
{
  static protected $table_name = 'bicycles';
  static protected $db_columns = ['id', 'brand', 'model', 'year', 'category', 'color', 'gender', 'price', 'weight_kg', 'condition_id', 'description'];

  public $id;
  public $brand;
  public $model;
  public $year;
  public $category;
  public $color;
  public $description;
  public $gender;
  public $price;
  public $weight_kg;
  public $condition_id;

  public const CATEGORIES = ['Road', 'Mountain', 'Hybrid', 'Cruiser', 'City', 'BMX'];
  public const GENDERS = ['Mens', 'Womens', 'Unisex'];

  // HOW: This constant maps numeric condition IDs (1–5) to human-readable text.
  // WHY: It allows the class to store conditions efficiently as numbers
  // but still output friendly labels (e.g., "Great" instead of just "4").
  public const CONDITION_OPTIONS = [
    1 => 'Beat up',
    2 => 'Decent',
    3 => 'Good',
    4 => 'Great',
    5 => 'Like New'
  ];

  public function __construct($args = [])
  {
    $this->brand = $args['brand'] ?? '';
    $this->model = $args['model'] ?? '';
    $this->year = $args['year'] ?? '';
    $this->category = $args['category'] ?? '';
    $this->color = $args['color'] ?? '';
    $this->description = $args['description'] ?? '';
    $this->gender = $args['gender'] ?? '';
    $this->price = $args['price'] ?? 0;
    $this->weight_kg = $args['weight_kg'] ?? 0.0;
    $this->condition_id = $args['condition_id'] ?? 3;
  }

  public function name()
  {
    return "{$this->brand} {$this->model} {$this->year}";
  }

  public function weight_kg()
  {
    return number_format($this->weight_kg, 2) . ' kg';
  }
  public function set_weight_kg($value)
  {
    $this->weight_kg = floatval($value);
  }
  public function weight_lbs()
  {
    return number_format($this->weight_kg * 2.2046226218, 2) . ' lbs';
  }
  public function set_weight_lbs($value)
  {
    $this->weight_kg = floatval($value) / 2.2046226218;
  }

  // HOW: Returns the condition label based on the bike’s condition_id.
  // WHY: Provides a human-readable description (e.g., "Good") instead of
  // just showing the raw numeric condition_id value.
  public function condition()
  {
    if ($this->condition_id > 0) {
      return self::CONDITION_OPTIONS[$this->condition_id] ?? "Unknown";
    }
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->brand)) {
      $this->errors[] = "Brand cannot be blank.";
    }
    if (is_blank($this->model)) {
      $this->errors[] = "Model cannot be blank.";
    }
    if (is_blank($this->year)) {
      $this->errors[] = "Year cannot be blank.";
    }
    return $this->errors;
  }
}
