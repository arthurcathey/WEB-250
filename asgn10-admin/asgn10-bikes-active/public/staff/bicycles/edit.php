<?php
require_once('../../../private/initialize.php');

require_login();

if (!isset($_GET['id'])) {
  redirect_to(url_for('/staff/bicycles/index.php'));
}

$id = $_GET['id'];
$bicycle = Bicycle::find_by_id($id);

if ($bicycle == false) {
  redirect_to(url_for('/staff/bicycles/index.php'));
}

$errors = [];

if (is_post_request()) {
  $args = $_POST['bicycle'] ?? [];
  $bicycle->merge_attributes($args);
  $errors = $bicycle->validate();

  if (empty($errors)) {
    $result = $bicycle->save();
    if ($result === true) {
      $_SESSION['message'] = 'The bicycle was updated successfully.';
      redirect_to(url_for('/staff/bicycles/show.php?id=' . $bicycle->id));
    }
  }
}
?>

<?php $page_title = 'Edit Bicycle'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <a class="back-link" href="<?php echo url_for('/staff/bicycles/index.php'); ?>">&laquo; Back to List</a>

  <div class="bicycle edit">
    <h1>Edit Bicycle</h1>

    <form action="<?php echo url_for('/staff/bicycles/edit.php?id=' . h(u($bicycle->id))); ?>" method="post">
      <?php include('form_fields.php'); ?>
      <div id="operations">
        <input type="submit" value="Edit Bicycle" />
      </div>
    </form>
  </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
