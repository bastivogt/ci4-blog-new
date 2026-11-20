<?php echo $this->extend('layouts/admin/base'); ?>

<?php echo $this->section('title'); ?>
    <?php echo esc($title); ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<p><a href="<?php echo route_to('admin.users.create'); ?>" class="btn btn-primary">Create New User</a></p>
<?php if (!empty($users)) : ?>
    <div class="border rounded-3 overflow-auto">
        <table class="table w-100 table-striped table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>   
                    <th scope="col">Email</th>
                    <th scope="col">Admin</th>
                    <th scope="col">Active</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $index => $user) : ?>
                <tr>
                <td><?php echo esc($user->id); ?></td>
                <td><?php echo esc($user->first_name); ?></td>
                <td><?php echo esc($user->last_name); ?></td>
                <td><?php echo esc($user->username); ?></td>
                <td><?php echo esc($user->email); ?></td>
                <td><?php echo $user->is_admin ? 'Yes' : 'No'; ?></td>
                <td><?php echo $user->is_active ? 'Yes' : 'No'; ?></td> 
                <td><?php echo esc($user->created_at); ?></td>
                <td><?php echo esc($user->updated_at); ?></td>
                <td class="text-end text-nowrap">
                    <a href="<?php echo route_to('admin.users.edit', $user->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?php echo route_to('admin.users.delete', $user->id); ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?> 
    <p>No users found.</p>
<?php endif; ?>
<?php echo $this->endSection(); ?>

