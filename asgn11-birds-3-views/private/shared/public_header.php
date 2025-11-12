<!doctype html>

<html lang="en">

<head>
  <title>WNC Birds <?php if (isset($page_title)) {
                      echo '- ' . h($page_title);
                    } ?></title>
  <meta charset="utf-8">
  <link rel="stylesheet" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />

</head>

<body>

  <header>
    <h1>
      <a href="<?php echo url_for('/birds.php'); ?>">
        WNC Birds
      </a>
    </h1>
  </header>
</body>

</html>
