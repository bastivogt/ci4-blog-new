<?php echo $this->extend('layouts/admin/base'); ?>

<?php echo $this->section('title'); ?>
    <?php echo esc($title); ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<?php if(session()->has('errors')): ?>
    <div class="alert alert-danger">
        <?php foreach(session('errors') as $error): ?>
            <p><?php echo esc($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
<?php echo form_open(route_to('admin.users.store')); ?>
    <?php echo $this->include('admin/users/_form'); ?>
    <button type="submit" class="btn btn-primary">Create User</button>
    <a href="<?php echo route_to('admin.users.index'); ?>" class="btn btn-secondary">Cancel</a>
<?php echo form_close(); ?>
<?php echo $this->endSection(); ?>