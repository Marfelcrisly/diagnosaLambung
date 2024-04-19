<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/profile', 'Home::profile');

$routes->get('/daftar_menu', 'Menu::daftar_menu', ['filter' => 'role:admin']);
$routes->get('/daftar_pengguna', 'Pengguna::daftar_pengguna', ['filter' => 'role:admin']);
$routes->get('/daftar_pasien', 'Pasien::daftar_pasien', ['filter' => 'role:admin']);
$routes->get('/daftar_gejala', 'Gejala::daftar_gejala', ['filter' => 'role:admin']);
$routes->post('/daftar_gejala', 'Gejala::daftar_gejala', ['filter' => 'role:admin']);
$routes->get('/daftar_penyakit', 'Penyakit::daftar_penyakit', ['filter' => 'role:admin']);
$routes->get('/daftar_relasi', 'Relasi::daftar_relasi', ['filter' => 'role:admin']);
$routes->get('/daftar_bobot', 'Bobot::daftar_bobot', ['filter' => 'role:admin']);
$routes->get('/daftar_diagnosa', 'Diagnosa::daftar_diagnosa', ['filter' => 'role:admin']);
$routes->get('/akses_menu', 'Akses::akses_menu', ['filter' => 'role:admin']);
$routes->get('/daftar_kasusLama', 'KasusLama::daftar_kasusLama', ['filter' => 'role:admin']);

$routes->get('/tambah_menu', 'Menu::tambah_menu', ['filter' => 'role:admin']);
$routes->get('/tambah_gejala', 'Gejala::tambah_gejala', ['filter' => 'role:admin']);
$routes->get('/tambah_penyakit', 'Penyakit::tambah_penyakit', ['filter' => 'role:admin']);
$routes->get('/tambah_relasi', 'Relasi::tambah_relasi', ['filter' => 'role:admin']);
$routes->get('/tambah_bobot', 'Bobot::tambah_bobot', ['filter' => 'role:admin']);
$routes->get('/tambah_diagnosa', 'Diagnosa::tambah_diagnosa', ['filter' => 'role:admin']);
$routes->get('/tambah_pengguna', 'Pengguna::tambah_pengguna', ['filter' => 'role:admin']);
$routes->get('/tambah_kasusLama', 'KasusLama::tambah_kasusLama', ['filter' => 'role:admin']);

$routes->post('/simpan_menu', 'Menu::simpan_menu', ['filter' => 'role:admin']);
$routes->post('/simpan_gejala', 'Gejala::simpan_gejala', ['filter' => 'role:admin']);
$routes->post('/simpan_penyakit', 'Penyakit::simpan_penyakit', ['filter' => 'role:admin']);
$routes->post('/simpan_relasi', 'Relasi::simpan_relasi');
$routes->post('/simpan_bobot', 'Bobot::simpan_bobot');
$routes->post('/simpan_diagnosa', 'Diagnosa::simpan_diagnosa', ['filter' => 'role:admin']);
$routes->post('/simpan_pengguna', 'Pengguna::simpan_pengguna', ['filter' => 'role:admin']);
$routes->post('/simpan_kasusLama', 'KasusLama::simpan_kasusLama', ['filter' => 'role:admin']);

$routes->get('/edit_menu/(:num)', 'Menu::edit_menu/$1', ['filter' => 'role:admin']);
$routes->get('/edit_pasien/(:num)', 'Pasien::edit_pasien/$1', ['filter' => 'role:admin']);
$routes->get('/edit_gejala/(:num)', 'Gejala::edit_gejala/$1', ['filter' => 'role:admin']);
$routes->get('/edit_penyakit/(:num)', 'Penyakit::edit_penyakit/$1', ['filter' => 'role:admin']);
$routes->get('/edit_relasi/(:num)', 'Relasi::edit_relasi/$1', ['filter' => 'role:admin']);
$routes->get('/edit_bobot/(:num)', 'Bobot::edit_bobot/$1', ['filter' => 'role:admin']);
$routes->get('/edit_kasusLama/(:num)', 'KasusLama::edit_kasusLama/$1', ['filter' => 'role:admin']);

