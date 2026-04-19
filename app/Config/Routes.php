<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::index');
$routes->get('login', 'AuthController::index');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], static function (RouteCollection $routes): void {
	$routes->get('dashboard', 'DashboardController::index');
	$routes->post('items', 'DashboardController::store');
	$routes->post('items/(:num)/claim', 'DashboardController::claim/$1');
});
