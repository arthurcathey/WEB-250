<?php
require_once('../private/initialize.php');

if ($session->is_logged_in()) {
  redirect_to(url_for('/birds.php'));
}

$errors = [];
if (is_post_request()) {
  $args = $_POST['member'] ?? [];
  $args['member_type'] = 'm';
  $member = new Member($args);
  $result = $member->save();

  if ($result === true) {
    $session->message('Account created successfully. Please log in.');
    redirect_to(url_for('/login.php'));
  } else {
    $errors = $member->errors;
  }
} else {
  $member = new Member;
}

$page_title = 'Sign Up';
include(SHARED_PATH . '/public_header.php');
?>

<div class="signup-container">
  <h1>Create Your Account</h1>

  <?php echo display_errors($errors); ?>

  <form action="<?php echo url_for('/signup.php'); ?>" method="post" class="signup-form">
    <div class="form-group">
      <label for="first_name">First Name</label>
      <input id="first_name" type="text" name="member[first_name]" value="<?php echo h($member->first_name); ?>" required>
    </div>

    <div class="form-group">
      <label for="last_name">Last Name</label>
      <input id="last_name" type="text" name="member[last_name]" value="<?php echo h($member->last_name); ?>" required>
    </div>

    <div class="form-group">
      <label for="email">Email</label>
      <input id="email" type="email" name="member[email]" value="<?php echo h($member->email); ?>" required>
    </div>

    <div class="form-group">
      <label for="username">Username</label>
      <input id="username" type="text" name="member[username]" value="<?php echo h($member->username); ?>" required>
    </div>

    <div class="form-group">
      <label for="password">Password</label>
      <input id="password" type="password" name="member[password]" required>
    </div>

    <div class="form-group">
      <label for="confirm_password">Confirm Password</label>
      <input id="confirm_password" type="password" name="member[confirm_password]" required>
    </div>

    <div class="form-actions">
      <button type="submit">Sign Up</button>
    </div>
  </form>

  <p class="login-prompt">
    Already have an account? <a href="<?php echo url_for('/login.php'); ?>">Log in</a>.
  </p>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
