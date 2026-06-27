<?php

namespace Config;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Default route (Home)
$routes->get('/', 'Home::index');

// === ROUTES MODUL 1 ===
$routes->get('/about', 'Page::about');
$routes->get('/contact', 'Page::contact');
$routes->get('/faqs', 'Page::faqs');

// === ROUTES MODUL 2 & 3 (Artikel Public) ===
$routes->get('/artikel', 'Artikel::index');
$routes->get('/artikel/(:any)', 'Artikel::view/$1');

// === ROUTES MODUL 4 (Login & Logout) ===
$routes->get('/user/login', 'User::login');
$routes->post('/user/login', 'User::login');
$routes->get('/user/logout', 'User::logout');

// === ROUTES MODUL 5,6,7,9 (Admin dengan proteksi) ===
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('artikel', 'Artikel::admin_index');
    $routes->add('artikel/add', 'Artikel::add');
    $routes->add('artikel/edit/(:num)', 'Artikel::edit/$1');
    $routes->get('artikel/delete/(:num)', 'Artikel::delete/$1');
});

// === ROUTES MODUL 8 & 9 (AJAX) ===
$routes->group('ajax', function($routes) {
    $routes->get('/', 'AjaxController::index');
    $routes->get('getData', 'AjaxController::getData');
    $routes->post('delete/(:num)', 'AjaxController::delete/$1');
});

// Optional: Redirect ke login jika akses admin tanpa login (cadangan)
$routes->get('/admin', function() {
    return redirect()->to('/user/login');
});

// Praktikum 10 - REST API
$routes->resource('post');