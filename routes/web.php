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
use App\Http\Controllers\admin\SuratRekomendasiController;
use App\Http\Controllers\admin\LayananIncubatorController;
use App\Http\Controllers\admin\JenisLayananIncubatorController;
use App\Http\Controllers\admin\InformasiPublikController;
use App\Http\Controllers\admin\KategoriInformasiPublikController;
use App\Http\Controllers\admin\ProfilController;




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
Route::get('/profile/{id}', [ClientController::class,'getProfile']);
Route::get('/tesupload', function(){
    return view('tes-upload');
});
Route::post('/upload-attachment', [KelitbanganController::class, 'attachment']);
Route::post('/upload-rangkuman', [KelitbanganController::class, 'rangkuman']);
Route::post('/upload-laporan-penelitian', [ClientController::class, 'uploadLaporanPenelitian']);

Route::get('/', [ClientController::class, 'index']);
Route::get('/view-kelitbangan/{id}', [ClientController::class, 'viewKelitbangan']);
Route::get('/view-inovasi/{id}', [ClientController::class, 'viewInovasi']);
Route::get('/view-usulan-penelitian/{id}', [ClientController::class, 'viewUsulanPenelitian']);
Route::get('/view-usulan-inovasi/{id}', [ClientController::class, 'viewUsulanInovasi']);
Route::get('/view-berita/{id}', [ClientController::class, 'viewBerita']);
Route::post('/buat-komentar', [ClientController::class, 'buatKomentar']);

Route::get('/profile-definisi', function () {
    return view('profile.definisi');
});
Route::get('/profile-selayang-pandang', function () {
    return view('profile.selayang_pandang');
});
Route::get('/informasi-regulasi', [ClientController::class, 'regulasi']);
Route::get('/informasi-agenda-kegiatan',[ClientController::class, 'agenda']);
Route::get('/informasi-berita-artikel', [ClientController::class, 'berita']);

Route::get('/informasi/{j}', [ClientController::class, 'informasiPerJenis']);
Route::get('/informasi-by-kategori/{j}', [ClientController::class, 'informasiPerKategori']);

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
Route::get('/forum-incubator', [ClientController::class, 'forumIncubator']);
Route::get('/pengajuan-incubator', [ClientController::class, 'pengajuanIncubator']);
Route::post('/layanan-incubator-store', [LayananIncubatorController::class, 'store']);

Route::get('/download-regulasi/{id}',[RegulasiController::class, 'downloadRegulasi']);
Route::post('/upload-regulasi',[RegulasiController::class, 'uploadFile']);
Route::post('/upload-laporan-penelitian',[ClientController::class, 'uploadLaporanPenelitian']);
Route::post('/upload-surat-masuk',[SuratController::class, 'uploadSuratMasuk']);
Route::post('/upload-surat-keluar',[SuratController::class, 'uploadSuratKeluar']);

