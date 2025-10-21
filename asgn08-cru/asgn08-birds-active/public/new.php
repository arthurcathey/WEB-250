<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../private/initialize.php');

$bird = new Bird();

if (is_post_request()) {

  // 1️⃣ Merge posted attributes
  $args = $_POST['bird'];
  $bird->merge_attributes($args);
  $result = $bird->save();

  if ($result === true) {

    // 2️⃣ Handle file upload
    if (isset($_FILES['bird_image']) && $_FILES['bird_image']['error'] === UPLOAD_ERR_OK) {
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
        $image->save();
      }
    }

    // 3️⃣ Success message and redirect
    $_SESSION['message'] = 'The new bird was created successfully.';
    redirect_to(url_for('/show.php?id=' . $bird->id));
  }
  // else: errors will be displayed below
}
?>

<?php $page_title = 'New Bird'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/birds.php'); ?>">&laquo; Back to List</a>

  <div class="bird new">
    <h1>New Bird</h1>

    <?php echo display_errors($bird->errors); ?>

    <form action="<?php echo url_for('/new.php'); ?>" method="post" enctype="multipart/form-data">
      <?php include('form_fields.php'); ?>
      <div id="operations">
        <input type="submit" value="Create Bird" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
