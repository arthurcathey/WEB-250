<?php

require_once('../../private/initialize.php');

require_admin_login();

if (is_post_request()) {

  // Create record using post parameters
  $args = $_POST['member'] ?? [];

  // Sanitize member_type: allow only 'g', 'm', 'a'
  $allowed_types = ['g', 'm', 'a'];
  if (!isset($args['member_type']) || !in_array($args['member_type'], $allowed_types)) {
    $args['member_type'] = 'm'; // default to 'member' if invalid or missing
  }

  $member = new Member($args);
  $result = $member->save();

  if ($result === true) {
    $new_id = $member->id;
    $session->message('The member was created successfully.');

    redirect_to(url_for('/members/show.php?id=' . $new_id));
    exit;
  } else {
    // Validation errors will be displayed below
  }
} else {
  // Display the form for GET requests
  $member = new Member;
}

?>

<?php $page_title = 'Create Member'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="member new">
    <h1>Create Member</h1>

    <?php echo display_errors($member->errors); ?>

    <form action="<?php echo url_for('/members/new.php'); ?>" method="post">

      <?php include('form_fields.php'); ?>

      <!-- Member Type select -->
      <dl>
        <dt><label for="member_type">Member Type</label></dt>
        <dd>
          <select name="member[member_type]" id="member_type" required>
            <option value="g" <?php echo $member->member_type === 'g' ? 'selected' : ''; ?>>Generic</option>
            <option value="m" <?php echo $member->member_type === 'm' ? 'selected' : ''; ?>>Member</option>
            <option value="a" <?php echo $member->member_type === 'a' ? 'selected' : ''; ?>>Admin</option>
          </select>
        </dd>
      </dl>

      <div id="operations">
        <input type="submit" value="Create Member" />
      </div>
    </form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
