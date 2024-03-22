<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('/login', 'Home::login');
$routes->get('/', 'Home::index');

$routes->get('/daftar_menu', 'Menu::daftar_menu');
$routes->get('/daftar_users', 'Home::daftar_users');
$routes->get('/daftar_pasien', 'Pasien::daftar_pasien');
$routes->get('/daftar_gejala', 'Gejala::daftar_gejala');
$routes->get('/daftar_penyakit', 'Penyakit::daftar_penyakit');
$routes->get('/daftar_relasi', 'Relasi::daftar_relasi');

$routes->get('/tambah_menu', 'Menu::tambah_menu');
$routes->get('/tambah_pasien', 'Pasien::tambah_pasien');
$routes->get('/tambah_gejala', 'Gejala::tambah_gejala');
$routes->get('/tambah_penyakit', 'Penyakit::tambah_penyakit');
$routes->get('/tambah_relasi', 'Relasi::tambah_relasi');

$routes->post('/simpan_menu', 'Menu::simpan_menu');
$routes->post('/simpan_pasien', 'Pasien::simpan_pasien');
$routes->post('/simpan_gejala', 'Gejala::simpan_gejala');
$routes->post('/simpan_penyakit', 'Penyakit::simpan_penyakit');
$routes->post('/simpan_relasi', 'Relasi::simpan_relasi');

$routes->get('/edit_menu/(:num)', 'Menu::edit_menu/$1');
$routes->get('/edit_pasien/(:num)', 'Pasien::edit_pasien/$1');
$routes->get('/edit_gejala/(:num)', 'Gejala::edit_gejala/$1');
$routes->get('/edit_penyakit/(:num)', 'Penyakit::edit_penyakit/$1');
$routes->get('/edit_relasi/(:num)', 'Relasi::edit_relasi/$1');

$routes->post('/perbarui_menu/(:num)', 'Menu::perbarui_menu/$1');
$routes->post('/perbarui_pasien/(:num)', 'Pasien::perbarui_pasien/$1');
$routes->post('/perbarui_gejala/(:num)', 'Gejala::perbarui_gejala/$1');
$routes->post('/perbarui_penyakit/(:num)', 'Penyakit::perbarui_penyakit/$1');
$routes->post('/perbarui_relasi/(:num)', 'Relasi::perbarui_relasi/$1');

$routes->delete('/hapus_menu/(:num)', 'Menu::hapus_menu/$1');
$routes->delete('/hapus_pasien/(:num)', 'Pasien::hapus_pasien/$1');
$routes->delete('/hapus_gejala/(:num)', 'Gejala::hapus_gejala/$1');
$routes->delete('/hapus_penyakit/(:num)', 'Penyakit::hapus_penyakit/$1');
$routes->delete('/hapus_relasi/(:num)', 'Relasi::hapus_relasi/$1');

$routes->get('/lihat_penyakit/(:num)', 'Penyakit::lihat_penyakit/$1');
