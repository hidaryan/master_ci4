<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
  * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.


$routes->get('/', 'PagesController::index');

//USER MANAGEMENT
$routes->get('/user', 'UserController::index',  ['filter' => 'permission:900,910']);
$routes->get('/user/tableusers', 'UserController::tableUsers',  ['filter' => 'permission:900,910']);
$routes->get('/user/profile', 'UserController::profile',  ['filter' => 'permission:900,920']);

//NDE ROUTE
$routes->get('/nde', 'NdeController::index',  ['filter' => 'permission:100,110']);
$routes->get('/nde/inbox', 'NdeController::inbox',  ['filter' => 'permission:100,110']);
//$routes->get('/nde/inbox/(:any)', 'NdeController::inbox',  ['filter' => 'permission:100,110']);
$routes->get('/nde/outbox', 'NdeController::outbox',  ['filter' => 'permission:100,120']);
$routes->get('/nde/download/(:any)/(:any)/(:any)/(:any)', 'NdeController::download_attchment/$1/$2/$3/$4',  ['filter' => 'permission:100,120']);
$routes->get('/nde/downloadnde/(:any)/(:any)/(:any)/(:any)', 'NdeController::download_nde/$1/$2/$3/$4',  ['filter' => 'permission:100,120']);



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