Route::post('/surat-rekomendasi-store', [SuratRekomendasiController::class, 'store']);

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
    Route::post('/kelitbangan-list-tanggal', [KelitbanganController::class, 'listByTanggal']);
    Route::get('/kelitbangan-tambah/{b}', [KelitbanganController::class, 'create']);
    Route::post('/kelitbangan-store', [KelitbanganController::class, 'store']);
    Route::get('/kelitbangan-edit/{id}', [KelitbanganController::class, 'edit']);
    Route::post('/kelitbangan-update', [KelitbanganController::class, 'update']);
    Route::get('/kelitbangan-delete/{id}', [KelitbanganController::class, 'delete']);

    Route::get('/kelitbangan-bidang-index', [KelitbanganController::class, 'indexBidang']);
    Route::get('/kelitbangan-bidang-list', [KelitbanganController::class, 'listBidang']);
    Route::get('/kelitbangan-bidang/{id}', [KelitbanganController::class, 'indexByBidang']);
    Route::post('/kelitbangan-list-by-bidang', [KelitbanganController::class, 'listByBidang']);
    Route::get('/kelitbangan-tambah-bidang', [KelitbanganController::class, 'createBidang']);
    Route::post('/kelitbangan-store-bidang', [KelitbanganController::class, 'storeBidang']);
    Route::get('/kelitbangan-edit-bidang/{id}', [KelitbanganController::class, 'editBidang']);
    Route::post('/kelitbangan-update-bidang', [KelitbanganController::class, 'updateBidang']);
    Route::get('/kelitbangan-delete-bidang/{id}', [KelitbanganController::class, 'deleteBidang']);

    ## Inovasi
    Route::get('/admin-inovasi', [InovasiController::class, 'index']);
    Route::get('/inovasi-list', [InovasiController::class, 'list']);
    Route::post('/inovasi-list-tanggal', [InovasiController::class, 'listByTanggal']);
    Route::get('/inovasi-tambah', [InovasiController::class, 'create']);
    Route::post('/inovasi-store', [InovasiController::class, 'store']);
    Route::get('/inovasi-edit/{id}', [InovasiController::class, 'edit']);
    Route::post('/inovasi-update', [InovasiController::class, 'update']);
    Route::get('/inovasi-delete/{id}', [InovasiController::class, 'delete']);

    ## Agenda
    Route::get('/admin-agenda', [AgendaController::class, 'index']);
    Route::get('/agenda-list', [AgendaController::class, 'list']);
    Route::post('/agenda-list-tanggal', [AgendaController::class, 'listByTanggal']);
    Route::get('/agenda-tambah', [AgendaController::class, 'create']);
    Route::post('/agenda-store', [AgendaController::class, 'store']);
    Route::get('/agenda-edit/{id}', [AgendaController::class, 'edit']);
    Route::post('/agenda-update', [AgendaController::class, 'update']);
    Route::get('/agenda-delete/{id}', [AgendaController::class, 'delete']);

    ## Berita
    Route::get('/admin-berita', [BeritaController::class, 'index']);
    Route::get('/berita-list', [BeritaController::class, 'list']);
    Route::post('/berita-list-tanggal', [BeritaController::class, 'listByTanggal']);
    Route::get('/berita-tambah', [BeritaController::class, 'create']);
    Route::post('/berita-store', [BeritaController::class, 'store']);
    Route::get('/berita-edit/{id}', [BeritaController::class, 'edit']);
    Route::post('/berita-update', [BeritaController::class, 'update']);
    Route::get('/berita-delete/{id}', [BeritaController::class, 'delete']);

    ## Usulan Penelitian
    Route::get('/admin-usulan-penelitian', [UsulanPenelitianController::class, 'index']);
    Route::get('/usulan-penelitian-list', [UsulanPenelitianController::class, 'list']);
    Route::post('/usulan-penelitian-list-tanggal', [UsulanPenelitianController::class, 'listByTanggal']);
    Route::get('/usulan-penelitian-tambah', [UsulanPenelitianController::class, 'create']);
//    Route::post('/usulan-penelitian-store', [UsulanPenelitianController::class, 'store']);
    Route::get('/usulan-penelitian-edit/{id}', [UsulanPenelitianController::class, 'edit']);
    Route::post('/usulan-penelitian-update', [UsulanPenelitianController::class, 'update']);
    Route::post('/usulan-penelitian-update-status', [UsulanPenelitianController::class, 'updateStatus']);
    Route::get('/usulan-penelitian-delete/{id}', [UsulanPenelitianController::class, 'delete']);

    ## Usulan Inovasi
    Route::get('/admin-usulan-inovasi', [UsulanInovasiController::class, 'index']);
    Route::get('/usulan-inovasi-list', [UsulanInovasiController::class, 'list']);
    Route::post('/usulan-inovasi-list-tanggal', [UsulanInovasiController::class, 'listByTanggal']);
    Route::get('/usulan-inovasi-tambah', [UsulanInovasiController::class, 'create']);
