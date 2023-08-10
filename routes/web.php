<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\KategoriProdukBeliController;
use App\Http\Controllers\KategoriProdukJualController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukBeliController;
use App\Http\Controllers\ProdukJualController;
use App\Http\Controllers\UserController;

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
	return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {

	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::get('jurnal', function () {
		return view('pages.jurnal');
	})->name('jurnal');

	Route::get('/jurnal/create', [JurnalController::class, 'create'])->name('jurnal.create');

	Route::get('user', function () {
		return view('pages.user');
	})->name('user');

	Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

	Route::get('penjualan', function () {
		return view('pages.penjualan');
	})->name('penjualan');

	Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');

	Route::get('produk-beli', function () {
		return view('pages.produk_beli');
	})->name('produk-beli');

	Route::get('/produk-beli/create', [ProdukBeliController::class, 'create'])->name('produk-beli.create');

	Route::get('produk-jual', function () {
		return view('pages.produk_jual');
	})->name('produk-jual');

	Route::get('/produk-jual/create', [ProdukJualController::class, 'create'])->name('produk-jual.create');

	Route::get('/kategori-produk-jual/create', [KategoriProdukJualController::class, 'create'])->name('kategori-produk-jual.create');
	Route::get('/kategori-produk-beli/create', [KategoriProdukBeliController::class, 'create'])->name('kategori-produk-beli.create');
});

// Route::middleware('auth')->group(function() {
// 	Route::middleware('hakakses:Owner')->prefix('owner')->group(function() {

// 	});

// 	Route::middleware('hakakses:Admin Kas')->prefix('admin_kas')->group(function() {

// 	});

// 	Route::middleware('hakakses:Admin')->prefix('owner')->group(function() {

// 	});
// });