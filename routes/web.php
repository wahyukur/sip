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
// Auth::routes();

Route::middleware(['guest'])->group(function(){
	Route::get('/', 'AuthController@getLogin')->name('login');
	Route::post('postlogin', 'AuthController@postLogin')->name('postlogin');
});

Route::middleware(['web', 'auth'])->group(function(){

	Route::middleware(['admin'])->group(function(){
		Route::get('admin', 'DashboardController@index')->name('admin');
		Route::resource('ibu', 'IbuController');
		Route::resource('anak', 'AnakController');
		Route::resource('ibuhamil', 'IbuHamilController');
		Route::post('bumil_meninggal', 'IbuHamilController@meninggal')->name('bumil_meninggal');
		Route::post('bumil_melahirkan', 'IbuHamilController@melahirkan')->name('bumil_melahirkan');
		Route::resource('kader', 'KaderController');
		Route::resource('pengguna', 'PenggunaController');
		// Route::get('userDetail/{id}', 'PenggunaController@profile')->name('userDetail');
		Route::resource('agenda', 'AgendaController');
		Route::resource('bukutamu', 'BukuTamuController');
		Route::resource('timbang', 'TimbangController');
		Route::resource('imunisasi', 'ImunisasiController');
		Route::resource('vitA', 'VitAController');
		Route::resource('kegiatan', 'KegiatanController');
		Route::resource('jenisimunisasi', 'JenisImunisasiController');
		Route::resource('laporan', 'LaporanController');

		Route::get('printAnak', 'AnakController@printAnak')->name('printAnak');
		Route::get('form1', 'LaporanController@form1')->name('form1');
		Route::get('form2', 'LaporanController@form2')->name('form2');
		Route::get('form3', 'LaporanController@form3')->name('form3');
		Route::get('form4', 'LaporanController@form4')->name('form4');
		Route::get('form5', 'LaporanController@form5')->name('form5');
		Route::get('form6', 'LaporanController@form6')->name('form6');
		Route::get('form7', 'LaporanController@form7')->name('form7');

		// UKM dan PKK Route
		Route::get('viewPKK', 'KegiatanController@viewPKK')->name('viewPKK');
		Route::post('storePKK', 'KegiatanController@storePKK')->name('storePKK');
		Route::get('editPKK/{id}', 'KegiatanController@editPKK')->name('editPKK');
		Route::post('updatePKK/{id}', 'KegiatanController@updatePKK')->name('updatePKK');
		Route::get('deletePKK/{id}', 'KegiatanController@deletePKK')->name('deletePKK');

		Route::get('viewUKM', 'KegiatanController@viewUKM')->name('viewUKM');
		Route::post('storeUKM', 'KegiatanController@storeUKM')->name('storeUKM');
		Route::get('editUKM/{id}', 'KegiatanController@editUKM')->name('editUKM');
		Route::post('updateUKM/{id}', 'KegiatanController@updateUKM')->name('updateUKM');
		Route::get('deleteUKM/{id}', 'KegiatanController@deleteUKM')->name('deleteUKM');
		/////////////

		// Status Gizi, BGM dan 2T
		Route::resource('statusgizi', 'StatusController');
		Route::get('bgm2t', 'StatusController@viewBGM')->name('viewBGM');
		/////////////

		// Gallery Route
		Route::get('albumList', 'AgendaController@albumList')->name('albumList');
		Route::post('albumStore', 'AgendaController@albumStore')->name('albumStore');
		Route::get('albumDetail/{id}', 'AgendaController@albumDetail')->name('albumDetail');
		Route::get('albumDelete/{id}', 'AgendaController@albumStore')->name('albumDelete');
		// Route::get('viewImage', 'AgendaController@viewImage')->name('viewImage');
		Route::get('addImage/{id}', 'AgendaController@addImage')->name('addImage');
		Route::post('storeImage', 'AgendaController@storeImage')->name('storeImage');
		Route::get('deleteImage/{id}', 'AgendaController@deleteImage')->name('deleteImage');
		/////////////
	});

	Route::middleware(['user'])->group(function(){
		Route::get('user', function (){
			return view('user.dashboard');
		})->name('user');
	});

	Route::get('logout', 'DashboardController@getLogout')->name('logout');
});



// Route::middleware(['web', 'auth'])->group(function (){
	
// 	Route::get('/', 'DashboardController@index');

// 	Route::middleware(['admin'])->group(function(){
// 		Route::get('admin', function (){
// 			return view('admin.dashboard');
// 		});
// 		Route::resource('ibu', 'IbuController');
// 		Route::resource('anak', 'AnakController');
// 		Route::resource('ibuhamil', 'IbuHamilController');
// 		Route::resource('kader', 'KaderController');
// 		Route::resource('pengguna', 'PenggunaController');
// 		Route::resource('agenda', 'AgendaController');
// 		Route::resource('bukutamu', 'BukuTamuController');
// 		Route::resource('timbang', 'TimbangController');
// 		Route::resource('vitA', 'VitAController');
// 		Route::resource('kegiatan', 'KegiatanController');
// 		Route::resource('jenisimunisasi', 'JenisImunisasiController');
// 	});

// 	Route::middleware(['user'])->group(function(){
// 		Route::get('user', function (){
// 			return view('user.dashboard');
// 		});
// 	});
// });