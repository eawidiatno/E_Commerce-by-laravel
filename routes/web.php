<?php

use Illuminate\Support\Facades\Route;
use App\produk;
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

Route::get('/', function () {
    $data=produk::all();
    return view('welcome',compact('data'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');
Route::get('/input_produk', 'ProdukController@input_produk');
Route::post('/simpan_produk', 'ProdukController@simpan_produk');
Route::get('/produk', 'ProdukController@produk');

Route::get('/delete_item/{id}', 'ProdukController@delete_item');

Route::get('/update_produk/{id}', 'ProdukController@update_produk');
Route::post('/simpan_update_produk','ProdukController@simpan_update_produk');

Route::get('/search', 'ProdukController@search');

Route::get('/detile_produk/{id}', 'CartController@detile_produk')->name('detile_produk');
//Route::get('/cart', 'CartController@cart')->name('cart');
//Route::post('/detile_produk/{id}', 'CartController@save_cart')->name('save_cart');
Route::get('/cart_detail', 'CartController@cart_detail')->name('cart_detail');
Route::post('/detile_produk/{id}', 'CartController@save_cartid');

//Route::post('/delete_cart', 'CartController@delete_cart')->name('delete_cart');
Route::post('/delete', 'CartController@delete')->name('delete');

Route::get('konfirmasi-check-out', 'CartController@konfirmasi');
Route::get('profile', 'ProfileController@profile');
Route::post('profile', 'ProfileController@update');

Route::get('checkout/{id}', 'CheckoutController@checkout');

Route::get('transaksi','TransaksiController@transaksi');
Route::get('data_transaksi','TransaksiController@data_transaksi');
Route::get('data_transaksi/{id}', 'TransaksiController@detile');

Route::get('/bukti_bayar/{id}','TransaksiController@bukti_bayar');
Route::post('/save_bukti/{id}', 'TransaksiController@save_bukti');

Route::get('/update_transaksi/{id}', 'TransaksiController@update_transaksi');
Route::post('/save_update_transaksi','TransaksiController@save_update_transaksi');

Route::get('form_laporan','LaporanController@form_laporan');
Route::get('proses_laporan', 'LaporanController@proses_laporan');

Route::get('password', 'PasswordController@changePassword')
        ->name('changePassword');
Route::post('update_password', 'PasswordController@update_password');