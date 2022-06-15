<?php

use Illuminate\Support\Facades\Route;

use App\Helpers\HttpHelper;

use App\Http\Controllers\admin\KelitbanganController;
use App\Http\Controllers\admin\InovasiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\admin\AgendaController;
use App\Http\Controllers\admin\BeritaController;
use App\Http\Controllers\admin\UsulanPenelitianController;



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
    $data = HttpHelper::usulan_penelitian_list()['data'];
    return view('forum.usulan_penelitian',compact('data'));
});

Route::get('/usul-penelitian', function () {
    $data =(HttpHelper::instansi_list())['data'];
    $instansi = collect($data)->pluck('nama','id')->toArray();
    return view('forum.buat_penelitian',compact('instansi'));
});

Route::post('/usulan-penelitian-store', [UsulanPenelitianController::class, 'store']);

Route::get('/forum-inovasi', function () {
    return view('galeri.g_video');
});


Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', function () { return view('auth.login'); });
Route::post('login', [AuthController::class, 'authenticate'])->name('login');
Route::get('refresh-token', [AuthController::class, 'refreshToken']);
#['as'=>'refresh','uses'=>'Auth\AuthController@refreshToken']);
Route::get('auth/check', [AuthController::class, 'authCheck']);
#['as'=>'check','uses'=>'Auth\AuthController@authCheck']);
Route::group(['middleware' => 'checkauth'], function () {
    Route::get('logout', [AuthController::class, 'logout']);

    ## Kelitbangan
    Route::get('/admin-kelitbangan', [KelitbanganController::class, 'index']);
    Route::get('/kelitbangan-list', [KelitbanganController::class, 'list']);
    Route::get('/kelitbangan-tambah', [KelitbanganController::class, 'create']);
    Route::post('/kelitbangan-store', [KelitbanganController::class, 'store']);
    Route::get('/kelitbangan-edit/{id}', [KelitbanganController::class, 'edit']);
    Route::post('/kelitbangan-update', [KelitbanganController::class, 'update']);
    Route::get('/kelitbangan-delete/{id}', [KelitbanganController::class, 'delete']);

    ## Inovasi
    Route::get('/admin-inovasi', [InovasiController::class, 'index']);
    Route::get('/inovasi-list', [InovasiController::class, 'list']);
    Route::get('/inovasi-tambah', [InovasiController::class, 'create']);
    Route::post('/inovasi-store', [InovasiController::class, 'store']);
    Route::get('/inovasi-edit/{id}', [InovasiController::class, 'edit']);
    Route::post('/inovasi-update', [InovasiController::class, 'update']);
    Route::get('/inovasi-delete/{id}', [InovasiController::class, 'delete']);

    ## Agenda
    Route::get('/admin-agenda', [AgendaController::class, 'index']);
    Route::get('/agenda-list', [AgendaController::class, 'list']);
    Route::get('/agenda-tambah', [AgendaController::class, 'create']);
    Route::post('/agenda-store', [AgendaController::class, 'store']);
    Route::get('/agenda-edit/{id}', [AgendaController::class, 'edit']);
    Route::post('/agenda-update', [AgendaController::class, 'update']);
    Route::get('/agenda-delete/{id}', [AgendaController::class, 'delete']);

    ## Agenda
    Route::get('/admin-berita', [BeritaController::class, 'index']);
    Route::get('/berita-list', [BeritaController::class, 'list']);
    Route::get('/berita-tambah', [BeritaController::class, 'create']);
    Route::post('/berita-store', [BeritaController::class, 'store']);
    Route::get('/berita-edit/{id}', [BeritaController::class, 'edit']);
    Route::post('/berita-update', [BeritaController::class, 'update']);
    Route::get('/berita-delete/{id}', [BeritaController::class, 'delete']);

    ## Usulan Penelitian
    Route::get('/admin-usulan-penelitian', [UsulanPenelitianController::class, 'index']);
    Route::get('/usulan-penelitian-list', [UsulanPenelitianController::class, 'list']);
    Route::get('/usulan-penelitian-tambah', [UsulanPenelitianController::class, 'create']);
//    Route::post('/usulan-penelitian-store', [UsulanPenelitianController::class, 'store']);
    Route::get('/usulan-penelitian-edit/{id}', [UsulanPenelitianController::class, 'edit']);
    Route::post('/usulan-penelitian-update', [UsulanPenelitianController::class, 'update']);
    Route::get('/usulan-penelitian-delete/{id}', [UsulanPenelitianController::class, 'delete']);


    #['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);
    Route::get('/litbang-admin', function () { return view('admin.home'); });

});





