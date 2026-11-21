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