$routes->post('/perbarui_menu/(:num)', 'Menu::perbarui_menu/$1', ['filter' => 'role:admin']);
$routes->post('/perbarui_pasien/(:num)', 'Pasien::perbarui_pasien/$1', ['filter' => 'role:admin']);
$routes->post('/perbarui_gejala/(:num)', 'Gejala::perbarui_gejala/$1', ['filter' => 'role:admin']);
$routes->post('/perbarui_penyakit/(:num)', 'Penyakit::perbarui_penyakit/$1', ['filter' => 'role:admin']);
$routes->post('/perbarui_relasi/(:num)', 'Relasi::perbarui_relasi/$1', ['filter' => 'role:admin']);
$routes->post('/perbarui_bobot/(:num)', 'Bobot::perbarui_bobot/$1', ['filter' => 'role:admin']);
$routes->post('/perbarui_bobot/(:num)', 'Bobot::perbarui_bobot/$1', ['filter' => 'role:admin']);
$routes->post('/perbarui_profile/(:num)', 'Home::perbarui_profile/$1', ['filter' => 'role:admin']);

$routes->delete('/hapus_menu/(:num)', 'Menu::hapus_menu/$1', ['filter' => 'role:admin']);
$routes->delete('/hapus_pasien/(:num)', 'Pasien::hapus_pasien/$1', ['filter' => 'role:admin']);
$routes->delete('/hapus_gejala/(:num)', 'Gejala::hapus_gejala/$1', ['filter' => 'role:admin']);
$routes->delete('/hapus_penyakit/(:num)', 'Penyakit::hapus_penyakit/$1', ['filter' => 'role:admin']);
$routes->delete('/hapus_relasi/(:num)', 'Relasi::hapus_relasi/$1', ['filter' => 'role:admin']);
$routes->delete('/hapus_bobot/(:num)', 'Bobot::hapus_bobot/$1', ['filter' => 'role:admin']);
$routes->delete('/hapus_pengguna/(:num)', 'Pengguna::hapus_pengguna/$1', ['filter' => 'role:admin']);
$routes->delete('/hapus_diagnosa/(:num)', 'Diagnosa::hapus_diagnosa/$1', ['filter' => 'role:admin']);
$routes->delete('/hapus_kasusLama/(:num)', 'KasusLama::hapus_kasusLama/$1', ['filter' => 'role:admin']);

$routes->get('/hapus_semua_penyakit', 'Penyakit::hapus_semua_penyakit', ['filter' => 'role:admin']);
$routes->get('/hapus_semua_gejala', 'Gejala::hapus_semua_gejala', ['filter' => 'role:admin']);
$routes->get('/hapus_semua_relasi', 'Relasi::hapus_semua_relasi', ['filter' => 'role:admin']);
$routes->get('/hapus_semua_kasusLama', 'KasusLama::hapus_semua_kasusLama', ['filter' => 'role:admin']);
$routes->get('/hapus_semua_diagnosa', 'Diagnosa::hapus_semua_diagnosa', ['filter' => 'role:admin']);
$routes->get('/hapus_semua_bobot', 'Bobot::hapus_semua_bobot', ['filter' => 'role:admin']);

$routes->get('/lihat_penyakit/(:num)', 'Penyakit::lihat_penyakit/$1', ['filter' => 'role:admin']);
$routes->get('/lihat_hasil/(:num)', 'Diagnosa::lihat_hasil/$1', ['filter' => 'role:admin']);

$routes->post('/status/(:num)', 'Menu::status/$1', ['filter' => 'role:admin']);

$routes->get('/reset_password/(:num)', 'Pengguna::reset_password/$1', ['filter' => 'role:admin']);

$routes->post('/aksi_simpan_status', 'Akses::aksi_simpan_status', ['filter' => 'role:admin']);

$routes->post('/otentikasi', 'Otentikasi::index');
