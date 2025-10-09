<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../private/initialize.php');

$page_title = 'Bird Inventory';
include(SHARED_PATH . '/public_header.php');
?>

<div id="main">
  <div id="page">
    <div class="intro">
      <img class="inset" src="<?php echo url_for('public/images/AdobeStock_18040381_xlarge.jpeg'); ?>" />
      <h2>Our Bird Inventory</h2>
      <p>Check out the birds we've cataloged. Click "View" for more details.</p>
    </div>

    <table id="inventory" border="1" cellpadding="5" cellspacing="0">
      <tr>
        <th>Name</th>
        <th>Habitat</th>
        <th>Food</th>
        <th>Nest Placement</th>
        <th>Behavior</th>
        <th>Conservation</th>
        <th>Backyard Tips</th>
        <th>&nbsp;</th>
      </tr>

      <?php
      // Fetch birds from the database using Active Record
      $birds = Bird::find_all();

      if (!empty($birds)) {
        foreach ($birds as $bird) {
          echo "<tr>";
          echo "<td>" . h($bird->common_name) . "</td>";
          echo "<td>" . h($bird->habitat) . "</td>";
          echo "<td>" . h($bird->food) . "</td>";
          echo "<td>" . h($bird->nest_placement) . "</td>";
          echo "<td>" . h($bird->behavior) . "</td>";
          echo "<td>" . h($bird->conservation()) . "</td>";
          echo "<td>" . h($bird->backyard_tips) . "</td>";
          echo "<td>";
          if (!empty($bird->id)) {
            echo '<a href="show.php?id=' . h(u($bird->id)) . '">View</a>';
          } else {
            echo 'No details';
          }
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='8'>No birds found.</td></tr>";
      }
      ?>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
