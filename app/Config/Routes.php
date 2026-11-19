<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Admin\PostController;
use App\Controllers\Admin\CategoryController;

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

// categories admin group   
$routes->group('admin/categories', function($routes) {
    $routes->get('', [CategoryController::class, 'index'], ['as' => 'admin.categories.index']);
    $routes->get('create', [CategoryController::class, 'create'], ['as' => 'admin.categories.create']);
    $routes->post('store', [CategoryController::class, 'store'], ['as' => 'admin.categories.store']);
    $routes->get('(:num)', [CategoryController::class, 'show'], ['as' => 'admin.categories.show']);
    $routes->get('(:num)/edit', [CategoryController::class, 'edit'], ['as' => 'admin.categories.edit']);
    $routes->post('(:num)/update', [CategoryController::class, 'update'], ['as' => 'admin.categories.update']);
    $routes->get('(:num)/delete', [CategoryController::class, 'delete'], ['as' => 'admin.categories.delete']);
    $routes->post('(:num)/destroy', [CategoryController::class, 'destroy'], ['as' => 'admin.categories.destroy']);
});
