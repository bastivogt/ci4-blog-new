<div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" value="<?php echo esc(set_value('title', $post->title ?? '')); ?>" required>
</div>
<div class="mb-3">
    <label for="body" class="form-label">Body</label>
    <textarea class="form-control" id="body" name="body" rows="5" required><?php echo esc(set_value('body', $post->body ?? '')); ?></textarea>
</div>
<div class="mb-3">
    <input type="hidden" name="is_featured" value="0">
    <input type="checkbox" id="is_featured" name="is_featured" value="1" <?php echo set_checkbox('is_featured', '1', isset($post) && $post->is_featured); ?>>
    <label for="is_featured" class="form-label">Is Featured</label>
</div>
<div class="mb-3">
    <input type="hidden" name="is_published" value="0">
    <input type="checkbox" id="is_published" name="is_published" value="1" <?php echo set_checkbox('is_published', '1', isset($post) && $post->is_published); ?>>
    <label for="is_published" class="form-label">Is Published</label>
</div>
<div class="mb-3">
    <input type="hidden" name="allow_comments" value="0">
    <input type="checkbox" id="allow_comments" name="allow_comments" value="1" <?php echo set_checkbox('allow_comments', '1', isset($post) && $post->allow_comments); ?>>
    <label for="allow_comments" class="form-label">Allow Comments</label>
</div>

<?php if (isset($users) && session()->get('current_user')['is_admin']): ?>
<div class="mb-3">
    <label for="user_id" class="form-label">Author</label>
    <select class="form-select" id="user_id" name="user_id" required>
        <?php foreach ($users as $user): ?>
            <option value="<?php echo esc($user->id); ?>" <?php echo set_select('user_id', $user->id, isset($post) && $post->user_id == $user->id); ?>>
                <?php echo esc($user->username); ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>
<?php endif; ?>

