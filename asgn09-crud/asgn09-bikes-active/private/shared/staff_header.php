<?php
if (!isset($page_title)) {
  $page_title = 'Staff Area';

  if (!defined('WWW_ROOT')) {

    define('WWW_ROOT', '/WEB-250/asgn07-bike/asgn07-bikes-active/public');
  }

  if (!function_exists('url_for')) {
    function url_for($script_path)
    {
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
  <title>Chain Gang - <?php echo h($page_title); ?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
</head>

<body>
  <header>
    <h1>Chain Gang Staff Area</h1>
  </header>

  <navigation>
    <ul>
      <li><a href="<?php echo url_for('/staff/index.php'); ?>">Menu</a></li>
    </ul>
  </navigation>

  <?php echo display_session_message(); ?>
