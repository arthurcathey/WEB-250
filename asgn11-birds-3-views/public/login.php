<?php
require_once('../private/initialize.php');

// If already logged in, redirect based on user type
if ($session->is_logged_in()) {
  $member_type = $session->get_member_type();

  if ($member_type === 'a') {
    redirect_to(url_for('/members/index.php')); // Admin Dashboard
  } elseif ($member_type === 'm') {
    redirect_to(url_for('/birds.php')); // Member Data CRUD
  } else {
    redirect_to(url_for('/members/index.php')); // Fallback
  }
}

$errors = [];
$username = '';
$password = '';

if (is_post_request()) {
  $username = trim($_POST['username'] ?? '');
  $password = $_POST['password'] ?? '';

  // Basic validation
  if (is_blank($username)) {
    $errors[] = "Username cannot be blank.";
  }
  if (is_blank($password)) {
    $errors[] = "Password cannot be blank.";
  }

  if (empty($errors)) {
    $member = Member::find_by_username($username);

    if ($member && $member->verify_password($password)) {
      // Log the user in
      $session->login($member);


      // Redirect based on user type
      if ($member->member_type === 'a') {
        redirect_to(url_for('/members/index.php')); // Admin
      } elseif ($member->member_type === 'm') {
        redirect_to(url_for('/members/index.php')); // Regular member
      } else {
        redirect_to(url_for('/members/index.php')); // Unknown type fallback
      }
    } else {
      $errors[] = "Log in was unsuccessful. Please check your username and password.";
    }
  }
}

$page_title = 'Log in';
include(SHARED_PATH . '/staff_header.php');
?>

<div id="content">
  <h1>Log In</h1>

  <?php echo display_errors($errors); ?>

  <form action="<?php echo url_for('/login.php'); ?>" method="post">
    <dl>
      <dt>Username</dt>
      <dd><input type="text" name="username" value="<?php echo h($username); ?>" /></dd>
    </dl>

    <dl>
      <dt>Password</dt>
      <dd><input type="password" name="password" /></dd>
    </dl>

    <div id="operations">
      <input type="submit" name="submit" value="Log In" />
    </div>
  </form>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
