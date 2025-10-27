<?php
class ParseCSV
{
  // HOW: Stores the delimiter used when splitting CSV fields.
  // WHY: Allows flexibility for parsing files that use different delimiters (default = comma).
  public static $delimiter = ",";

  private $filename;
  private $header;
  private $data = [];
  private $row_count = 0;
  private $last = null;

  public function __construct($filename = '')
  {
    if ($filename !== '') {
      $this->file($filename);
    }
  }

  public function file($filename)
  {
    if (!file_exists($filename)) {
      echo "File does not exist: " . $filename;
      return false;
    } elseif (!is_readable($filename)) {
      echo "File is not readable: " . $filename;
      return false;
    }
    $this->filename = $filename;
    return true;
  }

  public function parse()
  {
    if (!isset($this->filename) || $this->filename === '') {
      echo "File not set.";
      return false;
    }

    $this->reset();

    $file = fopen($this->filename, 'r');
    if ($file === false) {
      echo "Unable to open file: " . $this->filename;
      return false;
    }

    while (!feof($file)) {
      $row = fgetcsv($file, 0, self::$delimiter);
      if ($row === false || $row === [null]) continue;

      if (empty($this->header)) {
        if (isset($row[0])) $row[0] = preg_replace('/\xEF\xBB\xBF/', '', $row[0]);
        $this->header = $row;
        continue;
      }

      if (count($row) < count($this->header)) {
        $row = array_pad($row, count($this->header), null);
      } elseif (count($row) > count($this->header)) {
        $row = array_slice($row, 0, count($this->header));
      }

      $assoc = @array_combine($this->header, $row);
      if ($assoc === false) continue;

      $this->data[] = $assoc;
      $this->last = $assoc;
      $this->row_count++;
    }

    fclose($file);
    return $this->data;
  }

  // HOW: Returns the last row of data parsed from the CSV file.
  // WHY: Useful if you only need the most recent record instead of all rows.
  public function last_results()
  {
    return $this->last;
  }

  // HOW: Returns the total number of rows parsed.
  // WHY: Allows you to easily check the dataset size without manually counting.
  public function row_count()
  {
    return $this->row_count;
  }

  // HOW: Clears all stored CSV data, headers, and counters before parsing again.
  // WHY: Ensures that multiple parse operations start fresh without mixing old data.
  private function reset()
  {
    $this->header = null;
    $this->data = [];
    $this->row_count = 0;
    $this->last = null;
  }
}
