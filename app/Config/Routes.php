<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->post('api/login', 'Api\AuthController::login');

$routes->group('api', ['filter' => 'authFilter'], function ($routes) {
});
