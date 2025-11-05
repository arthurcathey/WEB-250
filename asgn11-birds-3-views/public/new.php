<?php
require_once('../private/initialize.php');

require_login();

// Enable detailed error reporting during development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$bird = new Bird();
$errors = [];

if (is_post_request()) {
  $args = $_POST['bird'] ?? [];
  $bird->merge_attributes($args);

  $result = $bird->save();

  if ($result === true) {
    // Handle image upload
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
        } catch (mysqli_sql_exception $e) {
          if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            $_SESSION['message'] = 'Duplicate image detected. Please choose a different image.';
          } else {
            throw $e;
          }
        }
      }
    }

    $session->message('The member was created successfully.');

    redirect_to(url_for('/show.php?id=' . h(u($bird->id))));
  } else {
    // Display errors returned from validate()
    $errors = $bird->errors;
  }
}

$page_title = 'Add Bird';
include(SHARED_PATH . '/public_header.php');
?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/birds.php'); ?>">&laquo; Back to List</a>

  <div class="bird new">
    <h1>Add Bird</h1>
    <?php echo display_errors($errors); ?>

    <form action="<?php echo url_for('/new.php'); ?>" method="post" enctype="multipart/form-data">
      <?php include('form_fields.php'); ?>
      <div id="operations">
        <input type="submit" value="Add Bird" />
      </div>
    </form>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
