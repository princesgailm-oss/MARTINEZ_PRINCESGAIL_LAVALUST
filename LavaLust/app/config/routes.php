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

/* Product list */
$router->get('/products', 'ProductController::index');

/* Create product */
$router->get('/products/create', 'ProductController::create');

/* Save new product */
$router->post('/products/store', 'ProductController::store');

/* Edit product */
$router->get('/products/edit/(:num)', 'ProductController::edit/$1');

/* Update product */
$router->post('/products/update/(:num)', 'ProductController::update/$1');

/* Delete product */
$router->get('/products/delete/(:num)', 'ProductController::delete/$1');