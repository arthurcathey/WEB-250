<?php

function my_autoload($class)
{
  $class = ucfirst($class);

  $file = __DIR__ . '/classes/' . ($class) . '.class.php';
  if (file_exists($file)) {
    include $file;
  } else {
    echo "Autoload error: Class file '$file' not found.<br>";
  }
}

spl_autoload_register('my_autoload');
