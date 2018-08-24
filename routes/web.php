<?php

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

// route auth login dan register
Auth::routes();

Route::middleware(['web', 'auth'])->group(function (){
	
	Route::get('/', 'DashboardController@index');

	Route::middleware(['admin'])->group(function(){
		Route::get('admin', function (){
			return view('admin.dashboard');
		});
		Route::resource('ibu', 'IbuController');
		Route::resource('anak', 'AnakController');
		Route::resource('ibuhamil', 'IbuHamilController');
		Route::resource('kader', 'KaderController');
		Route::resource('pengguna', 'PenggunaController');
		Route::resource('agenda', 'AgendaController');
		Route::resource('bukutamu', 'BukuTamuController');
	});

	Route::middleware(['user'])->group(function(){
		Route::get('user', function (){
			return view('user.dashboard');
		});
	});
});


// Route::name('user.')->group(function () {
// 	Route::get('/', 'UserController@getLogin')->name('login');
// 	Route::post('/', 'UserController@postLogin')->name('login');

// 	Route::get('logout', 'UserController@getLogout')->name('logout');

//     Route::middleware(['admin'])->group(function(){
//     	Route::get('admin', 'AdminController@getAdmin')->name('admin');
// 	});

// 	Route::middleware(['user'])->group(function(){
// 		Route::get('ibu', 'UserController@getIbu')->name('ibu');
// 	});
// });