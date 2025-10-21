<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Image extends DatabaseObject
{

  static protected $table_name = 'images';
  static protected $db_columns = [
    'id',
    'bird_id_fk',
    'file_name'
  ];

  public $id;
  public $bird_id_fk;
  public $file_name;
  public $errors = [];

  public function __construct($args = [])
  {
    $this->bird_id_fk = $args['bird_id_fk'] ?? '';
    $this->file_name  = $args['file_name'] ?? '';
  }

  static public function find_by_bird_id($bird_id_fk)
  {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE bird_id_fk = '" . self::$database->escape_string($bird_id_fk) . "' ";
    $sql .= "ORDER BY id ASC";
    return static::find_by_sql($sql);
  }

  public function image_path()
  {
    return '/WEB-250/asgn08-cru/asgn08-birds-active/public/images/' . h($this->file_name);
  }

  protected function validate()
  {
    $this->errors = [];

    if (is_blank($this->bird_id_fk)) {
      $this->errors[] = "Bird ID cannot be blank.";
    }
    if (is_blank($this->file_name)) {
      $this->errors[] = "File name cannot be blank.";
    }

    return $this->errors;
  }
}
