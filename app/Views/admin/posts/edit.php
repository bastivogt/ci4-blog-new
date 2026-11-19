<?php echo $this->extend('layouts/admin'); ?>

<?php echo $this->section('title'); ?><?php echo esc($title); ?><?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<?php echo form_open(route_to('admin.posts.update', $post->id), ['novalidate' => 'novalidate']); ?>
    <?php echo $this->include('admin/posts/_form'); ?>
    <button type="submit" class="btn btn-primary">Update</button>
    <a href="<?php echo route_to('admin.posts.index'); ?>" class="btn btn-secondary">Cancel</a>
<?php echo form_close(); ?>
<?php echo $this->endSection(); ?>