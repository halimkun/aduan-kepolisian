<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->delete('/user/delete/(:num)', 'User::delete/$1');

// admin
$routes->get('/admin/aduan/add', 'Admin::aduan_add');

// Api Endpoints (Aduan)
$routes->get('/api/aduan', 'Api::aduan');
$routes->get('/api/aduan/all', 'Api::aduan_getall');
$routes->get('/api/aduan/new', 'Api::aduan_getlatest');
$routes->get('/api/aduan/(:num)', 'Api::aduan_getbynum/$1');
$routes->get('/api/aduan/cat/(:any)', 'Api::aduan_getbyjenis/$1');
$routes->get('/api/aduan/status/(:any)', 'Api::aduan_getbystatus/$1');
$routes->get('/api/aduan/year/(:num)', 'Api::aduan_getByYear/$1');
$routes->get('/api/aduan/chart/year/(:num)', 'Api::aduan_chartYearly/$1');

$routes->put('/api/aduan/update', 'Api::aduan_updatestts');

$routes->delete('/api/aduan/delete/(:num)', 'Api::aduan_delete/$1');

$routes->post('/api/aduan/create', 'Api::aduan_create');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
