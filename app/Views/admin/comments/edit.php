<?= $this->extend('layouts/admin/base') ?>
<?php echo $this->section('title') ?>
    <?php echo $title; ?>
<?php echo $this->endSection() ?>
<?= $this->section('content') ?>

<h1><?php echo $title; ?></h1>

<?php echo form_open(route_to('admin.comments.update', $comment['id'])); ?> 
    <?php echo $this->include('admin/comments/_form') ?>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?= route_to('admin.comments.index') ?>" class="btn btn-secondary">Cancel</a>
<?php echo form_close(); ?>

<?= $this->endSection() ?>