<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../private/initialize.php');

// Get the ID from the URL
$id = $_GET['id'] ?? null;

// Validate ID
if (!$id || !is_numeric($id)) {
  $error_message = "Invalid Bird ID. Please check the link and try again.";
  $bird = null;
} else {
  $bird = Bird::find_by_id($id);
  if (!$bird) {
    $error_message = "No bird found with ID " . h($id) . ". Check your database table for this ID.";
  }
}

// Page title
$page_title = $bird ? 'Show Bird: ' . h($bird->common_name) : 'Bird Not Found';

// Include header
include(SHARED_PATH . '/public_header.php');
?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/birds.php'); ?>">&laquo; Back to List</a>

  <?php if ($bird) { ?>
    <div class="bird show">
      <h1>Bird: <?php echo h($bird->common_name); ?></h1>
      <div class="attributes">
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
          <dt>Nest Placement</dt>
          <dd><?php echo h($bird->nest_placement); ?></dd>
        </dl>
        <dl>
          <dt>Behavior</dt>
          <dd><?php echo h($bird->behavior); ?></dd>
        </dl>
        <dl>
          <dt>Conservation</dt>
          <dd><?php echo h($bird->conservation()); ?></dd>
        </dl>
        <dl>
          <dt>Backyard Tips</dt>
          <dd><?php echo h($bird->backyard_tips); ?></dd>
        </dl>
      </div>

      <div class="bird-images">
        <h2>Images</h2>
        <?php
        $images = $bird->images();
        if (empty($images)) {
        ?>
          <p>No images available for this bird.</p>
        <?php } else { ?>
          <ul style="list-style:none; padding:0; display:flex; flex-wrap:wrap; gap:20px;">
            <?php foreach ($images as $image) { ?>
              <li>
                <img src="<?php echo url_for('/uploads/' . h($image->file_name)); ?>"
                  alt="<?php echo h($bird->common_name); ?>"
                  width="200" style="border-radius:8px; box-shadow:0 4px 10px rgba(0,0,0,0.2);">
              </li>
            <?php } ?>

          </ul>
        <?php } ?>
      </div>
    </div>
  <?php } else { ?>
    <div class="error-message">
      <h2><?php echo $error_message; ?></h2>
      <p>Please return to the <a href="<?php echo url_for('/birds.php'); ?>">Birds List</a>.</p>
    </div>
  <?php } ?>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
