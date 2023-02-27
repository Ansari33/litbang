<?php

namespace App\Helpers;

use AppHelper;
use Illuminate\Support\Env;
use Response;
use Session;
use Illuminate\Support\Facades\Http;
use Log;

/**
 * Class to handle all RESTful requests
 */
class HttpHelper {
	private static $api;

	public function __construct() {
		// env('API_ADDRESS') = 'accounting.backend:8000/api/';
		//env('API_ADDRESS') = env('API_ADDRESS');
	}

	/*
	|--------------------------------------------------------------------------
	| Auth
	|--------------------------------------------------------------------------
	*/

	public static function login($request) {
		$response = Http::timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'auth/login', $request);
		return $response;
	}

	public static function logout() {
		return  Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'auth/logout');
		return $response;
	}

	public static function refresh_token() {
		$response = Http::withHeaders([
                'Refreshtoken' => (Session::get('refresh_token'))])->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'auth/refresh');
		return $response;
	}

	public static function auth_user() {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'auth/user');
		return $response;
	}

	public static function check_token(){
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'auth/check');
		return $response;
	}

	public static function available_route_check($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'pengguna/route-check',$request);
		return $response;
	}

	public static function dashboard_data() {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'dashboard');
		return $response;
	}

	/*
	|--------------------------------------------------------------------------
	| Pengaturan - Menu
	|--------------------------------------------------------------------------
	*/
	public static function menu_list() {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'menu/list');
		return $response;
	}

	public static function menu_list_pengguna($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'menu/get/pengguna',$request);
		return $response;
	}

	/*
	|--------------------------------------------------------------------------
	| Pengaturan - AKtivitas Log
	|--------------------------------------------------------------------------
	*/
	public static function aktivitas_log_list() {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'aktivitas-log/list');
		return $response;
	}

	/*
	|--------------------------------------------------------------------------
	| Perusahaan - Departement
	|--------------------------------------------------------------------------
	*/
	public static function departemen_list() {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'departement/list');
		return $response;
	}

	public static function departemen_add($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'departement/create', $request);
		return $response;
	}

	public static function departemen_get($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'departement/get/id', $request);
		return $response;
	}

	public static function departemen_update($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'departement/update', $request);
		return $response;
	}

	public static function departemen_delete($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'departement/delete', $request);
		return $response;
	}

	public static function departemen_activity($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'departement/get/activity', $request);
		return $response;
	}

	/*
	|--------------------------------------------------------------------------
	| Pembelian - Permintaan Pembelian
	|--------------------------------------------------------------------------
	*/
	public static function permintaan_pembelian_list() {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'permintaan-pembelian/list');
		return $response;
	}

    public static function permintaan_pembelian_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'permintaan-pembelian/list/datatable', $request);
        return $response;
    }

	public static function permintaan_pembelian_list_by($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'permintaan-pembelian/list/belum-selesai', $request);
		return $response;
	}

	public static function permintaan_pembelian_add($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'permintaan-pembelian/create', $request);
		return $response;
	}

	public static function permintaan_pembelian_get($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'permintaan-pembelian/get/id', $request);
		return $response;
	}

	public static function permintaan_pembelian_get_by_data($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'permintaan-pembelian/get/data', $request);
		return $response;
	}

	public static function permintaan_pembelian_update($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'permintaan-pembelian/update', $request);
		return $response;
	}

	public static function permintaan_pembelian_delete($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'permintaan-pembelian/delete', $request);
		return $response;
	}

	public static function permintaan_pembelian_activity($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'permintaan-pembelian/get/activity', $request);
		return $response;
	}

	public static function filterTanggalPermintaanPembelian($request) {
		$response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'permintaan-pembelian/list/per-tanggal', $request);
		return $response;
	}

    public static function filterTanggalPermintaanPembelianDatatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'permintaan-pembelian/list/per-tanggal-datatable', $request);
        return $response;
    }

    public static function permintaan_pembelian_numbering() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'permintaan-pembelian/get/numbering');
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | kelitbangan
    |--------------------------------------------------------------------------
    */
    public static function kelitbangan_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'kelitbangan/list/');
        return $response;
    }
    public static function kelitbangan_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'kelitbangan/list/datatable', $request);
        return $response;
    }

    public static function kelitbangan_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kelitbangan/list/datatable-tanggal', $request);
        return $response;
    }
    public static function kelitbangan_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kelitbangan/create', $request);
        return $response;
    }
    public static function kelitbangan_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kelitbangan/get/id', $request);
        return $response;
    }
    public static function kelitbangan_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kelitbangan/update', $request);
        return $response;
    }
    public static function kelitbangan_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kelitbangan/delete', $request);
        return $response;
    }
    public static function kelitbangan_terkini() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'kelitbangan/terkini');
        return $response;
    }

    public static function kelitbangan_nomor() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'kelitbangan/nomor');
        return $response;
    }

    public static function kelitbangan_bidang_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'kelitbangan/list/bidang' );
        return $response;
    }

    public static function kelitbangan_bidang_list_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'kelitbangan/list/bidang-datatable',$request );
        return $response;
    }

    public static function kelitbangan_by_bidang_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kelitbangan/list/by-bidang', $request );
        return $response;
    }

    public static function kelitbangan_bidang_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kelitbangan/create-bidang', $request);
        return $response;
    }

    public static function kelitbangan_bidang_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kelitbangan/get/bidang', $request);
        return $response;
    }

    public static function kelitbangan_bidang_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kelitbangan/update-bidang', $request);
        return $response;
    }

    public static function kelitbangan_bidang_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kelitbangan/delete-bidang', $request);
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | inovasi
    |--------------------------------------------------------------------------
    */
    public static function inovasi_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'inovasi/list/');
        return $response;
    }
    public static function inovasi_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'inovasi/list/datatable', $request);
        return $response;
    }

    public static function inovasi_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'inovasi/list/datatable-tanggal', $request);
        return $response;
    }

    public static function inovasi_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'inovasi/create', $request);
        return $response;
    }
    public static function inovasi_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'inovasi/get/id', $request);
        return $response;
    }
    public static function inovasi_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'inovasi/update', $request);
        return $response;
    }
    public static function inovasi_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'inovasi/delete', $request);
        return $response;
    }
    public static function inovasi_terkini() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'inovasi/terkini');
        return $response;
    }

    public static function inovasi_nomor() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'inovasi/nomor');
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | instansi
    |--------------------------------------------------------------------------
    */
    public static function instansi_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'instansi/list');
        return $response;
    }
    public static function instansi_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'inovasi/list/datatable', $request);
        return $response;
    }
    public static function instansi_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'inovasi/create', $request);
        return $response;
    }
    public static function instansi_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'inovasi/get/id', $request);
        return $response;
    }
    public static function instansi_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'inovasi/update', $request);
        return $response;
    }
    public static function instansi_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'inovasi/delete', $request);
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | Agenda
    |--------------------------------------------------------------------------
    */
    public static function agenda_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'agenda/list');
        return $response;
    }
    public static function agenda_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'agenda/list/datatable', $request);
        return $response;
    }

    public static function agenda_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'agenda/list/datatable-tanggal', $request);
        return $response;
    }

    public static function agenda_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'agenda/create', $request);
        return $response;
    }
    public static function agenda_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'agenda/get/id', $request);
        return $response;
    }
    public static function agenda_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'agenda/update', $request);
        return $response;
    }
    public static function agenda_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'agenda/delete', $request);
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | Berita
    |--------------------------------------------------------------------------
    */
    public static function berita_list($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'berita/list',$request);
        return $response;
    }
    public static function berita_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'berita/list/datatable', $request);
        return $response;
    }
    public static function berita_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'berita/list/datatable-tanggal', $request);
        return $response;
    }
    public static function berita_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'berita/create', $request);
        return $response;
    }
    public static function berita_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'berita/get/id', $request);
        return $response;
    }
    public static function berita_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'berita/update', $request);
        return $response;
    }
    public static function berita_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'berita/delete', $request);
        return $response;
    }

    public static function berita_terkini() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'berita/terkini');
        return $response;
    }

    public static function berita_buat_komentar($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'berita/komentar', $request);
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | Usulan Penelitian
    |--------------------------------------------------------------------------
    */
    public static function usulan_penelitian_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-penelitian/list');
        return $response;
    }

    public static function usulan_penelitian_list_external() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-penelitian/list/external');
        return $response;
    }

    public static function usulan_penelitian_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-penelitian/list/datatable', $request);
        return $response;
    }

    public static function usulan_penelitian_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-penelitian/list/datatable-tanggal', $request);
        return $response;
    }

    public static function usulan_penelitian_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-penelitian/create', $request);
        return $response;
    }
    public static function usulan_penelitian_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-penelitian/get/id', $request);
        return $response;
    }
    public static function usulan_penelitian_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-penelitian/update', $request);
        return $response;
    }

    public static function usulan_penelitian_update_status($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-penelitian/set-status', $request);
        return $response;
    }

    public static function usulan_penelitian_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-penelitian/delete', $request);
        return $response;
    }

    public static function usulan_penelitian_numbering() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-penelitian/numbering');
        return $response;
    }

    public static function usulan_penelitian_nomor() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-penelitian/nomor');
        return $response;
    }

    /*
    |--------------------------------------------------------------------------
    | Usulan Penelitian
    |--------------------------------------------------------------------------
    */
    public static function usulan_inovasi_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-inovasi/list');
        return $response;
    }
    public static function usulan_inovasi_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-inovasi/list/datatable', $request);
        return $response;
    }

    public static function usulan_inovasi_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-inovasi/list/datatable-tanggal', $request);
        return $response;
    }

    public static function usulan_inovasi_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-inovasi/create', $request);
        return $response;
    }
    public static function usulan_inovasi_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-inovasi/get/id', $request);
        return $response;
    }
    public static function usulan_inovasi_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-inovasi/update', $request);
        return $response;
    }
    public static function usulan_inovasi_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-inovasi/delete', $request);
        return $response;
    }
    public static function usulan_inovasi_terkini() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-inovasi/terkini');
        return $response;
    }
    public static function usulan_numbering() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-inovasi/terkini');
        return $response;
    }

    public static function usulan_inovasi_nomor() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-inovasi/nomor');
        return $response;
    }

    public static function usulan_inovasi_update_status($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-inovasi/update-status',$request);
        return $response;
    }


    public static function attachment_terkini() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'attachment/terkini');
        return $response;
    }

    public static function attachment_get_foto() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'attachment/foto');
        return $response;
    }
    public static function attachment_get_video() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'attachment/video');
        return $response;
    }


    /*
    |--------------------------------------------------------------------------
    | Surat
    |--------------------------------------------------------------------------
    */
    public static function surat_keluar_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-inovasi/list');
        return $response;
    }
    public static function surat_keluar_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'surat-keluar/list/datatable', $request);
        return $response;
    }
    public static function surat_keluar_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-keluar/list/datatable-tanggal', $request);
        return $response;
    }
    public static function surat_keluar_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-keluar/create', $request);
        return $response;
    }
    public static function surat_keluar_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-keluar/get/id', $request);
        return $response;
    }
    public static function surat_keluar_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-keluar/update', $request);
        return $response;
    }
    public static function surat_keluar_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-keluar/delete', $request);
        return $response;
    }
    public static function surat_keluar_terkini() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'surat-keluar/terkini');
        return $response;
    }
    public static function surat_keluar_numbering() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'surat-keluar/terkini');
        return $response;
    }

    public static function surat_keluar_nomor() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'surat-keluar/nomor');
        return $response;
    }

    public static function surat_masuk_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-inovasi/list');
        return $response;
    }
    public static function surat_masuk_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'surat-masuk/list/datatable', $request);
        return $response;
    }
    public static function surat_masuk_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-masuk/list/datatable-tanggal', $request);
        return $response;
    }
    public static function surat_masuk_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-masuk/create', $request);
        return $response;
    }
    public static function surat_masuk_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-masuk/get/id', $request);
        return $response;
    }
    public static function surat_masuk_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-masuk/update', $request);
        return $response;
    }
    public static function surat_masuk_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-masuk/delete', $request);
        return $response;
    }
    public static function surat_masuk_terkini() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'surat-keluar/terkini');
        return $response;
    }

    public static function surat_masuk_numbering() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'surat-keluar/terkini');
        return $response;
    }

    public static function surat_masuk_nomor() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'surat-masuk/nomor');
        return $response;
    }

    public static function jenis_surat_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'jenis-surat/list');
        return $response;
    }

    public static function jenis_surat_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'jenis-surat/list/datatable', $request);
        return $response;
    }

    public static function jenis_surat_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'jenis-surat/create', $request);
        return $response;
    }

    public static function jenis_surat_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'jenis-surat/get/id', $request);
        return $response;
    }

    public static function jenis_surat_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'jenis-surat/update', $request);
        return $response;
    }

    public static function jenis_surat_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'jenis-surat/delete', $request);
        return $response;
    }


    public static function form_get($request) {
        $response = Http::withToken(Session::get('GToken'))->timeout(env('API_TIMEOUT', '10000'))->get('https://forms.googleapis.com/v1/forms/'.$request);
        return $response;
    }

    public static function form_responses_get($request) {
        $response = Http::withToken(Session::get('GToken'))->timeout(env('API_TIMEOUT', '10000'))->get('https://forms.googleapis.com/v1/forms/'.$request.'/responses');
        return $response;
    }

    public static function regulasi_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'regulasi/list');
        return $response;
    }
    public static function regulasi_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'regulasi/list/datatable', $request);
        return $response;
    }
    public static function regulasi_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'regulasi/create', $request);
        return $response;
    }
    public static function regulasi_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'regulasi/get/id', $request);
        return $response;
    }
    public static function regulasi_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'regulasi/update', $request);
        return $response;
    }
    public static function regulasi_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'regulasi/delete', $request);
        return $response;
    }

    public static function survey_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'survey/list');
        return $response;
    }
    public static function survey_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'survey/list/datatable', $request);
        return $response;
    }
    public static function survey_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'survey/create', $request);
        return $response;
    }
    public static function survey_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'survey/get/id', $request);
        return $response;
    }
    public static function survey_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'survey/update', $request);
        return $response;
    }
    public static function survey_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'survey/delete', $request);
        return $response;
    }

    /*
   |--------------------------------------------------------------------------
   | Surat Rekomendasi
   |--------------------------------------------------------------------------
   */
    public static function surat_rekomendasi_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'surat-rekomendasi/list');
        return $response;
    }
    public static function surat_rekomendasi_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'surat-rekomendasi/list/datatable', $request);
        return $response;
    }

    public static function surat_rekomendasi_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-rekomendasi/list/datatable-tanggal', $request);
        return $response;
    }

    public static function surat_rekomendasi_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-rekomendasi/create', $request);
        return $response;
    }
    public static function surat_rekomendasi_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-rekomendasi/get/id', $request);
        return $response;
    }
    public static function surat_rekomendasi_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-rekomendasi/update', $request);
        return $response;
    }
    public static function surat_rekomendasi_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'surat-rekomendasi/delete', $request);
        return $response;
    }

    /*
  |--------------------------------------------------------------------------
  | Layanan Incubator
  |--------------------------------------------------------------------------
  */
    public static function layanan_incubator_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'layanan-incubator/list');
        return $response;
    }
    public static function layanan_incubator_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'layanan-incubator/list/datatable', $request);
        return $response;
    }

    public static function layanan_incubator_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'layanan-incubator/list/datatable-tanggal', $request);
        return $response;
    }

    public static function layanan_incubator_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'layanan-incubator/create', $request);
        return $response;
    }
    public static function layanan_incubator_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'layanan-incubator/get/id', $request);
        return $response;
    }
    public static function layanan_incubator_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'layanan-incubator/update', $request);
        return $response;
    }
    public static function layanan_incubator_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'layanan-incubator/delete', $request);
        return $response;
    }

    /*
  |--------------------------------------------------------------------------
  | Jenis Layanan Incubator
  |--------------------------------------------------------------------------
  */
    public static function jenis_layanan_incubator_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'jenis-layanan-incubator/list');
        return $response;
    }
    public static function jenis_layanan_incubator_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'jenis-layanan-incubator/list/datatable', $request);
        return $response;
    }

    public static function jenis_layanan_incubator_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'jenis-layanan-incubator/list/datatable-tanggal', $request);
        return $response;
    }

    public static function jenis_layanan_incubator_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'jenis-layanan-incubator/create', $request);
        return $response;
    }
    public static function jenis_layanan_incubator_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'jenis-layanan-incubator/get/id', $request);
        return $response;
    }
    public static function jenis_layanan_incubator_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'jenis-layanan-incubator/update', $request);
        return $response;
    }
    public static function jenis_layanan_incubator_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'jenis-layanan-incubator/delete', $request);
        return $response;
    }

    public static function dashboard() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'dashboard/');
        return $response;
    }

    /*
  |--------------------------------------------------------------------------
  | Layanan Incubator
  |--------------------------------------------------------------------------
  */
    public static function informasi_publik_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'informasi-publik/list');
        return $response;
    }
    public static function informasi_publik_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'informasi-publik/list/datatable', $request);
        return $response;
    }

    public static function informasi_publik_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'informasi-publikr/list/datatable-tanggal', $request);
        return $response;
    }

    public static function informasi_publik_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'informasi-publik/create', $request);
        return $response;
    }
    public static function informasi_publik_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'informasi-publik/get/id', $request);
        return $response;
    }
    public static function informasi_publik_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'informasi-publik/update', $request);
        return $response;
    }
    public static function informasi_publik_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'informasi-publik/delete', $request);
        return $response;
    }

    public static function informasi_publik_by_kategori($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'informasi-publik/get/kategori', $request);
        return $response;
    }

    /*
  |--------------------------------------------------------------------------
  | Kategori Informasi Publik
  |--------------------------------------------------------------------------
  */
    public static function kategori_informasi_publik_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'kategori-informasi-publik/list');
        return $response;
    }
    public static function kategori_informasi_publik_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'kategori-informasi-publik/list/datatable', $request);
        return $response;
    }

    public static function kategori_informasi_publik_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kategori-informasi-publik/list/datatable-tanggal', $request);
        return $response;
    }

    public static function kategori_informasi_publik_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kategori-informasi-publik/create', $request);
        return $response;
    }
    public static function kategori_informasi_publik_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kategori-informasi-publik/get/id', $request);
        return $response;
    }
    public static function kategori_informasi_publik_by_jenis($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kategori-informasi-publik/get/jenis', $request);
        return $response;
    }
    public static function kategori_informasi_publik_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kategori-informasi-publik/update', $request);
        return $response;
    }
    public static function kategori_informasi_publik_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'kategori-informasi-publik/delete', $request);
        return $response;
    }


    /*
|--------------------------------------------------------------------------
| Profil
|--------------------------------------------------------------------------
*/
    public static function profil_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'profil/list');
        return $response;
    }
    public static function profil_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'profil/list/datatable', $request);
        return $response;
    }

    public static function profil_datatable_by_tanggal($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'profil/list/datatable-tanggal', $request);
        return $response;
    }

    public static function profil_add($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'profilcreate', $request);
        return $response;
    }
    public static function profil_get($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'profil/get/id', $request);
        return $response;
    }
    public static function profil_by_jenis($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'profil/get/jenis', $request);
        return $response;
    }
    public static function profil_update($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'profil/update', $request);
        return $response;
    }
    public static function profil_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'profil/delete', $request);
        return $response;
    }



}
