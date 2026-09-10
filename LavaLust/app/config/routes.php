<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

$router->get('/', 'Welcome::index');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

$router->get('/login', 'AuthController::login');
$router->post('/login', 'AuthController::login');
$router->get('/logout', 'AuthController::logout');


/*
|--------------------------------------------------------------------------
| PRODUCT CRUD
|--------------------------------------------------------------------------
*/

/* Product List */
$router->get('/products', 'ProductController::index');

/* Add Product Page */
$router->get('/products/create', 'ProductController::create');

/* Save Product */
$router->post('/products/store', 'ProductController::store');

/* Edit Product */
$router->get('/products/edit/(:any)', 'ProductController::edit/$1');

/* Update Product */
$router->post('/products/update/(:any)', 'ProductController::update/$1');

/* Delete Product */
$router->get('/products/delete/(:any)', 'ProductController::delete/$1');