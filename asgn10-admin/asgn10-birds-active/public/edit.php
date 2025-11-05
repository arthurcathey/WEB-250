<?php
require_once('../private/initialize.php');

require_login();

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure valid ID
$id = $_GET['id'] ?? '';
$bird = Bird::find_by_id($id);
if (!$bird) {
  redirect_to(url_for('/birds.php'));
}

$errors = [];

if (is_post_request()) {
  // Handle image deletions
  if (!empty($_POST['delete_images'])) {
    foreach ($_POST['delete_images'] as $image_id) {
      $image = Image::find_by_id($image_id);
      if ($image) {
        $path = PUBLIC_PATH . '/uploads/' . $image->file_name;
        if (file_exists($path)) unlink($path);
        $image->delete();
      }
    }
  }

  // Merge form data
  $args = $_POST['bird'] ?? [];
  $bird->merge_attributes($args);

  $result = $bird->save();

  if ($result === true) {
    // Handle new image upload
    if (isset($_FILES['bird_image']) && $_FILES['bird_image']['error'] === UPLOAD_ERR_OK) {
      $upload_dir = PUBLIC_PATH . '/uploads/';
      if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

      $tmp_name = $_FILES['bird_image']['tmp_name'];
      $filename = basename($_FILES['bird_image']['name']);
      $target_path = $upload_dir . $filename;

      if (move_uploaded_file($tmp_name, $target_path)) {
        $image = new Image([
          'bird_id_fk' => $bird->id,
          'file_name'  => $filename
        ]);

        try {
          $image->save();
          $_SESSION['message'] = 'Bird updated successfully.';
        } catch (mysqli_sql_exception $e) {
          if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            $_SESSION['message'] = 'Duplicate image detected. Upload skipped.';
            unlink($target_path);
          } else {
            throw $e;
          }
        }
      }
    } else {
      $session->message('The member was updated successfully.');
    }

    redirect_to(url_for('/edit.php?id=' . h(u($bird->id))));
  } else {
    $errors = $bird->errors;
  }
}

$page_title = 'Edit Bird';
include(SHARED_PATH . '/public_header.php');
?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/birds.php'); ?>">&laquo; Back to List</a>

  <?php if (isset($_SESSION['message'])): ?>
    <div style="background:#d1ecf1;color:#0c5460;border:1px solid #bee5eb;padding:10px;border-radius:5px;margin-bottom:15px;">
      <?php
      echo h($_SESSION['message']);
      unset($_SESSION['message']);
      ?>
    </div>
  <?php endif; ?>

  <div class="bird edit">
    <h1>Edit Bird</h1>
    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/edit.php?id=' . h(u($bird->id))); ?>" method="post" enctype="multipart/form-data">
      <?php include('form_fields.php'); ?>
      <div id="operations">
        <input type="submit" value="Edit Bird" />
      </div>
    </form>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
