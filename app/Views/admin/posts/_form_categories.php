<label class="form-label">Categories</label>
<?php foreach($categories as $category): ?>
    <div class="form-check">
        <input 
            <?php echo in_array($category->id, $selectedCategoryIds) ? 'checked' : ''; ?>
            class="form-check-input" type="checkbox" name="categories[]" value="<?php echo $category->id; ?>" id="check<?php echo $category->id; ?>">
        <label class="form-check-label" for="check<?php echo $category->id; ?>">
            <?php echo $category->name; ?>
        </label>
    </div>
<?php endforeach; ?>