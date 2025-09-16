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

  echo "<p>Bird count: " . Bird::$instance_count . "</p>";
  echo "<p>Flycatcher count: " . Flycatcher::$instance_count . "</p>";
  echo "<p>Kiwi count: " . Kiwi::$instance_count . "</p>";

  $bird1 = Bird::create();
  $fly1  = Flycatcher::create();
  $kiwi1 = Kiwi::create();

  echo '<p>The generic song of any bird is "' . $bird1->song . '".</p>';
  echo '<p>The song of the ' . $fly1->name . ' is "' . $fly1->song . '".</p>';
  echo "<p>The " . $fly1->name . " " . $fly1->can_fly() . ".</p>";
  echo "<p>The " . $kiwi1->name . " " . $kiwi1->can_fly() . ".</p>";

  echo "<p>Bird count: " . Bird::$instance_count . "</p>";
  echo "<p>Flycatcher count: " . Flycatcher::$instance_count . "</p>";
  echo "<p>Kiwi count: " . Kiwi::$instance_count . "</p>";
  ?>
</body>

</html>
