<?php 
  require_once('../private/initialize.php'); 
  include(SHARED_PATH . '/public_header.php'); 
?>

  <ul>
    <li><a href="<?php echo url_for('/birds.php'); ?>">View Our List of WNC Birds</a></li>
    <li><a href="<?php echo url_for('/about.php'); ?>">About Us</a></li>
  </ul>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
