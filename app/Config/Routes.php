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

$routes->get('Type', 'Cars::Type');
$routes->get('Type/(:any)', 'Cars::Type/$1');
$routes->post('Type/(:any)', 'Cars::Type/$1');

$routes->get('/Cars/Drivers/(:any)', to: 'Cars::Drivers/$1');
$routes->post('/Cars/Drivers/(:any)', 'Cars::Drivers/$1');

$routes->get('Driver/Info/(:any)', 'Drivers::Info/$1');

$routes->get('Driver/Cars/(:any)', 'Cars::DriverCars/$1');


$routes->get('Driver/Cars/(:any)/(:any)/(:any)', 'Cars::DriverCars::All/$1/$2/$3');
$routes->post('Driver/Cars/(:any)(:any)/(:any)', 'Cars::DriverCars::All/$1/$2/$3');


$routes->get('all-drivers/(:any)', 'Drivers::All/$1');
$routes->post('all-drivers/(:any)', 'Drivers::All/$1');

// http://localhost:8080/all-drivers/edit/2
// // Driver/Cars/2/edit/1

$routes->get('RC/(:any)', to: 'Cars::RC/$1/$2');
$routes->get('RD/(:any)', to: 'Drivers::RD/$1/$2');
$routes->get('RU/(:any)', to: 'User::RD/$1/$2');
$routes->get('LO/(:any)', to: 'User::LO/$1/$2');
$routes->get('RL/(:any)', to: 'Option::RL/$1/$2');






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
$routes->add('all-drivers/(:any)', 'Drivers::All/$1');

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
$routes->add('Option/Packages/(:any)', to: 'Option::Packages/$1');


$routes->add('Option/Banks', 'Option::banks');
$routes->add('Option/Banks/(:any)', 'Option::banks/$1');

$routes->post('Option/saveSettings', 'Option::saveSettings');


$routes->get('Trips', 'Trips::index');
$routes->get('Trips/New', 'Trips::NewTrip');
$routes->get('Trips/getJSON', 'Trips::getJSON');
$routes->get('Trips/GetTrip(:any)', 'Trips::GetTrip/$1');
$routes->post('Trips/CreateNotif(:any)', 'Trips::CreateNotif/$1');
$routes->get('Trips/CreateNotif(:any)', 'Trips::CreateNotif/$1');
$routes->post('Trips/UpdateStatus(:any)', 'Trips::UpdateStatus/$1');
$routes->post('Trips/Dwt(:any)', 'Trips::Dwt/$1');

$routes->get('EditTrip/(:any)', 'Trips::EditTrip/$1');
$routes->post('Driver/GetDriverCars', 'Drivers::GetDriverCars');

$routes->post('Trips/UpdateTrip', 'Trips::UpdateTrip');


$routes->get('GetBrandCars/(:any)', 'Cars::GetBrandCars/$1');


$routes->get('Trips/AddTrip', 'Trips::AddTrip');
$routes->post('Trips/AddTrip', 'Trips::AddTrip');

$routes->get('Trips/FindID', 'Trips::FindID');
$routes->post('Trips/FindID', 'Trips::FindID');

$routes->get('Trips/Step2(:any)', 'Trips::Step2/$1');
$routes->add('TripsDetail/(:any)', 'Trips::Detail/$1');

$routes->get('Trips/Factor/(:any)', 'Trips::Factor/$1');
$routes->get('Trips/pishFactor/(:any)', 'Trips::pishFactor/$1');
// ______________________________________ Request _______________________________________

$routes->add('Request/imReady', 'Request::imReady');
$routes->add('Request/getTripDrivers', 'Request::getTripDrivers');
$routes->add('Request/ConfirmReq', 'Request::ConfirmReq');



// ______________________________________ Request _______________________________________

$routes->get('Pay/UserPay', 'Pay::UserPay');
$routes->post('Pay/UserPay', 'Pay::UserPay');

$routes->get('Pay/UserPayStart', 'Pay::UserPayStart');
$routes->post('Pay/UserPayStart', 'Pay::UserPayStart');

$routes->post('usePay/callback', 'Pay::Check');






/***************************************
 *              Report
 **************************************/



 $routes->get('Search/Trips', 'TripReport::index');
 $routes->get('Search/Trips/Result', 'TripReport::Search');
 $routes->get('Search/Trips/Print', 'TripReport::Print');


 $routes->get('Report/All', 'Report::All');
 $routes->get('Report/Trips/Result', 'Report::Search');
 $routes->get('Report/Trips/Print', 'Report::Print');
 $routes->get('Report/All/Print', 'Report::PrintAll');
 
 $routes->get('Report/Drivers', 'Report::Drivers');

/***************************************
 *          TransAction API
 **************************************/


 $routes->get('transaction/add', 'Transaction::_add');
 $routes->get('transaction/getAll/(:any)', 'Transaction::getAll/$1');

 $routes->post('transaction/create', 'Transaction::create');
 $routes->get('transaction/create', 'Transaction::create');
 $routes->post('transaction/remove', 'Transaction::remove');


$routes->get('user/getAllUser', 'User::getAllUser');
$routes->get('driver/getAllDriver', 'Drivers::getAllDrivers');


/*********************************************
 *          TransAction Web
 **************************************/

$routes->add('Transactions/', 'Transaction::All');
$routes->add('Transactions/(:any)', 'Transaction::All/$1');





$routes->get('updateCode', 'Drivers::updateCode');



/*********************************************
 *          TransAction
 **************************************/


 $routes->get('srv/Report/(:any)', 'Service::Report/$1');  
 $routes->get('srv/Invoice/(:any)', 'Service::Invoice/$1');  



// ______________________________________ API Routes _______________________________________

$routes->post('api/auth/login', 'api\Auth::login');

$routes->post('api/auth/checIn', 'api\Auth::checIn');
$routes->post('api/auth/updatePasswd', 'api\Auth::updatePasswd');

$routes->post('api/auth/createUser', 'api\Auth::createUser');

$routes->post('api/driver/Trips', 'api\Driver::Trips');
$routes->post('api/driver/cars', 'api\Driver::Cars');
$routes->get('api/car/brands', 'api\Driver::Brands');
$routes->get('api/car/type', 'api\Driver::Types');

$routes->add('api/driver/TripsList', 'api\Driver::TripsList');
$routes->add('api/driver/MyTrips', 'api\Driver::MyTrips');
$routes->add('api/driver/onGoingTrip', 'api\Driver::onGoingTrip');
$routes->add('api/driver/SetActiveCar', 'api\Driver::SetActiveCar');
// $routes->add('api/driver/addCar', 'api\Driver::addCar');
$routes->post('api/driver/addCar', 'api\Driver::addCar');

$routes->post('api/request/Send', 'api\Request::Send');
$routes->post('api/request/MyRequests', 'api\Request::MyRequests');

// $routes->get('api/auth/logout', 'API\Auth::logout');





/***********FIXXXXXXXXX ******************* */

$routes -> add('fixPassengerID','Fix::fixPassengerID');
$routes -> add('fixCallDate','Fix::fixCallDate');
$routes -> add('packge','Fix::packge');
$routes -> add('fixBank','Fix::fixBank');
$routes -> add('FixRequestIS','Fix::FixRequestIS');