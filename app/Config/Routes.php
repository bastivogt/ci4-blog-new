<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Admin\PostController;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// posts admin group
$routes->group('admin/posts', function($routes) {
    $routes->get('', [PostController::class, 'index'], ['as' => 'admin.posts.index']);
    $routes->get('create', [PostController::class, 'create'], ['as' => 'admin.posts.create']);
    $routes->post('store', [PostController::class, 'store'], ['as' => 'admin.posts.store']);
    $routes->get('(:num)', [PostController::class, 'show'], ['as' => 'admin.posts.show']);
    $routes->get('(:num)/edit', [PostController::class, 'edit'], ['as' => 'admin.posts.edit']);
    $routes->post('(:num)/update', [PostController::class, 'update'], ['as' => 'admin.posts.update']);
    $routes->get('(:num)/delete', [PostController::class, 'delete'], ['as' => 'admin.posts.delete']);
    $routes->post('(:num)/destroy', [PostController::class, 'destroy'], ['as' => 'admin.posts.destroy']);
});
