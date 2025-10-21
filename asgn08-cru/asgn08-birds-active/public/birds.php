<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../private/initialize.php');

$page_title = 'Bird Inventory';
include(SHARED_PATH . '/public_header.php');
?>

<div id="main">
  <div id="page">
    <div class="intro">
      <img class="inset" src="<?php echo url_for('/mages/AdobeStock_18040381_xlarge.jpeg'); ?>" alt="Bird" />
      <h2>Bird Inventory</h2>
      <p>Check out the birds we've cataloged. Click View for more details, or manage records below.</p>
    </div>

    <a class="action" href="<?php echo url_for('/new.php'); ?>">Add Bird</a>

    <table id="inventory" border="1" cellpadding="5" cellspacing="0">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Habitat</th>
        <th>Food</th>
        <th>Nest Placement</th>
        <th>Behavior</th>
        <th>Conservation</th>
        <th>Backyard Tips</th>
        <th colspan="3">Actions</th>
      </tr>

      <?php
      $birds = Bird::find_all();

      if (!empty($birds)) {
        foreach ($birds as $bird) { ?>
          <tr>
            <td><?php echo h($bird->id); ?></td>
            <td><?php echo h($bird->common_name); ?></td>
            <td><?php echo h($bird->habitat); ?></td>
            <td><?php echo h($bird->food); ?></td>
            <td><?php echo h($bird->nest_placement); ?></td>
            <td><?php echo h($bird->behavior); ?></td>
            <td><?php echo h($bird->conservation()); ?></td>
            <td><?php echo h($bird->backyard_tips); ?></td>
            <td><a href="<?php echo url_for('/show.php?id=' . h(u($bird->id))); ?>">View</a></td>
            <td><a href="<?php echo url_for('/edit.php?id=' . h(u($bird->id))); ?>">Edit</a></td>
            <td><a href="<?php echo url_for('/delete.php?id=' . h(u($bird->id))); ?>">Delete</a></td>
          </tr>
        <?php }
      } else { ?>
        <tr>
          <td colspan="10">No birds found in the database.</td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
