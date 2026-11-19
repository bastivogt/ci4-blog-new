<?php echo $this->extend('layouts/admin/base'); ?>

<?php echo $this->section('title'); ?><?php echo esc($title); ?><?php echo $this->endSection(); ?>

<?php echo $this->section('content'); ?>
<h1><?php echo esc($title); ?></h1>
<p>Are you sure you want to delete the category "<?php echo esc($category->name); ?>"?</p>
<?php echo form_open(route_to('admin.categories.destroy', $category->id)); ?>
    <button type="submit" class="btn btn-danger">Delete</button>
    <a href="<?php echo route_to('admin.categories.index'); ?>" class="btn btn-secondary">Cancel</a>
<?php echo form_close(); ?>
<?php echo $this->endSection(); ?>