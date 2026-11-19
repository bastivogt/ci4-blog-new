<?php echo $this->extend('layouts/base'); ?>
    
<?php echo $this->section('title'); ?><?php echo esc($title); ?><?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<p><?php echo esc($post->body); ?></p>
<hr>
<a href="<?php echo route_to('admin.posts.index'); ?>" class="btn btn-secondary">Back to Posts</a>
<a href="<?php echo route_to('admin.posts.edit', $post->id); ?>" class="btn btn-primary">Edit Post</a>  
<a href="<?php echo route_to('admin.posts.delete', $post->id); ?>" class="btn btn-danger">Delete Post</a>

<?php echo $this->endSection(); ?>