<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->post('api/login', 'Api\AuthController::login');

$routes->group('api', ['filter' => 'authFilter'], function ($routes) {
    $routes->get('users', 'Api\UsersController::index');
    $routes->post('users', 'Api\UsersController::create');
    $routes->get('users/(:any)', 'Api\UsersController::show/$1');
    $routes->patch('users/(:any)', 'Api\UsersController::update/$1');
    $routes->delete('users/(:any)', 'Api\UsersController::delete/$1');
});
