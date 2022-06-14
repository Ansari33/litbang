<?php

namespace App\Helpers;

use Response;
use Session;
use Log;


class AppHelper {

    const HEADER_DATA_NOT_FOUND_MSG = 'Data Header Tidak Ditemukan!';
    const DETAIL_DATA_NOT_FOUND_MSG = 'Data Detail Tidak Ditemukan!';
    const JADWAL_VALIDATION_MSG = 'Jadwal Pengiriman Belum Dipilih!';
    const SYARAT_VALIDATION_MSG = 'Syarat Pengiriman Belum Dipilih!';
    const EXPEDISI_DETAIL_VALIDATION_MSG = 'Data Detail Pengiriman Tidak Ditemukan, Silahkan Cek Ulang!';
    const KUANTITAS_VALIDATION_MSG = 'Kuantitas Tidak Boleh Kosong!';
    const KODE_PAJAK_VALIDATION_MSG = 'Kode Pajak Belum di Pilih!';
    const HARGA_VALIDATION_MSG = 'Harga Tidak Boleh Kosong!';
    const UANG_MUKA_VALIDATION_MSG = 'Nominal Uang Muka tidak boleh Kosong!';
    const PEMBAYARAN_OVER_VALIDATION_MSG = 'Pembayaran Melebihi dari Sisa Hutang!';
    const PEMBAYARAN_ZERO_VALIDATION_MSG = 'Jumlah Nominal tidak boleh Nol!';

	public static function response($name, $request, $result) {
		$status = $result['status_code'];
		switch ($status) {
			case 200:
//				if($request != null) {
//					Log::info($name . '_REQUEST :' . " " . json_encode($request));
//				}
//				Log::info($name.'_RESPONSE :'." ". json_encode($result->json()));
				return Response::json($result['message'], $result['status_code']);
				break;
			case 201:
//				if($request != null) {
//					Log::info($name . '_REQUEST :' . " " . json_encode($request));
//				}
//				Log::info($name.'_RESPONSE :'." ". json_encode($result->json()));
				return Response::json($result['message'], $result['status_code']);
				break;
			case 400:
				if($request != null) {
					Log::alert($name . '_REQUEST :' . " " . json_encode($request));
				}
				Log::alert($name.'_RESPONSE :'." ". json_encode($result->json()));
				return Response::json(['message' => $result['errors']['details']], $result['status_code']);
				break;
			case 404:
				if($request != null) {
					Log::warning($name . '_REQUEST :' . " " . json_encode($request));
				}
				Log::warning($name.'_RESPONSE :'." ". json_encode($result->json()));
				if(isset($result['errors']['details'])) {
					return Response::json(['message' => $result['errors']['details']], $result['status_code']);
				} else {
					return Response::json(['message' => $result['message']], $result['status_code']);
				}
				break;
			case 409:
				if($request != null) {
					Log::error($name . '_REQUEST :' . " " . json_encode($request));
				}
				Log::error($name.'_RESPONSE :'." ". json_encode($result->json()));
				return Response::json(['message' => $result['message']], $result['status_code']);
				break;
			case 500:
				if($request != null) {
					Log::critical($name . '_REQUEST :' . " " . json_encode($request));
				}
				Log::critical($name.'_RESPONSE :'." ". json_encode($result->json()));
				if(isset($result['errors']['details'])) {
					return Response::json(['message' => $result['errors']['details']], $result['status_code']);
				} else {
					return Response::json(['message' => $result['message']], $result['status_code']);
				}
				break;
			default:
				return Response::json(['message' => 'Unknown Response'], 500);
		}
	}

    public static function responseError($message = 'System Error!')
    {
        return json_encode($error = [
            'status_code' => 500,
            'status' => false,
            'message' => $message
        ]);
	}

	public static function cekRequestData($request){
        if ($request->header == null){
            return self::HEADER_DATA_NOT_FOUND_MSG;
        }
        if ($request->detail == null){
            return self::DETAIL_DATA_NOT_FOUND_MSG;
        }
        return true;
    }
}
