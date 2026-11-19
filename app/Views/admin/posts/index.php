<?php echo $this->extend('layouts/admin/base'); ?>

<?php echo $this->section('title'); ?>Posts<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<p><a href="<?php echo route_to('admin.posts.create'); ?>" class="btn btn-primary">Create New Post</a></p>
<?php if (!empty($posts)) : ?>
    <div class="border rounded-3 overflow-auto">
        <table class="table w-100 table-striped table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Excerpt</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $index => $post) : ?>
                <tr>
                <td><?php echo esc($post->id); ?></td>
                <td><?php echo esc($post->title); ?></td>
                <td><?php echo esc($post->excerpt); ?></td>
                <td><?php echo esc($post->created_at); ?></td>
                <td><?php echo esc($post->updated_at); ?></td>
                <td class="text-end text-nowrap">
                    <a href="<?php echo route_to('admin.posts.edit', $post->id); ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?php echo route_to('admin.posts.delete', $post->id); ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?> 
    <p>No posts found.</p>
<?php endif; ?>
<?php echo $this->endSection(); ?>