//    Route::post('/usulan-penelitian-store', [UsulanPenelitianController::class, 'store']);
    Route::get('/usulan-inovasi-edit/{id}', [UsulanInovasiController::class, 'edit']);
    Route::post('/usulan-inovasi-update', [UsulanInovasiController::class, 'update']);
    Route::get('/usulan-inovasi-delete/{id}', [UsulanInovasiController::class, 'delete']);
    Route::post('/usulan-inovasi-update-status', [UsulanInovasiController::class, 'updateStatus']);

    ## Surat
    Route::get('/admin-surat',[SuratController::class, 'index']);
    Route::get('/surat-keluar-index',[SuratController::class, 'indexSuratKeluar']);
    Route::get('/surat-keluar-list',[SuratController::class, 'listSuratKeluar']);
    Route::post('/surat-keluar-list-tanggal',[SuratController::class, 'listSuratKeluarByTanggal']);
    Route::get('/surat-keluar-tambah',[SuratController::class, 'createSuratKeluar']);
    Route::post('/surat-keluar-store',[SuratController::class, 'storeSuratKeluar']);
    Route::get('/surat-keluar-edit/{id}',[SuratController::class, 'editSuratKeluar']);
    Route::post('/surat-keluar-update',[SuratController::class, 'updateSuratKeluar']);
    Route::get('/surat-keluar-delete/{id}',[SuratController::class, 'deleteSuratKeluar']);
    Route::get('/open-file/{file}',[SuratController::class, 'openFile']);

    Route::get('/surat-masuk-index',[SuratController::class, 'indexSuratMasuk']);
    Route::get('/surat-masuk-list',[SuratController::class, 'listSuratMasuk']);
    Route::post('/surat-masuk-list-tanggal',[SuratController::class, 'listSuratMasukByTanggal']);
    Route::get('/surat-masuk-tambah',[SuratController::class, 'createSuratMasuk']);
    Route::post('/surat-masuk-store',[SuratController::class, 'storeSuratMasuk']);
    Route::get('/surat-masuk-edit/{id}',[SuratController::class, 'editSuratMasuk']);
    Route::post('/surat-masuk-update',[SuratController::class, 'updateSuratMasuk']);
    Route::get('/surat-masuk-delete/{id}',[SuratController::class, 'deleteSuratMasuk']);
    Route::get('/download-surat-masuk/{id}',[SuratController::class, 'downloadSuratMasuk']);


    Route::get('/jenis-surat-index',[SuratController::class, 'indexJenisSurat']);
    Route::get('/jenis-surat-list',[SuratController::class, 'listJenisSurat']);
    Route::get('/jenis-surat-tambah',[SuratController::class, 'createJenisSurat']);
    Route::post('/jenis-surat-store',[SuratController::class, 'storeJenisSurat']);
    Route::get('/jenis-surat-edit/{id}',[SuratController::class, 'editJenisSurat']);
    Route::post('/jenis-surat-update',[SuratController::class, 'updateJenisSurat']);
    Route::get('/jenis-surat-delete/{id}',[SuratController::class, 'deleteJenisSurat']);

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

    ## Surat Rekomendasi
    Route::get('/admin-surat-rekomendasi', [SuratRekomendasiController::class, 'index']);
    Route::get('/surat-rekomendasi-list', [SuratRekomendasiController::class, 'list']);
    Route::post('/surat-rekomendasi-list-tanggal', [SuratRekomendasiController::class, 'listByTanggal']);
    Route::get('/surat-rekomendasi-tambah', [SuratRekomendasiController::class, 'create']);
    #Route::post('/surat-rekomendasi-store', [SuratRekomendasiController::class, 'store']);
    Route::get('/surat-rekomendasi-edit/{id}', [SuratRekomendasiController::class, 'edit']);
    Route::post('/surat-rekomendasi-update', [SuratRekomendasiController::class, 'update']);
    Route::get('/surat-rekomendasi-delete/{id}', [SuratRekomendasiController::class, 'delete']);

    ## Layanan Icubator
    Route::get('/admin-layanan-incubator', [LayananIncubatorController::class, 'index']);
    Route::get('/layanan-incubator-list', [LayananIncubatorController::class, 'list']);
    Route::post('/layanan-incubatori-list-tanggal', [LayananIncubatorController::class, 'listByTanggal']);
    Route::get('/layanan-incubator-tambah', [LayananIncubatorController::class, 'create']);
    #Route::post('/surat-rekomendasi-store', [SuratRekomendasiController::class, 'store']);
    Route::get('/layanan-incubator-edit/{id}', [LayananIncubatorController::class, 'edit']);
    Route::post('/layanan-incubator-update', [LayananIncubatorController::class, 'update']);
    Route::get('/layanan-incubator-delete/{id}', [LayananIncubatorController::class, 'delete']);


    ## Jenis Layanan Icubator
    Route::get('/admin-jenis-layanan-incubator', [JenisLayananIncubatorController::class, 'index']);
    Route::get('/jenis-layanan-incubator-list', [JenisLayananIncubatorController::class, 'list']);
    Route::post('/jenis-layanan-incubatori-list-tanggal', [JenisLayananIncubatorController::class, 'listByTanggal']);
    Route::get('/jenis-layanan-incubator-tambah', [JenisLayananIncubatorController::class, 'create']);
    Route::post('/jenis-layanan-incubator-store', [JenisLayananIncubatorController::class, 'store']);
    Route::get('/jenis-layanan-incubator-edit/{id}', [JenisLayananIncubatorController::class, 'edit']);
    Route::post('/jenis-layanan-incubator-update', [JenisLayananIncubatorController::class, 'update']);
    Route::get('/jenis-layanan-incubator-delete/{id}', [JenisLayananIncubatorController::class, 'delete']);

    ## Informasi Publik
    Route::get('/admin-informasi-publik', [InformasiPublikController::class, 'index']);
    Route::get('/informasi-publik-list', [InformasiPublikController::class, 'list']);
    Route::post('/informasi-publik-list-tanggal', [InformasiPublikController::class, 'listByTanggal']);
    Route::get('/informasi-publik-tambah', [InformasiPublikController::class, 'create']);
    Route::post('/informasi-publik-store', [InformasiPublikController::class, 'store']);
    Route::get('/informasi-publik-edit/{id}', [InformasiPublikController::class, 'edit']);
    Route::post('/informasi-publik-update', [InformasiPublikController::class, 'update']);
    Route::get('/informasi-publik-delete/{id}', [InformasiPublikController::class, 'delete']);


    ## Kategori Informasi Publik
    Route::get('/admin-kategori-informasi-publik', [KategoriInformasiPublikController::class, 'index']);
    Route::get('/kategori-informasi-publik-list', [KategoriInformasiPublikController::class, 'list']);
    Route::post('/kategori-informasi-publik-list-tanggal', [KategoriInformasiPublikController::class, 'listByTanggal']);
    Route::get('/kategori-informasi-publik-tambah', [KategoriInformasiPublikController::class, 'create']);
    Route::post('/kategori-informasi-publik-store', [KategoriInformasiPublikController::class, 'store']);
    Route::get('/kategori-informasi-publik-edit/{id}', [KategoriInformasiPublikController::class, 'edit']);
    Route::post('/kategori-informasi-publik-update', [KategoriInformasiPublikController::class, 'update']);
    Route::get('/kategori-informasi-publik-delete/{id}', [KategoriInformasiPublikController::class, 'delete']);
    Route::get('/kategori-informasi-publik-by-jenis/{id}', [KategoriInformasiPublikController::class, 'getByJenis']);

    ## Profil
    Route::get('/admin-profil', [ProfilController::class, 'index']);
    Route::get('/profil-list', [ProfilController::class, 'list']);
    Route::post('/profil-list-tanggal', [ProfilController::class, 'listByTanggal']);
    Route::get('/profil-tambah', [ProfilController::class, 'create']);
    Route::post('/profil-store', [ProfilController::class, 'store']);
    Route::get('/profil-edit/{id}', [ProfilController::class, 'edit']);
    Route::post('/profil-update', [ProfilController::class, 'update']);
    Route::get('/profil-delete/{id}', [ProfilController::class, 'delete']);
    Route::get('/profil-by-jenis/{id}', [ProfilController::class, 'getByJenis']);


    Route::get('/litbang-admin', [KelitbanganController::class,'dashboard']);
    Route::get('/admin-survey', [SurveyController::class, 'index']);

    //Route::get('/redirect', [AuthController::class, 'redirectToProvider']);
    Route::get('/callback', [AuthController::class, 'handleProviderCallback']);


    #['as' => 'logout', 'uses' => 'Auth\AuthController@logout']);


});
Route::get('/redirect', [AuthController::class, 'redirectToProvider']);







