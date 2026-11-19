<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Navigation</h5>
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
                <?php echo form_open(route_to('admin.auth.logout')); ?>
                    <button type="submit" class="nav-link btn btn-link" style="padding: 0; border: none; background: none;">Logout</button>
                <?php echo form_close(); ?>
            </li>
        </ul>

    </div>
</div>