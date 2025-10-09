<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../private/initialize.php');

$page_title = 'Inventory';
include(SHARED_PATH . '/public_header.php');
?>

<div id="main">
  <div id="page">
    <div class="intro">
      <img class="inset" src="<?php echo url_for('public/images/AdobeStock_18040381_xlarge.jpeg'); ?>" />
      <h2>Our Inventory of Used Bicycles</h2>
      <p>Choose the bike you love.</p>
      <p>We will deliver it to your door and let you try it before you buy it.</p>
    </div>

    <table id="inventory" border="1" cellpadding="5" cellspacing="0">
      <tr>
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Category</th>
        <th>Gender</th>
        <th>Color</th>
        <th>Price</th>
        <th>&nbsp;</th>
      </tr>

      <?php
      // Get bikes from the database only
      $bikes = Bicycle::find_all();

      if (!empty($bikes)) {
        foreach ($bikes as $bike) {
          echo "<tr>";
          echo "<td>" . h($bike->brand) . "</td>";
          echo "<td>" . h($bike->model) . "</td>";
          echo "<td>" . h($bike->year) . "</td>";
          echo "<td>" . h($bike->category) . "</td>";
          echo "<td>" . h($bike->gender) . "</td>";
          echo "<td>" . h($bike->color) . "</td>";
          echo "<td>$" . number_format($bike->price, 2) . "</td>";
          echo "<td>";
          if (!empty($bike->id)) {
            echo '<a href="detail.php?id=' . h(u($bike->id)) . '">View</a>';
          } else {
            echo 'No details';
          }
          echo "</td>";
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='10'>No bicycles found.</td></tr>";
      }
      ?>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
