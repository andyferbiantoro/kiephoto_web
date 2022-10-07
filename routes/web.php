<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/login', 'AuthController@login')->name('login');
Route::get('/register', 'AuthController@register')->name('register');


//proses register
Route::post('proses-register', 'AuthController@proses_register')->name('proses-register')->middleware('guest');

//proses login
Route::post('proses-login','AuthController@proses_login')->name('proses-login')->middleware('guest');

Route::get('/', 'PelangganController@dashboard')->name('dashboard');

Route::get('paket', 'PelangganController@paket')->name('paket');
Route::get('tipe_paket{id}', 'PelangganController@tipe_paket')->name('tipe_paket');

Route::get('tentang', 'PelangganController@tentang')->name('tentang');
Route::get('panduan', 'PelangganController@panduan')->name('panduan');



//Untuk Pelanggan
Route::group(['middleware' => ['auth', 'pelanggan']],function(){
    Route::get('/pelanggan_pemesanan{id}', 'PelangganController@pelanggan_pemesanan')->name('pelanggan_pemesanan');
    Route::get('/pelanggan_riwayat_pemesanan', 'PelangganController@pelanggan_riwayat_pemesanan')->name('pelanggan_riwayat_pemesanan');
    Route::post('/pelanggan_pemesanan_add', 'PelangganController@pelanggan_pemesanan_add')->name('pelanggan_pemesanan_add');


    Route::get('/pelanggan_pembayaran{id_pemesanan}', 'PelangganController@pelanggan_pembayaran')->name('pelanggan_pembayaran');
    Route::post('/pelanggan_pembayaran_add', 'PelangganController@pelanggan_pembayaran_add')->name('pelanggan_pembayaran_add');


    Route::get('/pelanggan_profil', 'PelangganController@pelanggan_profil')->name('pelanggan_profil');
    Route::get('/pelanggan_profil_edit{id}', 'PelangganController@pelanggan_profil_edit')->name('pelanggan_profil_edit');
    Route::post('/pelanggan_profil_update', 'PelangganController@pelanggan_profil_update')->name('pelanggan_profil_update');
});

//Untuk Admin
Route::group(['middleware' => ['auth', 'admin']],function(){
    Route::get('/admin_index', 'AdminController@index')->name('admin_index');

    Route::get('/admin_kelola_pelanggan', 'AdminController@admin_kelola_pelanggan')->name('admin_kelola_pelanggan');
    Route::post('/admin_kelola_pelanggan_delete/{id}', 'AdminController@kelola_pelanggan_delete')->name('admin_kelola_pelanggan_delete');


    Route::get('/admin_kelola_paket', 'AdminController@admin_kelola_paket')->name('admin_kelola_paket');
    Route::post('/admin_kelola_paket_add', 'AdminController@admin_kelola_paket_add')->name('admin_kelola_paket_add');
    Route::post('/admin_kelola_paket_update/{id}', 'AdminController@admin_kelola_paket_update')->name('admin_kelola_paket_update');
    Route::post('/admin_kelola_paket_delete/{id}', 'AdminController@admin_kelola_paket_delete')->name('admin_kelola_paket_delete');


    Route::get('/admin_detail_paket{id}', 'AdminController@admin_detail_paket')->name('admin_detail_paket');
    Route::post('/admin_detail_paket_add', 'AdminController@admin_detail_paket_add')->name('admin_detail_paket_add');
    Route::post('/admin_detail_paket_update/{id}', 'AdminController@admin_detail_paket_update')->name('admin_detail_paket_update');
    Route::post('/admin_detail_paket_delete/{id}', 'AdminController@admin_detail_paket_delete')->name('admin_detail_paket_delete');


    Route::get('/admin_kelola_portofolio', 'AdminController@admin_kelola_portofolio')->name('admin_kelola_portofolio');
    Route::post('/admin_kelola_portofolio_add', 'AdminController@admin_kelola_portofolio_add')->name('admin_kelola_portofolio_add');
    Route::post('/admin_kelola_portofolio_update/{id}', 'AdminController@admin_kelola_portofolio_update')->name('admin_kelola_portofolio_update');
    Route::post('/admin_kelola_portofolio_delete/{id}', 'AdminController@admin_kelola_portofolio_delete')->name('admin_kelola_portofolio_delete');


    Route::get('/admin_kelola_pemesanan', 'AdminController@admin_kelola_pemesanan')->name('admin_kelola_pemesanan');
    Route::get('/admin_detail_pemesanan{id}', 'AdminController@admin_detail_pemesanan')->name('admin_detail_pemesanan');
    Route::get('/admin_detail_pembayaran{id_pemesanan}', 'AdminController@admin_detail_pembayaran')->name('admin_detail_pembayaran');
    Route::post('/admin_verifikasi_pembayaran/{id}', 'AdminController@admin_verifikasi_pembayaran')->name('admin_verifikasi_pembayaran');
    Route::post('/admin_cancel_pembayaran/{id}', 'AdminController@admin_cancel_pembayaran')->name('admin_cancel_pembayaran');
    Route::post('/admin_lunasi_pembayaran/{id}', 'AdminController@admin_lunasi_pembayaran')->name('admin_lunasi_pembayaran');
    Route::post('/admin_selesaikan_sesi/{id}', 'AdminController@admin_selesaikan_sesi')->name('admin_selesaikan_sesi');
    Route::post('/admin_foto_diambil/{id}', 'AdminController@admin_foto_diambil')->name('admin_foto_diambil');


    Route::get('/admin_kelola_laporan_transaksi', 'AdminController@admin_kelola_laporan_transaksi')->name('admin_kelola_laporan_transaksi');


    Route::get('/admin_kelola_pengaturan', 'AdminController@admin_kelola_pengaturan')->name('admin_kelola_pengaturan');

    Route::get('/admin_ubah_password', 'AdminController@admin_ubah_password')->name('admin_ubah_password');
    Route::post('/admin_update_password', 'AdminController@admin_update_password')->name('admin_update_password');


});

Route::get('logout-admin', 'AuthController@logout')->name('logout-admin')->middleware(['admin', 'auth']);
Route::get('logout-pelanggan', 'AuthController@logout')->name('logout-pelanggan')->middleware(['pelanggan', 'auth']);
