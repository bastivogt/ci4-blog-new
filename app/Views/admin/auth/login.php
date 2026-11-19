<?php echo $this->extend('layouts/admin/login'); ?>

<?php echo $this->section('content'); ?>

   
<?php if (session()->has('errors')): ?>

    <div class="alert alert-danger mb-3" style="max-width: 400px; margin: 0 auto;">
        <?php foreach (session('errors') as $error): ?>
            <p><?php echo $error; ?></p>
        <?php endforeach; ?>
    </div>

<?php endif; ?> 

<div class="card" style="max-width: 400px; margin: 0 auto;">
    <div class="card-body">
        <h1><?php echo $title; ?></h1>

        <?php echo form_open(route_to('admin.auth.login')); ?>
            <!-- Login Form Botstrap Styled -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="form-control" 
                    value="<?php echo set_value('email'); ?>" 
                    required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php echo $this->endSection(); ?>