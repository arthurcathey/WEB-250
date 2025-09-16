<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>asgn03 Static Methods & Properties</title>
</head>

<body>
  <h1>Inheritance & Static Methods Examples</h1>

  <?php
  include 'Bird.php';

  echo "<h2>Before creating instances:</h2>";
  echo "<p>Bird count: " . Bird::$instance_count . "</p>";
  echo "<p>Flycatcher count: " . Flycatcher::$instance_count . "</p>";
  echo "<p>Kiwi count: " . Kiwi::$instance_count . "</p>";

  $bird = Bird::create();
  $flycatcher = Flycatcher::create();
  $kiwi = Kiwi::create();

  echo "<h2>Bird information:</h2>";
  echo "<p>" . $bird->info() . "</p>";
  echo "<p>" . $flycatcher->info() . "</p>";
  echo "<p>" . $kiwi->info() . "</p>";

  echo "<h2>After creating instances:</h2>";
  echo "<p>Bird count: " . Bird::$instance_count . "</p>";
  echo "<p>Flycatcher count: " . Flycatcher::$instance_count . "</p>";
  echo "<p>Kiwi count: " . Kiwi::$instance_count . "</p>";
  ?>
</body>

</html>
