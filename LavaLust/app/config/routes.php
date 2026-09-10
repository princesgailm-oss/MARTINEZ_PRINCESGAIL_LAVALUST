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

/* Edit Product - IPASA ANG $1 SA DULO */
$router->get('/products/edit/(:num)', 'ProductController::edit/$1');

/* Update Product - IPASA ANG $1 SA DULO */
$router->post('/products/update/(:num)', 'ProductController::update/$1');

/* Delete Product - IPASA ANG $1 SA DULO */
$router->get('/products/delete/(:num)', 'ProductController::delete/$1');