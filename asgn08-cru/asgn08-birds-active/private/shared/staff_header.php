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

  <link rel="stylesheet" media="all" href="stylesheets/staff.css" />
</head>

<body>
  <header>
    <h1>Chain Gang Staff Area</h1>
  </header>

  <nav>
    <ul>
      <li><a href="<?php echo url_for('/index.php'); ?>">Menu</a></li>
    </ul>
  </nav>
</body>

</html>
