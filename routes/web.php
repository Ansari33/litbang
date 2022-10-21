<?php

use Illuminate\Support\Facades\Route;

use App\Helpers\HttpHelper;

use App\Http\Controllers\admin\KelitbanganController;
use App\Http\Controllers\admin\InovasiController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\admin\AgendaController;
use App\Http\Controllers\admin\BeritaController;
use App\Http\Controllers\admin\UsulanPenelitianController;
use App\Http\Controllers\admin\UsulanInovasiController;
use App\Http\Controllers\admin\ClientController;
use App\Http\Controllers\admin\SuratController;
use App\Http\Controllers\admin\SurveyController;
use App\Http\Controllers\admin\RegulasiController;




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

Route::get('/tesupload', function(){
    return view('tes-upload');
});
Route::post('/upload-attachment', [KelitbanganController::class, 'attachment']);

Route::get('/', [ClientController::class, 'index']);
Route::get('/view-kelitbangan/{id}', [ClientController::class, 'viewKelitbangan']);
Route::get('/view-inovasi/{id}', [ClientController::class, 'viewInovasi']);
Route::get('/view-usulan-penelitian/{id}', [ClientController::class, 'viewUsulanPenelitian']);
Route::get('/view-usulan-inovasi/{id}', [ClientController::class, 'viewUsulanInovasi']);
Route::get('/view-berita/{id}', [ClientController::class, 'viewBerita']);

Route::get('/profile-definisi', function () {
    return view('profile.definisi');
});
Route::get('/profile-selayang-pandang', function () {
    return view('profile.selayang_pandang');
});
Route::get('/informasi-regulasi', [ClientController::class, 'regulasi']);
Route::get('/informasi-agenda-kegiatan',[ClientController::class, 'agenda']);
Route::get('/informasi-berita-artikel', [ClientController::class, 'berita']);
Route::get('/kelitbangan', [ClientController::class, 'kelitbangan']);
Route::get('/inovasi', [ClientController::class, 'inovasi']);

Route::get('/galeri-foto', [ClientController::class, 'galeriFoto']);
Route::get('/galeri-video', [ClientController::class, 'galeriVideo']);

Route::get('/forum-penelitian', [ClientController::class, 'forumPenelitian']);
Route::get('/usul-penelitian',  [ClientController::class, 'buatPenelitian']);
Route::post('/usulan-penelitian-store', [UsulanPenelitianController::class, 'store']);

Route::get('/forum-inovasi', [ClientController::class, 'forumInovasi']);
Route::get('/usul-inovasi',  [ClientController::class, 'buatInovasi']);
Route::post('/usulan-inovasi-store', [UsulanInovasiController::class, 'store']);

Route::get('/forum-survey', [ClientController::class, 'forumSurvey']);
Route::get('/forum-rekomendasi', [ClientController::class, 'forumRekomendasi']);

Route::get('/download-regulasi/{id}',[RegulasiController::class, 'downloadRegulasi']);
Route::get('/upload-regulasi',[RegulasiController::class, 'uploadFile']);

Route::get('/login', function () {
    if(Session::get('authenticated')){
        $cek = HttpHelper::check_token();

        if ($cek['status_code'] != 500){
            return redirect('/litbang-admin');
        }
    }
    return view('auth.login');
});


Route::post('login', [AuthController::class, 'authenticate'])->name('login');
Route::get('refresh-token', [AuthController::class, 'refreshToken']);
Route::get('auth/check', [AuthController::class, 'authCheck']);
Route::group(['middleware' => 'checkauth'], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

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

    ## Berita
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

    ## Usulan Inovasi
    Route::get('/admin-usulan-inovasi', [UsulanInovasiController::class, 'index']);
    Route::get('/usulan-inovasi-list', [UsulanInovasiController::class, 'list']);
    Route::get('/usulan-inovasi-tambah', [UsulanInovasiController::class, 'create']);
//    Route::post('/usulan-penelitian-store', [UsulanPenelitianController::class, 'store']);
    Route::get('/usulan-inovasi-edit/{id}', [UsulanInovasiController::class, 'edit']);
    Route::post('/usulan-inovasi-update', [UsulanInovasiController::class, 'update']);
    Route::get('/usulan-inovasi-delete/{id}', [UsulanInovasiController::class, 'delete']);

    ## Surat
    Route::get('/admin-surat',[SuratController::class, 'index']);
    Route::get('/surat-keluar-index',[SuratController::class, 'indexSuratKeluar']);
    Route::get('/surat-keluar-list',[SuratController::class, 'listSuratKeluar']);
    Route::get('/surat-keluar-tambah',[SuratController::class, 'createSuratKeluar']);
    Route::post('/surat-keluar-store',[SuratController::class, 'storeSuratKeluar']);
    Route::get('/surat-keluar-edit/{id}',[SuratController::class, 'editSuratKeluar']);
    Route::post('/surat-keluar-update',[SuratController::class, 'updateSuratKeluar']);
    Route::get('/surat-keluar-delete/{id}',[SuratController::class, 'deleteSuratKeluar']);
    Route::get('/open-file/{file}',[SuratController::class, 'openFile']);

    Route::get('/surat-masuk-index',[SuratController::class, 'indexSuratMasuk']);
    Route::get('/surat-masuk-list',[SuratController::class, 'listSuratMasuk']);
    Route::get('/surat-masuk-tambah',[SuratController::class, 'createSuratMasuk']);
    Route::post('/surat-masuk-store',[SuratController::class, 'storeSuratMasuk']);
    Route::get('/surat-masuk-edit/{id}',[SuratController::class, 'editSuratMasuk']);
    Route::post('/surat-masuk-update',[SuratController::class, 'updateSuratMasuk']);
    Route::get('/surat-masuk-delete/{id}',[SuratController::class, 'deleteSuratMasuk']);
    Route::get('/download-surat-masuk/{id}',[SuratController::class, 'downloadSuratMasuk']);

    ## Regulasi
    Route::get('/admin-regulasi',[RegulasiController::class, 'index']);
    Route::get('/regulasi-list',[RegulasiController::class, 'list']);
    Route::get('/regulasi-tambah',[RegulasiController::class, 'create']);
    Route::post('/regulasi-store',[RegulasiController::class, 'store']);
    Route::get('/regulasi-edit/{id}',[RegulasiController::class, 'edit']);
    Route::post('/regulasi-update',[RegulasiController::class, 'update']);
    Route::get('/regulasi-delete/{id}',[RegulasiController::class, 'delete']);

    ## Regulasi
    Route::get('/admin-survey',[SurveyController::class, 'index']);
    Route::get('/survey-list',[SurveyController::class, 'list']);
    Route::get('/survey-tambah',[SurveyController::class, 'create']);
    Route::post('/survey-store',[SurveyController::class, 'store']);
    Route::get('/survey-edit/{id}',[SurveyController::class, 'edit']);
    Route::post('/survey-update',[SurveyController::class, 'update']);
    Route::get('/survey-delete/{id}',[SurveyController::class, 'delete']);
    Route::get('/survey-hasil/{id}',[SurveyController::class, 'hasil']);

    Route::get('/litbang-admin', function () {
        return view('admin.home');
    });
    Route::get('/admin-survey', [SurveyController::class, 'index']);

    //Route::get('/redirect', [AuthController::class, 'redirectToProvider']);
    Route::get('/callback', [AuthController::class, 'handleProviderCallback']);


    #['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);


});
Route::get('/redirect', [AuthController::class, 'redirectToProvider']);







