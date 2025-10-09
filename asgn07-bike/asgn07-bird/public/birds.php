<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('../private/initialize.php');
?>
<?php
require_once(PRIVATE_PATH . '/db_functions.php');

$page_title = 'Bird Inventory';
include(SHARED_PATH . '/public_header.php');
?>

<div id="main">
  <div id="page">
    <div class="intro">
      <h2>Bird Inventory</h2>
      <p>This is a short list -- start your birding!</p>
    </div>

    <table border="1" cellpadding="5" cellspacing="0">
      <tr>
        <th>Common Name</th>
        <th>Habitat</th>
        <th>Food</th>
        <th>Nest Placement</th>
        <th>Behavior</th>
        <th>Conservation Status</th>
        <th>Backyard Tips</th>
      </tr>

      <?php
      $birds = [];

      // Try to get birds from database
      $database = db_connect();
      $sql = "SELECT * FROM birds";
      $result = $database->query($sql);

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $birds[] = new Bird($row);
        }
        $result->free();
      }

      // If no database records, fall back to CSV
      if (empty($birds)) {
        $csv_file = PRIVATE_PATH . '/wnc-birds.csv';
        if (file_exists($csv_file)) {
          ParseCSV::$delimiter = "|";
          $parser = new ParseCSV($csv_file);
          $csv_data = $parser->parse();
          foreach ($csv_data as $args) {
            $birds[] = new Bird($args);
          }
        }
      }

      // Output birds
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
          echo "</tr>";
        }
      } else {
        echo "<tr><td colspan='7'>No bird data found.</td></tr>";
      }
      ?>
    </table>
  </div>
</div>

<?php include(SHARED_PATH . '/public_footer.php'); ?>
