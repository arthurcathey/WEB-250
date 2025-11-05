<?php
require_once('../private/initialize.php');

require_login();

$page_title = 'About';
include(SHARED_PATH . '/public_header.php');
?>

<h2>About</h2>
<p>This site lists some of the common birds of Western NC.</p>

<a href="<?php echo url_for('/index.php'); ?>">Back to List</a>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
