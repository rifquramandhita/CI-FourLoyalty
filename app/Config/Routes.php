<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

$routes->post('api/login', 'Api\AuthController::login');

$routes->group('api', ['filter' => 'authFilter'], function ($routes) {
    //usersController
    $routes->get('users/me', 'Api\UsersController::me');
    $routes->get('users', 'Api\UsersController::index');
    $routes->post('users', 'Api\UsersController::create');
    $routes->get('users/(:any)', 'Api\UsersController::show/$1');
    $routes->patch('users/(:any)', 'Api\UsersController::update/$1');
    $routes->delete('users/(:any)', 'Api\UsersController::delete/$1');

    //couponsController
    $routes->get('coupons', 'Api\CouponsController::index');
    $routes->post('coupons', 'Api\CouponsController::create');
    $routes->get('coupons/(:num)', 'Api\CouponsController::show/$1');
    $routes->patch('coupons/(:num)', 'Api\CouponsController::update/$1');
    $routes->delete('coupons/(:num)', 'Api\CouponsController::delete/$1');

    //couponsController
    $routes->get('usercoupon', 'Api\UserCouponController::index');
    $routes->post('usercoupon', 'Api\UserCouponController::create');
    $routes->get('usercoupon/(:num)', 'Api\UserCouponController::show/$1');
    $routes->patch('usercoupon/(:num)', 'Api\UserCouponController::update/$1');
    $routes->delete('usercoupon/(:num)', 'Api\UserCouponController::delete/$1');
    $routes->get('usercoupon/getByUser/(:any)', 'Api\UserCouponController::getByUser/$1');
    $routes->get('usercoupon/getByUser/', 'Api\UserCouponController::getByUser');
});
