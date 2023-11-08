<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'loginController@index');

Route::get('/logout',function(Request $request){
    $request->session()->forget('user');
    return redirect('/');
});

Route::get('/generate-barcode','titikController@generateBarcode');

Route::post('/login','loginController@login');

Route::get('/getMonitoring','dashboardController@index');
Route::get('/generateReport','dashboardController@generateReport');
Route::get('/getMonitoringToday','dashboardController@getDataToday');
Route::get('/dashboard','dashboardController@index');


Route::get('/titik','titikController@index');
Route::get('/titik/create','titikController@create');
Route::post('/titik/store','titikController@store');
Route::get('/titik/aktif/{id}','titikController@aktif');
Route::get('/titik/nonaktif/{id}','titikController@nonaktif');
Route::get('/titik/detail/{id}','titikController@detail');
Route::post('/titik/update','titikController@update');
Route::get('/titik/cetakBarcode/{id}','titikController@cetakBarcode');

Route::get('/petugas','PetugasController@index');
Route::get('/petugas/create','PetugasController@create');
Route::post('/petugas/store','PetugasController@store');
Route::get('/petugas/aktif/{id}','PetugasController@aktif');
Route::get('/petugas/nonaktif/{id}','PetugasController@nonaktif');
Route::get('/petugas/detail/{id}','PetugasController@detail');
Route::post('/petugas/update','PetugasController@update');

Route::get('/penanda', 'PenandaController@index')->name('penanda.index');
Route::get('/penanda/create','PenandaController@create')->name('penanda.create');
Route::post('/penanda/store','PenandaController@store')->name('penanda.store');
Route::get('/penanda/detail/{id}','PenandaController@detail')->name('penanda.detail');
Route::post('/penanda/update','PenandaController@update')->name('penanda.update');

