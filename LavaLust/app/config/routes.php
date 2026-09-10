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

// Product list
$router->get('/products', 'ProductController::index');

// Show create form
$router->get('/products/create', 'ProductController::create');

// Save new product
$router->post('/products/store', 'ProductController::store');

// Show edit form
$router->get('/products/edit/{id}', 'ProductController::edit');

// Update product
$router->post('/products/update/{id}', 'ProductController::update');

// Delete product
$router->get('/products/delete/{id}', 'ProductController::delete');