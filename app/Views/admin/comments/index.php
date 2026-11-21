<?php echo $this->extend('layouts/admin/base'); ?>

<?php echo $this->section('title'); ?>
    <?php echo esc($title); ?>
<?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<p><a href="<?php echo route_to('admin.comments.create'); ?>" class="btn btn-primary">Create New Comment</a></p>
<?php if (!empty($comments)) : ?>
    <div class="border rounded-3 overflow-auto">
        <table class="table w-100 table-striped table-bordered mb-0">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Post ID</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Content</th>
                    <th scope="col">Author</th>
                    <th scope="col">Is Published</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Updated at</th>
                    <th scope="col" class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($comments as $index => $comment) : ?>
                <tr>
                <td><?php echo esc($comment['id']); ?></td>
                <td><?php echo esc($comment['post_id']); ?></td>
                <td><?php echo esc($comment['post_title']); ?></td>
                <td><?php echo esc($comment['content']); ?></td>
                <td><?php echo esc($comment['author']); ?></td>
                <td><?php echo esc($comment['is_published']) ? 'Yes' : 'No'; ?></td>
                <td><?php echo esc($comment['created_at']); ?></td>
                <td><?php echo esc($comment['updated_at']); ?></td>
                <td class="text-end text-nowrap">
                    <a href="<?php echo route_to('admin.comments.edit', $comment['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="<?php echo route_to('admin.comments.delete', $comment['id']); ?>" class="btn btn-sm btn-danger">Delete</a>
                </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?> 
    <p>No comments found.</p>
<?php endif; ?>
<?php echo $this->endSection(); ?>

