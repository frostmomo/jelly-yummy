<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\PenjualanController;
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
	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
	Route::get('map', function () {
		return view('pages.maps');
	})->name('map');
	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');
	Route::get('table-list', function () {
		return view('pages.tables');
	})->name('table');
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
});
