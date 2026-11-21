<?php echo $this->extend('layouts/admin/base'); ?>
<?php echo $this->section('title'); ?>
    <?php echo esc($title); ?>
<?php echo $this->endSection(); ?>
<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<?php echo form_open(route_to('admin.account.updatePassword')); ?>
    <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input type="password" class="form-control" id="current_password" name="current_password">
    </div>
    <div class="mb-3">
        <label for="new_password" class="form-label">New Password</label>
        <input type="password" class="form-control" id="new_password" name="new_password">
    </div>
    <div class="mb-3">
        <label for="confirm_password" class="form-label">Confirm New Password</label>
        <input type="password" class="form-control" id="confirm_password" name="confirm_password">
    </div>
    <button type="submit" class="btn btn-primary">Change Password</button>
<?php echo form_close(); ?>
<?php echo $this->endSection(); ?>