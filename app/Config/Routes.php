<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/userModel', 'Home::save');

$routes->cli('cron/(:num)', 'Cron::index/$1');
$routes->cli('tokens/(:num)', 'Cron::tokens/$1');
