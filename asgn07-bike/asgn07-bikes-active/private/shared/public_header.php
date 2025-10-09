<!doctype html>

<html lang="en">

<head>
  <title>Bikes <?php if (isset($page_title)) {
                  echo '- ' . h($page_title);
                } ?></title>
  <meta charset="utf-8">
</head>

<body>

  <header>
    <h1>
      <a href="<?php echo url_for('/index.php'); ?>">
        Bikes
      </a>
    </h1>
  </header>
