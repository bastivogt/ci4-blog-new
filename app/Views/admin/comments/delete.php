<?php echo $this->extend('layouts/admin/base') ?>
<?php echo $this->section('title') ?>
    Delete Comment
<?php echo $this->endSection() ?>
<?php echo $this->section('content') ?>

<h1>Delete Comment</h1>

<p>Are you sure you want to delete this comment?</p>

<?php echo form_open(route_to('admin.comments.destroy', $comment['id'])); ?>
    <button type="submit" class="btn btn-danger">Delete</button>
    <a href="<?= route_to('admin.comments.index') ?>" class="btn btn-secondary">Cancel</a>
</form>

<?php echo $this->endSection() ?>