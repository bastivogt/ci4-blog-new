<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?php echo esc(set_value('title', $post->title ?? '')); ?>" required>
</div>
<div class="mb-3">
    <label for="body" class="form-label">Body</label>
    <textarea class="form-control" id="body" name="body" rows="5" required><?php echo esc(set_value('body', $post->body ?? '')); ?></textarea>
</div>
<div class="mb-3">
    <label for="is_featured" class="form-label">Is Featured</label>
    <input type="checkbox" id="is_featured" name="is_featured" value="1" <?php echo set_checkbox('is_featured', '1', isset($post) && $post->is_featured); ?>>
</div>
