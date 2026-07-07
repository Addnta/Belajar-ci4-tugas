<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

$routes->group('produk', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'ProdukController::index');
    $routes->get('qr', 'ProdukController::qr');
    $routes->get('download', 'ProdukController::download');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
});

$routes->group('keranjang', ['filter' => 'auth'], function ($routes) {
    $routes->get('', 'TransaksiController::index');
    $routes->post('', 'TransaksiController::cart_add');
    $routes->post('edit', 'TransaksiController::cart_edit');
    $routes->get('delete/(:any)', 'TransaksiController::cart_delete/$1');
    $routes->get('clear', 'TransaksiController::cart_clear');
});

$routes->get('checkout', 'TransaksiController::checkout', ['filter' => 'auth']);
$routes->post('buy', 'TransaksiController::buy', ['filter' => 'auth']);
$routes->get('ajax/destinations', 'TransaksiController::destinations', ['filter' => 'auth']);
$routes->get('ajax/costs', 'TransaksiController::costs', ['filter' => 'auth']);

$routes->get('profile', 'Pages::profile', ['filter' => 'auth']);
$routes->get('faq', 'Pages::faq', ['filter' => 'auth']);
$routes->get('contact', 'Pages::contact', ['filter' => 'auth']);

// History route for user transactions
$routes->get('history', 'TransaksiController::history', ['filter' => 'auth']);

// API routes
$routes->resource('api/products', ['controller' => 'Api\\ProdukController']);
$routes->get('api/transactions', 'Api\\TransaksiController::index');