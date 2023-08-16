<?php

use App\Models\Salesman;
use App\Models\Supplier;
use App\Models\Penjualan;
use App\Models\ProdukBeli;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesmanController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukBeliController;
use App\Http\Controllers\ProdukJualController;
use App\Http\Controllers\KategoriProdukBeliController;
use App\Http\Controllers\KategoriProdukJualController;

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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginPost'])->name('login');

// Route::group(['middleware' => 'auth'], function () {

// 	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
// 	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
// 	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

// 	Route::get('jurnal', function () {
// 		return view('pages.jurnal');
// 	})->name('jurnal');

// 	Route::get('/jurnal/create', [JurnalController::class, 'create'])->name('jurnal.create');

// 	Route::get('user', function () {
// 		return view('pages.user');
// 	})->name('user');

// 	Route::get('/user/create', [UserController::class, 'create'])->name('user.create');

// 	Route::get('penjualan', function () {
// 		return view('pages.penjualan');
// 	})->name('penjualan');

// 	Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');

// 	Route::get('produk-beli', function () {
// 		return view('pages.produk_beli');
// 	})->name('produk-beli');

// 	Route::get('/produk-beli/create', [ProdukBeliController::class, 'create'])->name('produk-beli.create');

// 	Route::get('produk-jual', function () {
// 		return view('pages.produk_jual');
// 	})->name('produk-jual');

// 	Route::get('/produk-jual/create', [ProdukJualController::class, 'create'])->name('produk-jual.create');

// 	Route::get('/kategori-produk-jual/create', [KategoriProdukJualController::class, 'create'])->name('kategori-produk-jual.create');
// 	Route::get('/kategori-produk-beli/create', [KategoriProdukBeliController::class, 'create'])->name('kategori-produk-beli.create');
// });

// // Route::middleware('guest')->group(function() {
// 	//redirect ke halaman login
// 	Route::get('/login', [AuthController::class, 'login'])->name('login');

// 	//post data login ke AuthController
// 	Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
// // });

