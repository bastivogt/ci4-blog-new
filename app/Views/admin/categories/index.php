<?php echo $this->extend('layouts/base'); ?>

<?php echo $this->section('title'); ?><?php echo esc($title); ?><?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<a href="<?php echo route_to('admin.categories.create'); ?>" class="btn btn-primary mb-3">Create Category</a>
<?php if(!empty($categories)): ?>


            <div class="border rounded-3 overflow-auto">
                <table class="table w-100 table-striped table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Updated at</th>
                            <th scope="col" class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $index => $category) : ?>
                        <tr>
                        <td><?php echo esc($category->id); ?></td>
                        <td><?php echo esc($category->name); ?></td>
                        <td><?php echo esc($category->created_at); ?></td>
                        <td><?php echo esc($category->updated_at); ?></td>
                        <td class="text-end text-nowrap">
                            <a href="<?php echo route_to('admin.categories.edit', $category->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?php echo route_to('admin.categories.delete', $category->id); ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

<?php else: ?>
    <p>No categories found.</p>
<?php endif; ?>
<?php echo $this->endSection(); ?>