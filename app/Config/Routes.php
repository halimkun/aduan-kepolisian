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
// $routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');
$routes->get('/home/user', 'Home::user');

// Group Admin Routes
$routes->group('admin', ['filter' => 'role:admin'], function ($adm) {
    $adm->add('/', 'Admin::index');
    $adm->add('index', 'Admin::index');
    $adm->add('home', 'Admin::home');

    $adm->add('aduan', 'Admin::aduan');
    $adm->add('user', 'Admin::user');
    // $adm->add('user_show', 'Admin::user_show'); // <-- show json user data
    // $adm->add('aduan/add', 'Admin::aduan_add'); // <-- Tambah Aduan
});

// Group User Routes
$routes->group('user', ['filter' => 'role:admin'], function ($usr) {
    $usr->add('/', 'User::index');
    $usr->add('index', 'User::index');
    $usr->add('home', 'User::index');

    $usr->add('store', 'User::store');
    $usr->add('delete', 'User::delete');
    $usr->add('update', 'User::update');
    $usr->add('getById', 'User::getById');
    $usr->add('updatePass', 'User::updatePass');
});

// group aduan routes
$routes->group('aduan', ['filter' => 'role:admin'], function ($aduan) {
    $aduan->add('/', 'Aduan::index');
    $aduan->add('home', 'Aduan::index');
    $aduan->add('index', 'Aduan::index');
    
    $aduan->add('create', 'Aduan::create');
    $aduan->add('getById', 'Aduan::getById');
    $aduan->add('update_stts', 'Aduan::update_stts');
});

// Group Api Routes
$routes->group('api', function ($api) {
    $api->add('/', 'Api::aduan');
    
    $api->get('aduan', 'Api::aduan');
    $api->get('aduan/(:num)/all', 'Api::aduan_getall/$1');
    $api->get('aduan/(:num)/new', 'Api::aduan_getlatest/$1');
    $api->get('aduan/(:num)/cat/(:any)', 'Api::aduan_getbyjenis/$1/$2');
    $api->get('aduan/(:num)/status/(:any)', 'Api::aduan_getbystatus/$1/$2');
    $api->get('aduan/(:num)/year/(:num)', 'Api::aduan_getByYear/$1/$2');
    $api->get('aduan/(:num)', 'Api::aduan_getbynomor/$1');
    $api->get('aduan/chart/year/(:num)', 'Api::aduan_chartYearly/$1');
    
    $api->post('aduan/create', 'Api::aduan_create');
    $api->post('login', 'Api::login');
    $api->post('reset-password', 'Api::reset_password');
    $api->post('aduan/update', 'Api::aduan_update');

    $api->put('aduan/status/update', 'Api::aduan_updatestts');
    
    $api->delete('aduan/delete/(:num)', 'Api::aduan_delete/$1');
});

$routes->delete('/user/delete/(:num)', 'User::delete/$1');

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