Route::middleware('auth')->group(function () {
	Route::get('/jurnal', [JurnalController::class, 'jurnal'])->name('jurnal');

	//Route untuk Penjualan
	Route::post('penjualan-pdf', [PenjualanController::class, 'generate_pdf'])->name('penjualan.pdf');
	Route::get('penjualan', [PenjualanController::class, 'index'])->name('penjualan');
	Route::get('penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
	Route::post('penjualan/store', [PenjualanController::class, 'store'])->name('penjualan.store');
	Route::get('penjualan/detail/{id}', [PenjualanController::class, 'detail'])->name('penjualan.detail');
	Route::get('penjualan/detail/edit/{id}', [PenjualanController::class, 'detail_penjualan'])->name('penjualan.detail.edit');
	Route::put('penjualan/detail/update/{id}', [PenjualanController::class, 'update_detail_penjualan'])->name('penjualan.detail.update');

	//Route untuk Pembelian
	Route::post('pembelian-pdf', [PembelianController::class, 'generate_pdf'])->name('pembelian.pdf');
	Route::get('pembelian', [PembelianController::class, 'index'])->name('pembelian');
	Route::get('pembelian/create', [PembelianController::class, 'create'])->name('pembelian.create');
	Route::post('pembelian/store', [PembelianController::class, 'store'])->name('pembelian.store');
	Route::get('pembelian/detail/{id}', [PembelianController::class, 'detail'])->name('pembelian.detail');

	//Route untuk Produk jual
	Route::get('produk-jual', [ProdukJualController::class, 'index'])->name('produk-jual');
	Route::get('produk-jual/create', [ProdukJualController::class, 'create'])->name('produk-jual.create');
	Route::post('produk-jual/store', [ProdukJualController::class, 'store'])->name('produk-jual.store');
	Route::get('produk-jual/edit/{id}', [ProdukJualController::class, 'edit'])->name('produk-jual.edit');
	Route::put('produk-jual/update/{id}', [ProdukJualController::class, 'update'])->name('produk-jual.update');
	Route::get('produk-jual/delete/{id}', [ProdukJualController::class, 'delete'])->name('produk-jual.delete');
	//Route untuk Kategori jual
	Route::get('kategori-jual/create', [KategoriProdukJualController::class, 'create'])->name('kategori-jual.create');
	Route::post('kategori-jual/store', [KategoriProdukJualController::class, 'store'])->name('kategori-jual.store');
	Route::get('kategori-jual/edit/{id}', [KategoriProdukJualController::class, 'edit'])->name('kategori-jual.edit');
	Route::put('kategori-jual/update/{id}', [KategoriProdukJualController::class, 'update'])->name('kategori-jual.update');
	Route::get('kategori-jual/delete/{id}', [KategoriProdukJualController::class, 'delete'])->name('kategori-jual.delete');

	//Route untuk Produk beli
	Route::get('produk-beli', [ProdukBeliController::class, 'index'])->name('produk-beli');
	Route::get('produk-beli/create', [ProdukBeliController::class, 'create'])->name('produk-beli.create');
	Route::post('produk-beli/store', [ProdukBeliController::class, 'store'])->name('produk-beli.store');
	Route::get('produk-beli/edit/{id}', [ProdukBeliController::class, 'edit'])->name('produk-beli.edit');
	Route::put('produk-beli/update/{id}', [ProdukBeliController::class, 'update'])->name('produk-beli.update');
	Route::get('produk-beli/delete/{id}', [ProdukBeliController::class, 'delete'])->name('produk-beli.delete');
	//Route untuk Kategori beli
	Route::get('kategori-beli/create', [KategoriProdukBeliController::class, 'create'])->name('kategori-beli.create');
	Route::post('kategori-beli/store', [KategoriProdukBeliController::class, 'store'])->name('kategori-beli.store');
	Route::get('kategori-beli/edit/{id}', [KategoriProdukBeliController::class, 'edit'])->name('kategori-beli.edit');
	Route::put('kategori-beli/update/{id}', [KategoriProdukBeliController::class, 'update'])->name('kategori-beli.update');
	Route::get('kategori-beli/delete/{id}', [KategoriProdukBeliController::class, 'delete'])->name('kategori-beli.delete');

	//Route untuk User
	Route::get('user', [UserController::class, 'index'])->name('user');
	Route::get('user/create', [UserController::class, 'create'])->name('user.create');
	Route::post('user', [UserController::class, 'store'])->name('user.store');
	Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
	Route::put('user/update/{id}', [UserController::class, 'update'])->name('user.update');
	Route::get('user/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

	//Route untuk Salesman
	Route::get('salesman', [SalesmanController::class, 'index'])->name('salesman');
	Route::get('salesman/create', [SalesmanController::class, 'create'])->name('salesman.create');
	Route::post('salesman', [SalesmanController::class, 'store'])->name('salesman.store');
	Route::get('salesman/edit/{id}', [SalesmanController::class, 'edit'])->name('salesman.edit');
	Route::put('salesman/update/{id}', [SalesmanController::class, 'update'])->name('salesman.update');
	Route::get('salesman/delete/{id}', [SalesmanController::class, 'delete'])->name('salesman.delete');

	//Route untuk Customer
	Route::get('customer', [CustomerController::class, 'index'])->name('customer');
	Route::get('customer/create', [CustomerController::class, 'create'])->name('customer.create');
	Route::post('customer', [CustomerController::class, 'store'])->name('customer.store');
	Route::get('customer/edit/{id}', [CustomerController::class, 'edit'])->name('customer.edit');
	Route::put('customer/update/{id}', [CustomerController::class, 'update'])->name('customer.update');
	Route::get('customer/delete/{id}', [CustomerController::class, 'delete'])->name('customer.delete');

	//Route untuk Supplier
	Route::get('supplier', [SupplierController::class, 'index'])->name('supplier');
	Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
	Route::post('supplier', [SupplierController::class, 'store'])->name('supplier.store');
	Route::get('supplier/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
	Route::put('supplier/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
	Route::get('supplier/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');

	//Logout lalu redirect ke halaman login
	Route::get('logout', [AuthController::class, 'logout'])->name('logout');

	// Route::middleware('hakakses:Owner')->group(function() {
	// });

	// Route::middleware('hakakses:Admin Kas')->group(function() {

	// });

	// Route::middleware('hakakses:Admin')->group(function() {

	// });
});
