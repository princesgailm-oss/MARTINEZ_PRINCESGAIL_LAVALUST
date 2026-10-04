<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * ------------------------------------------------------------------
 * LavaLust - URI ROUTING
 * ------------------------------------------------------------------
 */

/*
|------------------------------------------------------------------
| PRODUCT CRUD ROUTES
|------------------------------------------------------------------
*/

$router->get('/products', 'ProductController::index');

$router->get('/products/create', 'ProductController::create');

$router->post('/products/store', 'ProductController::store');

$router->get('/products/edit/{id}', 'ProductController::edit')
       ->where_number('id');

$router->post('/products/update/{id}', 'ProductController::update')
       ->where_number('id');

$router->get('/products/delete/{id}', 'ProductController::delete')
       ->where_number('id');


/*
|------------------------------------------------------------------
| AUTHENTICATION ROUTES
|------------------------------------------------------------------
*/

$router->get('/auth/login', 'AuthController::login');

$router->post('/auth/authenticate', 'AuthController::authenticate');

$router->get('/auth/logout', 'AuthController::logout');

/*
| API LOGIN
|------------------------------------------------------------------
*/

$router->post('/api/login', 'AuthController::authenticate');


/*
|------------------------------------------------------------------
| MIGRATION ROUTES
|------------------------------------------------------------------
*/

$router->get('create-migration/{migration_class}', 'MigrationController::create_migration');

$router->get('migrate', 'MigrationController::migrate');

$router->get('rollback', 'MigrationController::rollback');

$router->get('rollback-all', 'MigrationController::rollback_all');

$router->get('refresh', 'MigrationController::refresh');

$router->get('status', 'MigrationController::status');


/*
|------------------------------------------------------------------
| API PRODUCT ROUTES
|------------------------------------------------------------------
*/

$router->get('/api/products', 'ApiController::products');

$router->post('/api/products', 'ApiController::create_product');

$router->put('/api/products/{id}', 'ApiController::update_product');

$router->delete('/api/products/{id}', 'ApiController::delete_product');