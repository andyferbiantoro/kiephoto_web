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

//Untuk Pelanggan
Route::group(['middleware' => ['auth', 'pelanggan']],function(){
    Route::get('/pelanggan_pemesanan', 'PelangganController@pelanggan_pemesanan')->name('pelanggan_pemesanan');


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



    Route::get('/admin_kelola_portofolio', 'AdminController@admin_kelola_portofolio')->name('admin_kelola_portofolio');



    Route::get('/admin_kelola_pemesanan', 'AdminController@admin_kelola_pemesanan')->name('admin_kelola_pemesanan');


    Route::get('/admin_kelola_laporan_transaksi', 'AdminController@admin_kelola_laporan_transaksi')->name('admin_kelola_laporan_transaksi');


    Route::get('/admin_kelola_pengaturan', 'AdminController@admin_kelola_pengaturan')->name('admin_kelola_pengaturan');


});

Route::get('logout-admin', 'AuthController@logout')->name('logout-admin')->middleware(['admin', 'auth']);
Route::get('logout-pelanggan', 'AuthController@logout')->name('logout-pelanggan')->middleware(['pelanggan', 'auth']);
