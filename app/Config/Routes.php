<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Admin\PostController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\DashboardController;    
use App\Controllers\Admin\UserController;


/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

//$routes->addRedirect('/admin', 'admin/auth/login');
$routes->get('admin', function() {
    return redirect()->route('admin.auth.login.form');
});

$routes->group('admin', ['filter' => 'auth'], function($routes) {
    // dashboard
    $routes->group('dashboard', ['filter' => 'auth'], function ($routes) {
        $routes->get('', [DashboardController::class, 'index'], ['as' => 'admin.dashboard.index']);
    });

    // posts admin group
    $routes->group('posts', function($routes) {
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
    $routes->group('categories', function($routes) {
        $routes->get('', [CategoryController::class, 'index'], ['as' => 'admin.categories.index']);
        $routes->get('create', [CategoryController::class, 'create'], ['as' => 'admin.categories.create']);
        $routes->post('store', [CategoryController::class, 'store'], ['as' => 'admin.categories.store']);
        $routes->get('(:num)', [CategoryController::class, 'show'], ['as' => 'admin.categories.show']);
        $routes->get('(:num)/edit', [CategoryController::class, 'edit'], ['as' => 'admin.categories.edit']);
        $routes->post('(:num)/update', [CategoryController::class, 'update'], ['as' => 'admin.categories.update']);
        $routes->get('(:num)/delete', [CategoryController::class, 'delete'], ['as' => 'admin.categories.delete']);
        $routes->post('(:num)/destroy', [CategoryController::class, 'destroy'], ['as' => 'admin.categories.destroy']);
    });



    $routes->group('auth', function($routes) {
        $routes->post('logout', [AuthController::class, 'logout'], ['as' => 'admin.auth.logout']);
        $routes->get('register', [AuthController::class, 'showRegisterForm'], ['as' => 'admin.auth.register.form']);
        $routes->post('register', [AuthController::class, 'register'], ['as' => 'admin.auth.register']);
    });

    $routes->group('users', function($routes) {
        $routes->get('', [UserController::class, 'index'], ['as' => 'admin.users.index', 'filter' => 'admin']);
        $routes->get('create', [UserController::class, 'create'], ['as' => 'admin.users.create']);
        $routes->post('store', [UserController::class, 'store'], ['as' => 'admin.users.store']);
        $routes->get('(:num)/edit', [UserController::class, 'edit'], ['as' => 'admin.users.edit']);
        $routes->post('(:num)/update', [UserController::class, 'update'], ['as' => 'admin.users.update']);
        $routes->get('(:num)/delete', [UserController::class, 'delete'], ['as' => 'admin.users.delete']);
        $routes->post('(:num)/destroy', [UserController::class, 'destroy'], ['as' => 'admin.users.destroy']);   
    });


});

$routes->get('admin/auth/login', [AuthController::class, 'showLoginForm'], ['as' => 'admin.auth.login.form']);
$routes->post('admin/auth/login', [AuthController::class, 'login'], ['as' => 'admin.auth.login']);

// // admin dashboard route
// $routes->group('admin/dashboard', ['filter' => 'auth'], function($routes) {
//     $routes->get('', [DashboardController::class, 'index'], ['as' => 'admin.dashboard.index']);
// });
// // posts admin group
// $routes->group('admin/posts',['filter' => 'auth'], function($routes) {
//     $routes->get('', [PostController::class, 'index'], ['as' => 'admin.posts.index']);
//     $routes->get('create', [PostController::class, 'create'], ['as' => 'admin.posts.create']);
//     $routes->post('store', [PostController::class, 'store'], ['as' => 'admin.posts.store']);
//     $routes->get('(:num)', [PostController::class, 'show'], ['as' => 'admin.posts.show']);
//     $routes->get('(:num)/edit', [PostController::class, 'edit'], ['as' => 'admin.posts.edit']);
//     $routes->post('(:num)/update', [PostController::class, 'update'], ['as' => 'admin.posts.update']);
//     $routes->get('(:num)/delete', [PostController::class, 'delete'], ['as' => 'admin.posts.delete']);
//     $routes->post('(:num)/destroy', [PostController::class, 'destroy'], ['as' => 'admin.posts.destroy']);
// });

// // categories admin group   
// $routes->group('admin/categories', ['filter' => 'auth'], function($routes) {
//     $routes->get('', [CategoryController::class, 'index'], ['as' => 'admin.categories.index']);
//     $routes->get('create', [CategoryController::class, 'create'], ['as' => 'admin.categories.create']);
//     $routes->post('store', [CategoryController::class, 'store'], ['as' => 'admin.categories.store']);
//     $routes->get('(:num)', [CategoryController::class, 'show'], ['as' => 'admin.categories.show']);
//     $routes->get('(:num)/edit', [CategoryController::class, 'edit'], ['as' => 'admin.categories.edit']);
//     $routes->post('(:num)/update', [CategoryController::class, 'update'], ['as' => 'admin.categories.update']);
//     $routes->get('(:num)/delete', [CategoryController::class, 'delete'], ['as' => 'admin.categories.delete']);
//     $routes->post('(:num)/destroy', [CategoryController::class, 'destroy'], ['as' => 'admin.categories.destroy']);
// });

// // auth group
// $routes->get('admin/auth/login', [AuthController::class, 'showLoginForm'], ['as' => 'admin.auth.login.form']);
// $routes->post('admin/auth/login', [AuthController::class, 'login'], ['as' => 'admin.auth.login']);
// $routes->group('admin/auth', ['filter' => 'auth'], function($routes) {
//     $routes->post('logout', [AuthController::class, 'logout'], ['as' => 'admin.auth.logout']);
//     $routes->get('register', [AuthController::class, 'showRegisterForm'], ['as' => 'admin.auth.register.form']);
//     $routes->post('register', [AuthController::class, 'register'], ['as' => 'admin.auth.register']);
// });
