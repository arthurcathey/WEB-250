<?php require_once('../private/initialize.php'); ?>

<?php require_login(); ?>

<?php
// Get requested ID
$id = $_GET['id'] ?? false;

if (!$id || !is_numeric($id)) {
  redirect_to(url_for('/birds.php'));
}

$bird = Bird::find_by_id($id);

if (!$bird) {
  redirect_to('birds.php');
}
?>

<?php $page_title = 'Detail: ' . h($bird->name()); ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">

  <a href="<?php echo url_for('/birds.php'); ?>">Back to Birds</a>

  <div id="page">

    <div class="detail">
      <dl>
        <dt>Name</dt>
        <dd><?php echo h($bird->name()); ?></dd>
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
        <dt>Conservation</dt>
        <dd><?php echo h($bird->conservation()); ?></dd>
      </dl>
      <dl>
        <dt>Backyard Tips</dt>
        <dd><?php echo h($bird->backyard_tips); ?></dd>
      </dl>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
