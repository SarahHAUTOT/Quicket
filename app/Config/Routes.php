<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/userModel', 'Home::save');
$routes->get('/cron', 'Cron::index');

$routes->cli('cron/(:num)', 'Cron::index/$1');
