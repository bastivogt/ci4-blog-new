<div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo set_value('first_name', $user->first_name ?? ''); ?>">
</div>
<div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo set_value('last_name', $user->last_name ?? ''); ?>">
</div>
<div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username', $user->username ?? ''); ?>">
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email', $user->email ?? ''); ?>">
</div>
<div class="mb-3">
    <input type="hidden" name="is_admin" value="0">
    <input type="checkbox" class="form-check-input" id="is_admin" name="is_admin" value="1" <?php echo set_checkbox('is_admin', '1', $user->is_admin); ?>>
    <label class="form-check-label" for="is_admin">Admin</label>
</div>
<div class="mb-3">
    <input type="hidden" name="is_active" value="0">
    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" <?php echo set_checkbox('is_active', '1', $user->is_active); ?>>
    <label class="form-check-label" for="is_active">Active</label>
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
</div>
<div class="mb-3">
    <label for="password_confirm" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="password_confirm" name="password_confirm">
</div>