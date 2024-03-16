<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('/login', 'Home::login');
$routes->get('/', 'Home::index');
$routes->get('/daftar_users', 'Home::daftar_users');
$routes->get('/daftar_pasien', 'Home::daftar_pasien');
$routes->get('/tambah_pasien', 'Home::tambah_pasien');
$routes->post('/simpan_pasien', 'Home::simpan_pasien');
$routes->get('/edit_pasien/(:num)', 'Home::edit_pasien/$1');
$routes->post('/ubah_pasien/(:num)', 'Home::ubah_pasien/$1');
$routes->delete('/hapus_pasien/(:num)', 'Home::hapus_pasien/$1');