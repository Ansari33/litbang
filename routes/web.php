<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\KelitbanganController;
use App\Http\Controllers\admin\InovasiController;
use App\Http\Controllers\Auth\AuthController;

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


Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', function () { return view('auth.login'); });
Route::post('login', [AuthController::class, 'authenticate'])->name('login');
Route::get('refresh-token', ['as'=>'refresh','uses'=>'Auth\AuthController@refreshToken']);
Route::get('auth/check', ['as'=>'check','uses'=>'Auth\AuthController@authCheck']);
Route::group(['middleware' => 'checkauth'], function () {
    Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
    Route::get('/litbang-admin', function () {
        return view('admin.home');
    });
    ## Kelitbangan
    Route::get('/admin-kelitbangan', [KelitbanganController::class, 'index']);
    Route::get('/kelitbangan-list', [KelitbanganController::class, 'list']);
    Route::get('/kelitbangan-tambah', [KelitbanganController::class, 'create']);
    Route::post('/kelitbangan-store', [KelitbanganController::class, 'store']);
    Route::get('/kelitbangan-edit/{id}', [KelitbanganController::class, 'edit']);
    Route::post('/kelitbangan-update', [KelitbanganController::class, 'update']);
    Route::get('/kelitbangan-delete/{id}', [KelitbanganController::class, 'delete']);

    ## Inovasii
    Route::get('/admin-inovasi', [InovasiController::class, 'index']);
    Route::get('/inovasi-list', [InovasiController::class, 'list']);
    Route::get('/inovasi-tambah', [InovasiController::class, 'create']);
    Route::post('/inovasi-store', [InovasiController::class, 'store']);
    Route::get('/inovasi-edit/{id}', [InovasiController::class, 'edit']);
    Route::post('/inovasi-update', [InovasiController::class, 'update']);
    Route::get('/inovasi-delete/{id}', [InovasiController::class, 'delete']);
});





