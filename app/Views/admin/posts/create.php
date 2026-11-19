<?php echo $this->extend('layouts/admin/base'); ?>

<?php echo $this->section('title'); ?>Create Post<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
    <h1>Create Post</h1>
    <?php if(session()->has('errors')): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach(session('errors') as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
    <?php echo form_open(route_to('admin.posts.store'), ['novalidate' => 'novalidate']); ?>
        <?php echo $this->include('admin/posts/_form_post'); ?>
                <div class="mb-3">
                    <?php echo $this->include('admin/posts/_form_categories'); ?>
                </div>
        <button type="submit" class="btn btn-primary">Create</button>
        <a href="<?php echo route_to('admin.posts.index'); ?>" class="btn btn-secondary">Cancel</a>
    <?php echo form_close(); ?>
<?php echo $this->endSection(); ?>