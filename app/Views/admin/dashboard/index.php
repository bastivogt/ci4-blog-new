<?php echo $this->extend('layouts/admin/base'); ?>
<?php echo $this->section('title'); ?>Dashboard<?php echo $this->endSection(); ?>
<?php echo $this->section('content'); ?>

<h1>Dashboard</h1>
<p>Welcome, <?php echo $currentUser['first_name']; ?>!</p>

<?php echo $this->endSection(); ?>