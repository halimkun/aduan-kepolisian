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
$routes->group('admin', ['filter' => 'role:admin,petugas'], function ($adm) {
    $adm->add('/', 'Admin::index');
    $adm->add('index', 'Admin::index');
    $adm->add('home', 'Admin::home');
    $adm->add('profile', 'Admin::profile');

    $adm->get('status-jenis', 'Admin::status_jenis');
    $adm->post('status-jenis', 'Admin::status_jenis');
    $adm->delete('status-jenis', 'Admin::status_jenis');

    $adm->get('laporan', 'Admin::laporan');
    $adm->post('laporan/cetak', 'Admin::laporan_cetak');

    $adm->add('aduan', 'Admin::aduan');
    $adm->add('user', 'Admin::user');
    $adm->add('user_show', 'Admin::user_show'); // <-- show json user data
    $adm->add('aduan/add', 'Admin::aduan_add'); // <-- Tambah Aduan
});

// Group User Routes
$routes->group('user', ['filter' => 'role:admin,petugas'], function ($usr) {
    $usr->add('/', 'User::index');
    $usr->add('index', 'User::index');
    $usr->add('home', 'User::index');

    $usr->add('store', 'User::store');
    $usr->add('delete', 'User::delete');
    $usr->add('update', 'User::update');
    $usr->add('getById', 'User::getById');
    $usr->add('updatePass', 'User::updatePass');
    $usr->add('customPass', 'User::customPass');
    $usr->add('updateRoles', 'User::updateRoles');
});

// group aduan routes
$routes->group('aduan', ['filter' => 'role:admin,petugas'], function ($aduan) {
    $aduan->add('/', 'Aduan::index');
    $aduan->add('home', 'Aduan::index');
    $aduan->add('index', 'Aduan::index');
    
    $aduan->add('create', 'Aduan::create');
    $aduan->add('getById', 'Aduan::getById');
    $aduan->add('update_stts', 'Aduan::update_stts');
});

$routes->group('warga', ['filter' => 'role:pengguna'], function ($wrg) {
    $wrg->add('/', 'Warga::index');
    $wrg->add('index', 'Warga::index');
    $wrg->add('home', 'Warga::index');
    $wrg->add('pass/update', 'Warga::updatePass');
    

    $wrg->add('profile', 'Warga::profile');
    $wrg->add('profile/update', 'Warga::profile_update');
    
    $wrg->add('aduan', 'Warga::aduan');
    $wrg->add('aduan/add', 'Warga::aduan_add');
    $wrg->add('aduan/store', 'Warga::aduan_store');
    $wrg->add('aduan/(:num)', 'Warga::aduan_edit/$1');
    $wrg->add('aduan/update', 'Warga::aduan_update');
    $wrg->add('aduan/delete', 'Warga::aduan_delete');
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
    
    $api->post('login', 'Api::login');
    $api->post('register', 'Api::register');
    $api->post('aduan/create', 'Api::aduan_create');
    $api->post('aduan/update', 'Api::aduan_update');
    $api->post('reset-password', 'Api::reset_password');
    $api->post('repass', 'Api::repass');

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
