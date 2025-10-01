<?php
require_once('../private/initialize.php');
$page_title = 'Sightings';
include(SHARED_PATH . '/public_header.php');
?>

<h2>Bird Inventory</h2>
<p>This is a short list -- start your birding!</p>

<?php
// Parse CSV file
$parser = new ParseCSV(PRIVATE_PATH . '/wnc-birds.csv');
$bird_array = $parser->parse();
?>

<!-- Create table with headers matching CSV -->
<table border="1" cellpadding="5" cellspacing="0">
  <thead>
    <tr>
      <th>Common Name</th>
      <th>Habitat</th>
      <th>Food</th>
      <th>Nest Placement</th>
      <th>Behavior</th>
      <th>Conservation Status</th>
      <th>Backyard Tips</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($bird_array as $args): ?>
      <?php $bird = new Bird($args); ?>
      <tr>
        <td><?php echo h($bird->common_name); ?></td>
        <td><?php echo h($bird->habitat); ?></td>
        <td><?php echo h($bird->food); ?></td>
        <td><?php echo h($bird->nest_placement); ?></td>
        <td><?php echo h($bird->behavior); ?></td>
        <td><?php echo h($bird->conservation()); ?></td>
        <td><?php echo h($bird->backyard_tips); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
