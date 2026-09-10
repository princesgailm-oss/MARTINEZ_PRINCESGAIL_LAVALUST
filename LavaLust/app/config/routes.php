<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/* Home */
$router->get('/', 'Welcome::index');

/* Auth */
$router->get('/login', 'AuthController::login');
$router->post('/login', 'AuthController::login');
$router->get('/logout', 'AuthController::logout');

/* Product CRUD */
$router->get('/products', 'ProductController::index');
$router->get('/products/create', 'ProductController::create');
$router->post('/products/store', 'ProductController::store');

/* Edit, Update, Delete Routes */
$router->get('/products/edit/(:num)', 'ProductController::edit');
$router->post('/products/update/(:num)', 'ProductController::update');
$router->get('/products/delete/(:num)', 'ProductController::delete');