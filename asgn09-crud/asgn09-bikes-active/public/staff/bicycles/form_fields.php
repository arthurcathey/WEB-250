<?php
// prevents this code from being loaded directly
if (!isset($bicycle)) {
  redirect_to(url_for('/staff/bicycles/index.php'));
}

// Use $bike array for form values
$bike = [
  'brand' => $bicycle->brand,
  'model' => $bicycle->model,
  'year' => $bicycle->year,
  'category' => $bicycle->category,
  'gender' => $bicycle->gender,
  'color' => $bicycle->color,
  'condition_id' => $bicycle->condition_id,
  'weight_kg' => $bicycle->weight_kg,
  'price' => $bicycle->price,
  'description' => $bicycle->description
];

// $errors array should come from $bicycle->errors if available
$errors = $bicycle->errors ?? [];
?>

<?php if (!empty($errors)) { ?>
  <div class="errors">
    <p>Please fix the following errors:</p>
    <ul>
      <?php foreach ($errors as $error) {
        echo "<li>" . h($error) . "</li>";
      } ?>
    </ul>
  </div>
<?php } ?>

<dl>
  <dt>Brand</dt>
  <dd><input type="text" name="bicycle[brand]" value="<?php echo h($bike['brand']); ?>" /></dd>
</dl>

<dl>
  <dt>Model</dt>
  <dd><input type="text" name="bicycle[model]" value="<?php echo h($bike['model']); ?>" /></dd>
</dl>

<dl>
  <dt>Year</dt>
  <dd>
    <select name="bicycle[year]">
      <option value=""></option>
      <?php $this_year = idate('Y'); ?>
      <?php for ($year = $this_year - 20; $year <= $this_year; $year++): ?>
        <option value="<?php echo $year; ?>" <?php if ($bike['year'] == $year) echo 'selected'; ?>>
          <?php echo $year; ?>
        </option>
      <?php endfor; ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>Category</dt>
  <dd>
    <select name="bicycle[category]">
      <option value=""></option>
      <?php foreach (Bicycle::CATEGORIES as $category): ?>
        <option value="<?php echo $category; ?>" <?php if ($bike['category'] == $category) echo 'selected'; ?>>
          <?php echo $category; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>Gender</dt>
  <dd>
    <select name="bicycle[gender]">
      <option value=""></option>
      <?php foreach (Bicycle::GENDERS as $gender): ?>
        <option value="<?php echo $gender; ?>" <?php if ($bike['gender'] == $gender) echo 'selected'; ?>>
          <?php echo $gender; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>Color</dt>
  <dd><input type="text" name="bicycle[color]" value="<?php echo h($bike['color']); ?>" /></dd>
</dl>

<dl>
  <dt>Condition</dt>
  <dd>
    <select name="bicycle[condition_id]">
      <option value=""></option>
      <?php foreach (Bicycle::CONDITION_OPTIONS as $cond_id => $cond_name): ?>
        <option value="<?php echo $cond_id; ?>" <?php if ($bike['condition_id'] == $cond_id) echo 'selected'; ?>>
          <?php echo $cond_name; ?>
        </option>
      <?php endforeach; ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>Weight (kg)</dt>
  <dd><input type="text" name="bicycle[weight_kg]" value="<?php echo h($bike['weight_kg']); ?>" /></dd>
</dl>

<dl>
  <dt>Price</dt>
  <dd>$ <input type="text" name="bicycle[price]" size="18" value="<?php echo h($bike['price']); ?>" /></dd>
</dl>

<dl>
  <dt>Description</dt>
  <dd><textarea name="bicycle[description]" rows="5" cols="50"><?php echo h($bike['description']); ?></textarea></dd>
</dl>
