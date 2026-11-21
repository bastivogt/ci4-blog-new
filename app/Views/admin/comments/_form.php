    <!-- bootstrap form -->
    <div class="mb-3">
        <label for="post_id" class="form-label">Post</label>
        <select name="post_id" id="post_id" class="form-select">
            <?php foreach ($posts as $post): ?>
                <option value="<?= $post->id ?>" <?= set_select('post_id', $post->id) ?>><?= $post->title ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Author</label>
        <input type="text" name="author" id="author" class="form-control" value="<?= set_value('author', $comment['author'] ?? '') ?>">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" id="content" class="form-control"><?= set_value('content', $comment['content'] ?? '') ?></textarea>
    </div>
    <div class="mb-3">
        <input type="hidden" name="is_published" value="0">
        <input type="checkbox" name="is_published" id="is_published" value="1" <?= set_checkbox('is_published', '1', isset($comment['is_published']) && $comment['is_published'] == 1) ?>>
        <label for="is_published" class="form-label">Is Published</label>
    </div>