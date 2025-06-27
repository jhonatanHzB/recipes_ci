<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rutas del Frontend
$routes->group('', ['namespace' => 'App\Modules\Front\Controllers'], static function ($routes) {
    require __DIR__ . '/Routes/FrontRoutes.php';
});

// Rutas del Backend
$routes->group('admin', ['namespace' => 'App\Modules\Admin\Controllers'], static function ($routes) {
    require __DIR__ . '/Routes/AdminRoutes.php';
});

service('auth')->routes($routes);