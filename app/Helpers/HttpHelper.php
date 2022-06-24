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

    /*
    |--------------------------------------------------------------------------
    | Usulan Penelitian
    |--------------------------------------------------------------------------
    */
    public static function usulan_penelitian_list() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-penelitian/list');
        return $response;
    }
    public static function usulan_penelitian_datatable($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'usulan-penelitian/list/datatable', $request);
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
    public static function usulan_penelitian_delete($request) {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->post(env('API_ADDRESS').'usulan-penelitian/delete', $request);
        return $response;
    }

    public static function attachment_terkini() {
        $response = Http::withToken(Session::get('token'))->timeout(env('API_TIMEOUT', '10000'))->get(env('API_ADDRESS').'attachment/terkini');
        return $response;
    }

}
