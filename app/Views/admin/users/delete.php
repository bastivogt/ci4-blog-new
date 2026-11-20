<?= $this->extend('layouts/admin/base') ?>
<?= $this->section('content') ?>

<h1>Delete User</h1>

<p>Are you sure you want to delete this user?</p>

<?php echo form_open(route_to('admin.users.destroy', $user->id)); ?>
    <button type="submit" class="btn btn-danger">Delete</button>
    <a href="<?= route_to('admin.users.index') ?>" class="btn btn-secondary">Cancel</a>
<?php echo form_close(); ?>

<?= $this->endSection() ?>