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
Route::get('/profile-definisi', function () {
    return view('profile.definisi');
});
Route::get('/profile-selayang-pandang', function () {
    return view('profile.selayang_pandang');
});
Route::get('/informasi-regulasi', function () {
    return view('informasi.regulasi');
});
Route::get('/informasi-agenda-kegiatan', function () {
    return view('informasi.agenda_kegiatan');
});
Route::get('/informasi-berita-artikel', function () {
    return view('informasi.berita_artikel');
});
Route::get('/kelitbangan', function () {
    return view('kelitbangan');
});
Route::get('/inovasi', function () {
    return view('inovasi');
});
Route::get('/galeri-foto', function () {
    return view('galeri.foto');
});
Route::get('/galeri-video', function () {
    return view('galeri.g_video');
});

Route::get('/forum-penelitian', function () {
    return view('forum.usulan_penelitian');
});
Route::get('/forum-inovasi', function () {
    return view('galeri.g_video');
});


