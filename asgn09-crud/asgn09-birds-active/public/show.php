<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../private/initialize.php');
session_start();

// --- Get bird ID ---
$id = $_GET['id'] ?? false;
if (!$id) {
  redirect_to(url_for('/birds.php'));
}

// --- Find the bird record ---
$bird = Bird::find_by_id($id);
if (!$bird) {
  redirect_to(url_for('/birds.php'));
}

$page_title = 'View Bird';
include(SHARED_PATH . '/public_header.php');
?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/birds.php'); ?>">&laquo; Back to List</a>

  <div class="bird show">
    <h1>Bird Details</h1>

    <dl>
      <dt>Common Name</dt>
      <dd><?php echo h($bird->common_name); ?></dd>
    </dl>

    <dl>
      <dt>Habitat</dt>
      <dd><?php echo h($bird->habitat); ?></dd>
    </dl>

    <dl>
      <dt>Food</dt>
      <dd><?php echo h($bird->food); ?></dd>
    </dl>

    <dl>
      <dt>Behavior</dt>
      <dd><?php echo h($bird->behavior); ?></dd>
    </dl>

    <dl>
      <dt>Conservation Status</dt>
      <dd><?php echo h($bird->conservation()); ?></dd>
    </dl>

    <dl>
      <dt>Backyard Tips</dt>
      <dd><?php echo nl2br(h($bird->backyard_tips)); ?></dd>
    </dl>

    <hr>

    <h3>Images</h3>
    <?php
    $images = $bird->images();
    if (!empty($images)) {
      foreach ($images as $image) {
        echo '<img src="' . url_for('/uploads/' . h($image->file_name)) . '" alt="' . h($bird->common_name) . '" style="max-width:200px; margin:10px;">';
      }
    } else {
      echo '<p>No images available.</p>';
    }
    ?>

    <p>
      <a href="<?php echo url_for('/edit.php?id=' . h(u($bird->id))); ?>">Edit</a>
    </p>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
