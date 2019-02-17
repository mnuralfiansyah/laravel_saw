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

// Route::get('/', function () {return redirect('/data_kriteria');});
//Route::get('/', function () {return redirect('/data_alternatif')->with('Berhasil', 'Selamat Datang.');});

Route::Resource('data_hasil','HasilController');
Route::Resource('data_perhitungan','PerhitunganController');
Route::Resource('pdf','PdfController');
Route::Resource('data_alternatif','AlternatifController');
Route::Resource('data_bobot_alternatif','BobotAlternatifController');
Route::Resource('data_kriteria','KriteriaController');
Auth::routes();
