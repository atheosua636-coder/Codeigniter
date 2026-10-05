<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Pages::index');
$routes->get('about', 'Pages::about');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::attemptLogin');
$routes->post('logout', 'Auth::logout');

$routes->get('customers', 'Customers::index', ['filter' => 'auth']);
$routes->get('customers/new', 'Customers::newForm', ['filter' => 'auth']);
$routes->post('customers/create', 'Customers::create', ['filter' => 'auth']);
$routes->get('customers/(:num)/edit', 'Customers::edit/$1', ['filter' => 'auth']);
$routes->post('customers/(:num)/update', 'Customers::update/$1', ['filter' => 'auth']);
$routes->get('users', 'Users::index', ['filter' => 'auth']);
$routes->get('users/new', 'Users::newForm', ['filter' => 'auth']);
$routes->post('users/create', 'Users::create', ['filter' => 'auth']);
$routes->get('users/(:num)/edit', 'Users::edit/$1', ['filter' => 'auth']);
$routes->post('users/(:num)/update', 'Users::update/$1', ['filter' => 'auth']);

// Tasks for Today activity, nested under the POS project.
$routes->get('tasks-today', 'TasksToday::index');
$routes->get('tasks-today/list', 'Tasks::index');
$routes->get('tasks-today/profile', 'Profile::index');
$routes->get('tasks-today/about', 'TaskPages::about');
