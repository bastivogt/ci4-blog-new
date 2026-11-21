<?php echo $this->extend('layouts/admin/base'); ?>
<?php echo $this->section('title'); ?>
    <?php echo esc($title); ?>
<?php echo $this->endSection(); ?>
<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<?php echo form_open(route_to('admin.account.update')); ?>
    <!-- bootstrap form -->
    <div class="mb-3">
        <label for="name" class="form-label">First Name</label>
        <input type="text" class="form-control" id="name" name="first_name" value="<?php echo set_value('first_name', esc($user->first_name)); ?>">
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Last Name</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name', esc($user->last_name)); ?>">
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username', esc($user->username)); ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email', esc($user->email)); ?>">
    </div>
    <button type="submit" class="btn btn-primary">Update Account</button>
<?php echo form_close(); ?>
<?php echo $this->endSection(); ?>