<?php
class ParseCSV
{
  public static $delimiter = "|";

  private $filename;
  private $header = [];
  private $data = [];
  private $row_count = 0;

  public function __construct($filename = '')
  {
    if ($filename !== '') {
      $this->file($filename);
    }
  }

  public function file($filename)
  {
    if (!file_exists($filename)) {
      echo "File does not exist: {$filename}";
      return false;
    } elseif (!is_readable($filename)) {
      echo "File is not readable: {$filename}";
      return false;
    }
    $this->filename = $filename;
    return true;
  }

  public function parse()
  {
    if (!isset($this->filename)) {
      echo "CSV file not set.";
      return false;
    }

    $this->reset();

    $file = fopen($this->filename, 'r');
    if (!$file) {
      echo "Unable to open CSV file: {$this->filename}";
      return false;
    }

    while (($row = fgetcsv($file, 0, self::$delimiter)) !== false) {

      if ($row === [null] || empty(array_filter($row))) {
        continue;
      }

      if (empty($this->header)) {
        $row[0] = preg_replace('/^\xEF\xBB\xBF/', '', $row[0]);
        $this->header = array_map('trim', $row);
        continue;
      }

      if (count($row) < count($this->header)) {
        $row = array_pad($row, count($this->header), null);
      } elseif (count($row) > count($this->header)) {
        $row = array_slice($row, 0, count($this->header));
      }

      $row = array_map('trim', $row);

      $assoc = @array_combine($this->header, $row);
      if ($assoc === false) continue;

      $this->data[] = $assoc;
      $this->row_count++;
    }

    fclose($file);
    return $this->data;
  }

  public function last_results()
  {
    return end($this->data) ?: null;
  }

  public function row_count()
  {
    return $this->row_count;
  }

  private function reset()
  {
    $this->header = [];
    $this->data = [];
    $this->row_count = 0;
  }
}
