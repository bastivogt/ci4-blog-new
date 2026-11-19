<?php echo $this->extend('layouts/admin'); ?>

<?php echo $this->section('title'); ?><?php echo esc($title); ?><?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>

<?php if (session()->has('errors')): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach (session('errors') as $error): ?>
                <li><?php echo esc($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<?php echo form_open(route_to('admin.categories.store')); ?>
    <?php echo csrf_field(); ?>
    <?php echo $this->include('admin/categories/_form'); ?>
    <button type="submit" class="btn btn-primary">Create</button>
    <a href="<?php echo route_to('admin.categories.index'); ?>" class="btn btn-secondary">Back</a>
<?php echo form_close(); ?>
<?php echo $this->endSection(); ?>