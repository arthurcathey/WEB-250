<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../private/initialize.php');
session_start();

// --- Initialize a blank Bird object ---
/** @var Bird $bird */
$bird = new Bird;

if (is_post_request()) {
  // Merge POSTed data into the new Bird object
  $bird->merge_attributes($_POST['bird']);

  try {
    $result = $bird->save();

    if ($result === true) {

      // --- Handle image upload (if any) ---
      if (isset($_FILES['bird_image']) && $_FILES['bird_image']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = PUBLIC_PATH . '/uploads/';
        if (!is_dir($upload_dir)) {
          mkdir($upload_dir, 0755, true);
        }

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
            // Handle duplicate image file name
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
              $_SESSION['message'] = 'Duplicate image detected. Please choose a different image.';
              unlink($target_path);
              redirect_to(url_for('/edit.php?id=' . h($bird->id)));
            } else {
              throw $e;
            }
          }
        }
      }

      $_SESSION['message'] = 'The bird was added successfully.';
      redirect_to(url_for('/show.php?id=' . $bird->id));
    }
  } catch (mysqli_sql_exception $e) {
    // Graceful handling for SQL constraint errors
    if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
      $_SESSION['message'] = 'Duplicate entry detected. Please check your input.';
    } else {
      throw $e;
    }
  }
}

$page_title = 'Add Bird';
include(SHARED_PATH . '/public_header.php');
?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/birds.php'); ?>">&laquo; Back to List</a>

  <?php if (isset($_SESSION['message'])): ?>
    <div style="
      background-color: #ffdddd;
      border-left: 4px solid #f44336;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 4px;
      font-family: Arial, sans-serif;
      color: #333;">
      <?php
      echo h($_SESSION['message']);
      unset($_SESSION['message']);
      ?>
    </div>
  <?php endif; ?>

  <div class="bird new">
    <h1>Add Bird</h1>

    <?php echo display_errors($bird->errors); ?>

    <form action="<?php echo url_for('/new.php'); ?>" method="post" enctype="multipart/form-data">
      <?php include('form_fields.php'); ?>

      <div id="operations">
        <input type="submit" value="Add Bird" />
      </div>
    </form>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
