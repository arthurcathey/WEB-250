<?php
if (!isset($page_title)) {
  $page_title = 'Staff Area';
  if (!defined('WWW_ROOT')) {
    // Change this to match your project root relative to public folder
    define('WWW_ROOT', '/WEB-250/asgn07-bike/asgn07-birds-active/public');
  }

  // url_for function
  if (!function_exists('url_for')) {
    function url_for($script_path)
    {
      // ensure leading slash
      if ($script_path[0] != '/') {
        $script_path = '/' . $script_path;
      }
      return WWW_ROOT . $script_path;
    }
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Chain Gang - <?php echo h($page_title); ?></title>

  <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />

</head>

<body>
  <header>
    <h1>Chain Gang Staff Area</h1>
  </header>

  <nav>
    <ul>
      <?php if ($session->is_logged_in()) { ?>
        <li>User: <?php echo $session->username; ?></li>
        <li><a href="<?php echo url_for('/index.php'); ?>">Menu</a></li>
        <li><a href="<?php echo url_for('/logout.php'); ?>">Logout</a></li>
      <?php } ?>
    </ul>
  </nav>

  <?php echo display_session_message(); ?>

</body>

</html>
