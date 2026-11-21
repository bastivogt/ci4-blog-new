<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
            Hello, <?php echo session()->get('current_user')['first_name']; ?>!
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route_to('admin.categories.index'); ?>">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route_to('admin.posts.index'); ?>">Posts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route_to('admin.comments.index'); ?>">Comments</a>
            </li>
            <?php if (session()->get('current_user')['is_admin'] == 1): ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo route_to('admin.users.index'); ?>">Users</a>
                </li>
             <?php endif; ?>
            <h5 class="mt-3">Account</h5>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route_to('admin.account.edit'); ?>">Edit Account</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo route_to('admin.account.editPassword'); ?>">Change Password</a>
            </li>
            <hr>
            
            <li class="nav-item">
                <?php echo form_open(route_to('admin.auth.logout')); ?>
                    <button type="submit" class="btn btn-primary">Logout</button>
                <?php echo form_close(); ?>
            </li>
           
        </ul>

    </div>
</div>