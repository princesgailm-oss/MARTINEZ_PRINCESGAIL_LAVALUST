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
$router->post('/login', 'AuthController::authenticate');
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
$router->get('/products/edit/(:num)', 'ProductController::edit/$1');
// Update product (Updated with correct route parameters)
$router->post('/products/update/(:num)', 'ProductController::update/$1');
// Delete product (Updated with correct route parameters)
$router->get('/products/delete/(:num)', 'ProductController::delete/$1');

// Migration Routes
$router->get('create-migration/{migration_class}', 'MigrationController::create_migration');
$router->get('migrate', 'MigrationController::migrate');
$router->get('rollback', 'MigrationController::rollback');
$router->get('rollback-all', 'MigrationController::rollback_all');
$router->get('refresh', 'MigrationController::refresh');
$router->get('status', 'MigrationController::status');

// API Routes
$router->get('/api/products', 'ApiController::products');
$router->post('/api/products', 'ApiController::create_product');
$router->put('/api/products/{id}', 'ApiController::update_product');
$router->delete('/api/products/{id}', 'ApiController::delete_product');