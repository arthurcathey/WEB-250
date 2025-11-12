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
      <h2>Bird Inventory</h2>
      <p>Check out the birds we've cataloged. Click View for more details, or manage records below.</p>

      <?php if (!$session->is_logged_in()) { ?>
        <p>
          <a href="<?php echo url_for('/login.php'); ?>">Login</a> |
          <a href="<?php echo url_for('/signup.php'); ?>">Sign Up</a>
        </p>
      <?php } else { ?>
        <p>
          Welcome, <?php echo h($session->username); ?>!
          <a href="<?php echo url_for('/logout.php'); ?>">Logout</a>

          <?php if ($session->is_admin()) { ?>
            | <a href="<?php echo url_for('/members/index.php'); ?>">Manage Members</a>
          <?php } ?>
        </p>
      <?php } ?>
    </div>

    <?php
    if ($session->is_logged_in() && ($session->is_member() || $session->is_admin())) { ?>
      <a class="action" href="<?php echo url_for('/new.php'); ?>">Add Bird</a>
    <?php } ?>

    <table id="inventory" border="1" cellpadding="5" cellspacing="0">
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Habitat</th>
        <th>Food</th>
        <th>Behavior</th>
        <th>Conservation</th>
        <th>Backyard Tips</th>
        <th>View</th>
        <?php if ($session->is_logged_in() && ($session->is_member() || $session->is_admin())) { ?>
          <th>Edit</th>
          <th>Delete</th>
        <?php } ?>
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
            <td><?php echo h($bird->behavior); ?></td>
            <td><?php echo h($bird->conservation()); ?></td>
            <td><?php echo h($bird->backyard_tips); ?></td>
            <td><a href="<?php echo url_for('/show.php?id=' . h(u($bird->id))); ?>">View</a></td>

            <?php if ($session->is_logged_in() && ($session->is_member() || $session->is_admin())) { ?>
              <td><a href="<?php echo url_for('/edit.php?id=' . h(u($bird->id))); ?>">Edit</a></td>
              <td><a href="<?php echo url_for('/delete.php?id=' . h(u($bird->id))); ?>">Delete</a></td>
            <?php } ?>
          </tr>
        <?php }
      } else { ?>
        <tr>
          <td colspan="<?php echo ($session->is_logged_in() && ($session->is_member() || $session->is_admin())) ? '11' : '9'; ?>">
            No birds found in the database.
          </td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
