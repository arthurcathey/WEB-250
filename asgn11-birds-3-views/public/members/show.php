<?php require_once('../../private/initialize.php'); ?>

<?php require_login(); ?>

<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$member = Member::find_by_id($id);

if ($member == false) {
  redirect_to(url_for('/members/index.php'));
}

?>

<?php $page_title = 'Member Profile: ' . h($member->full_name()); ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/members/index.php'); ?>">&laquo; Back to Members</a>

  <div class="member show">

    <h1>Member Profile: <?php echo h($member->full_name()); ?></h1>

    <div class="attributes">
      <dl>
        <dt>First Name</dt>
        <dd><?php echo h($member->first_name); ?></dd>
      </dl>
      <dl>
        <dt>Last Name</dt>
        <dd><?php echo h($member->last_name); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($member->email); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($member->username); ?></dd>
      </dl>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
