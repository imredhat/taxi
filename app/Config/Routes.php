<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'User::index');


// Autentication
$routes->get('auth', 'Auth::index');
$routes->post('auth/verify', 'Auth::verify');
$routes->get('auth/logout', 'Auth::logout');


$routes->get('/', 'Auth::index');
$routes->get('/Cars', 'Cars::Cars');
$routes->get('/Cars/(:any)', 'Cars::Cars/$1');
$routes->post('/Cars/(:any)', 'Cars::Cars/$1');

$routes->get('Brands', 'Cars::Brands');
$routes->get('Brands/(:any)', 'Cars::Brands/$1');
$routes->post('Brands/(:any)', 'Cars::Brands/$1');

$routes->get('/Cars/Drivers/(:any)', to: 'Cars::Drivers/$1');
$routes->post('/Cars/Drivers/(:any)', 'Cars::Drivers/$1');

// $routes->get('(:any)/RDI/(:any)', 'Cars::$1/RDI/$2');

$routes->get('RC/(:any)', to: 'Cars::RC/$1/$2');
$routes->get('RD/(:any)', to: 'Drivers::RD/$1/$2');






// Route for index function

// $routes->group('cars', ['namespace' => 'App\Controllers'], function ($routes) {
//     $routes->get('', 'Cars::index');
//     $routes->get('brands', 'Cars::Brands');
//     $routes->get('cars', 'Cars::Cars');
//     $routes->get('rdi/(:any)/(:num)', 'Cars::RDI/$1/$2');
// });




$routes->get('add-driver', 'Drivers::AddDriver');
$routes->post('add-driver', 'Drivers::AddDriverToDatabase');

$routes->get('all-drivers', 'Drivers::All');
$routes->get('all-drivers/(:any)', 'Drivers::All/$1');
$routes->post('all-drivers/(:any)', 'Drivers::All/$1');

$routes->post('OneStep', to: 'Drivers::OneStep');






$routes->post('Company/(:any)', to: 'User::Company/$1');
$routes->get('Company/(:any)', to: 'User::Company/$1');
$routes->get('Company', to: 'User::Company');


$routes->post('Contacts/(:any)', to: 'User::AllUser/$1');
$routes->get('Contacts/(:any)', to: 'User::AllUser/$1');
$routes->get('Contacts', to: 'User::AllUser');



// $routes->post(from: 'Service/(:any)', to: 'Service::AllServices/$1');
$routes->get('Service/(edit|read|success)/(:any)', to: 'Service::AllServices/$1');
$routes->get('Service', to: 'Service::index');
$routes->get('Service/Add', to: 'Service::AddService');


$routes->post('Service/GetDriverCarList', 'Service::GetDriverCarList');
$routes->post('Service/createOrder', 'Service::createOrder');




service('auth')->routes($routes);
