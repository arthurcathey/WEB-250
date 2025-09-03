<?php

class Student {}
$classes = get_declared_classes();
echo "Classes: " . implode(', ', $classes);

$class_names = ['Product', 'Student', 'student'];
foreach ($class_names as $class_name) {
  if (class_exists($class_name)) {
    echo "{$class_name} exists.<br/>";
  } else {
    echo "{$class_name} does not exist.<br/>";
  }
}
