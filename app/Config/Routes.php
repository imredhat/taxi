<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'User::index');


// Autentication
$routes->get('auth', 'Auth::index');
$routes->get('auth/login', 'Auth::index');
$routes->post('auth/verify', 'Auth::verify');
$routes->get('auth/logout', 'Auth::logout');


// $routes->get('/', 'Auth::index');
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
$routes->add('DriverCard/(:any)', 'Drivers::DriverCard/$1');
$routes->add('PrintC/DriverCard(:any)', 'PrintC::DriverCard/$1');

$routes->add('UserCard(:any)', 'User::UserCard/$1');

$routes->post('OneStep', to: 'Drivers::OneStep');





$routes->post('Company/(:any)', to: 'User::Company/$1');
$routes->get('Company/(:any)', to: 'User::Company/$1');
$routes->get('Company', to: 'User::Company');


$routes->post('Contacts/(:any)', to: 'User::AllUser/$1');
$routes->get('Contacts/(:any)', to: 'User::AllUser/$1');
$routes->get('Contacts', to: 'User::AllUser');



// $routes->post(from: 'Service/(:any)', to: 'Service::AllServices/$1');
$routes->get('Service/(edit|read|success|update)/(:any)', to: 'Service::AllServices/$1');
$routes->get('Service', to: 'Service::index');
$routes->get('Service/Add', to: 'Service::AddService');


$routes->post('Service/GetDriverCarList', 'Service::GetDriverCarList');
$routes->post('Service/createOrder', 'Service::createOrder');




$routes->get('Option/Other', 'Option::index');
$routes->get('Option/Packages', 'Option::Packages');
$routes->get('Option/Packages/(edit|read|success|update)/(:any)', to: 'Option::Packages/$1');


$routes->post('Option/saveSettings', 'Option::saveSettings');


$routes->get('Trips', 'Trips::index');
$routes->get('Trips/New', 'Trips::NewTrip');
$routes->get('Trips/getJSON', 'Trips::getJSON');
$routes->get('Trips/GetTrip(:any)', 'Trips::GetTrip/$1');
$routes->post('Trips/CreateNotif(:any)', 'Trips::CreateNotif/$1');
$routes->get('Trips/CreateNotif(:any)', 'Trips::CreateNotif/$1');
$routes->post('Trips/UpdateStatus(:any)', 'Trips::UpdateStatus/$1');
$routes->post('Trips/Dwt(:any)', 'Trips::Dwt/$1');

$routes->get('Trips/AddTrip', 'Trips::AddTrip');
$routes->post('Trips/AddTrip', 'Trips::AddTrip');

$routes->get('Trips/FindID', 'Trips::FindID');
$routes->post('Trips/FindID', 'Trips::FindID');

$routes->get('Trips/Step2(:any)', 'Trips::Step2/$1');
$routes->add('TripsDetail/(:any)', 'Trips::Detail/$1');

// ______________________________________ Request _______________________________________

$routes->add('Request/imReady', 'Request::imReady');
$routes->add('Request/getTripDrivers', 'Request::getTripDrivers');
$routes->add('Request/ConfirmReq', 'Request::ConfirmReq');






























// ______________________________________ API Routes _______________________________________

$routes->post('api/auth', 'API\Auth::verify');
$routes->post('api/auth/start', 'API\Auth::start');
$routes->post('api/auth/createUser', 'API\Auth::createUser');

// $routes->get('api/auth/logout', 'API\Auth::logout');