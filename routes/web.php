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

Route::get('/', function () {
    return view('home');
});
Route::get('/profile/definisi', function () {
    return view('profile.definisi');
});
Route::get('/profile/selayang-pandang', function () {
    return view('profile.selayang_pandang');
});
Route::get('/informasi/regulasi', function () {
    return view('informasi.regulasi');
});
Route::get('/informasi/agenda-kegiatan', function () {
    return view('informasi.agenda_kegiatan');
});
Route::get('/informasi/berita-artikel', function () {
    return view('informasi.berita_artikel');
});
Route::get('/kelitbangan', function () {
    return view('kelitbangan');
});

