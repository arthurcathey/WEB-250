<?php require_once('../private/initialize.php'); ?>

<?php $page_title = 'Inventory'; ?>
<?php include(SHARED_PATH . '/public_header.php'); ?>

<div id="main">
  <div id="page">
    <div class="intro">
      <img class="inset" src="<?php echo url_for('public/images/bicycle.php/AdobeStock_18040381_xlarge.jpeg'); ?>" />
      <h2>Our Inventory of Used Bicycles</h2>
      <p>Choose the bike you love.</p>
      <p>We will deliver it to your door and let you try it before you buy it.</p>
    </div>

    <table id="inventory">
      <tr>
        <th>Brand</th>
        <th>Model</th>
        <th>Year</th>
        <th>Category</th>
        <th>Gender</th>
        <th>Color</th>
        <th>Weight</th>
        <th>Condition</th>
        <th>Price</th>
      </tr>

      <?php
      $csv_file = PRIVATE_PATH . '/used_bicycles.csv';
      if (!file_exists($csv_file)) {
        echo "<tr><td colspan='9'>CSV file not found: {$csv_file}</td></tr>";
      } else {
        $parser = new ParseCSV($csv_file);
        $bike_array = $parser->parse();
        if ($bike_array === false) {
          echo "<tr><td colspan='9'>Error parsing CSV file.</td></tr>";
        } else {
          foreach ($bike_array as $args) {
            $bike = new Bicycle($args);
            echo "<tr>";
            echo "<td>" . h($bike->brand) . "</td>";
            echo "<td>" . h($bike->model) . "</td>";
            echo "<td>" . h($bike->year) . "</td>";
            echo "<td>" . h($bike->category) . "</td>";
            echo "<td>" . h($bike->gender) . "</td>";
            echo "<td>" . h($bike->color) . "</td>";
            echo "<td>" . h($bike->weight_kg()) . " / " . h($bike->weight_lbs()) . "</td>";
            echo "<td>" . h($bike->condition()) . "</td>";
            echo "<td>$" . number_format($bike->price, 2) . "</td>";
            echo "</tr>";
          }
        }
      }
      ?>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
