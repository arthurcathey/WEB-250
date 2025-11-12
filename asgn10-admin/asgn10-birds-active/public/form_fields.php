<?php
// Prevent direct access
if (!isset($bird)) {
  redirect_to(url_for('/index.php'));
}
?>

<?php if (!empty($bird->errors)) : ?>
  <div class="errors">
    <ul>
      <?php foreach ($bird->errors as $error) : ?>
        <li><?php echo h($error); ?></li>
      <?php endforeach; ?>
    </ul>
  </div>
<?php endif; ?>

<dl>
  <dt>Common Name</dt>
  <dd>
    <input type="text" name="bird[common_name]" value="<?php echo h($bird->common_name ?? ''); ?>" required />
  </dd>
</dl>

<dl>
  <dt>Habitat</dt>
  <dd>
    <input type="text" name="bird[habitat]" value="<?php echo h($bird->habitat ?? ''); ?>" required />
  </dd>
</dl>

<dl>
  <dt>Food</dt>
  <dd>
    <input type="text" name="bird[food]" value="<?php echo h($bird->food ?? ''); ?>" required />
  </dd>
</dl>

<dl>
  <dt>Behavior</dt>
  <dd>
    <input type="text" name="bird[behavior]" value="<?php echo h($bird->behavior ?? ''); ?>" />
  </dd>
</dl>

<dl>
  <dt>Conservation</dt>
  <dd>
    <select name="bird[conservation_id]" required>
      <option value=""></option>
      <?php foreach (Bird::CONSERVATION_OPTIONS as $id => $name) : ?>
        <option value="<?php echo h($id); ?>" <?php if (($bird->conservation_id ?? '') == $id) echo 'selected'; ?>>
          <?php echo h($name); ?>
        </option>
      <?php endforeach; ?>
    </select>
  </dd>
</dl>

<dl>
  <dt>Backyard Tips</dt>
  <dd>
    <textarea name="bird[backyard_tips]" rows="5" cols="50"><?php echo h($bird->backyard_tips ?? ''); ?></textarea>
  </dd>
</dl>

<hr>

<?php if (!empty($bird->id)) : ?>
  <h3>Existing Images</h3>
  <?php $images = $bird->images() ?? []; ?>
  <?php if (!empty($images)) : ?>
    <ul style="list-style:none; padding-left:0;">
      <?php foreach ($images as $image) : ?>
        <li style="margin-bottom:10px;">
          <img src="<?php echo url_for('/uploads/' . h($image->file_name)); ?>" alt="" width="120" style="vertical-align:middle;">
          <label>
            <input type="checkbox" name="delete_images[]" value="<?php echo h($image->id); ?>"> Delete
          </label>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else : ?>
    <p>No images currently uploaded for this bird.</p>
  <?php endif; ?>
<?php endif; ?>

<dl>
  <dt>Upload New Image</dt>
  <dd>
    <input type="file" name="bird_image" />
  </dd>
</dl>
