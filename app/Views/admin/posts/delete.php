<?php echo $this->extend('layouts/admin'); ?>

<?php echo $this->section('title'); ?><?php echo esc($title); ?><?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<p>Are you sure you want to delete the post titled "<?php echo esc($post->title); ?>"?</p>
<form action="<?php echo route_to('admin.posts.destroy', $post->id); ?>" method="post">
    <?php echo form_open(route_to('admin.posts.destroy', $post->id), ['novalidate' => 'novalidate']); ?>
    <button type="submit" class="btn btn-danger">Delete</button>
    <a href="<?php echo route_to('admin.posts.show', $post->id); ?>" class="btn btn-secondary">Cancel</a>
<?php echo form_close(); ?>
<?php echo $this->endSection(); ?>