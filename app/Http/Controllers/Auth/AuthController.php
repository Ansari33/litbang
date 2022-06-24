<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Helpers\HttpHelper;
use App\Traits\Throttles;
use Illuminate\Support\Facades\Http;
use Session;
use Response;
use Log;
use Carbon\Carbon;

class AuthController extends Controller {
	/**
	 * AuthController constructor.
	 */
	public function __construct() {
		$this->httpHelper = new HttpHelper();
	}

	/**
	 * Show the main login page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function showLoginForm() {

		$check = HttpHelper::check_token();
		if ($check['status_code'] != 200) {
			return view("auth.login");
		}else{
			return redirect('/');
		}

	}

	public function showModalLogin() {
		return view("system.login_modal");
	}


	/**
	 * Authenticate against the  API
	 * @param AuthenticationRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function authenticate(Request $request) {
	    $response = HttpHelper::login([
			'email' => $request['email'],
			'password' => $request['password'],
		]);
		if($response['status']) {
			Session::put('authenticated',true);
			Session::put('token', $response['data']['access_token']);
			Session::put('refresh_token', $response['data']['refresh_token']);
			Session::put('user', $response['data']['user']);
			Session::put('user_id', $response['data']['user']['id']);
			Session::put('expired',$response['data']['expires_in']*1000);
			Session::save();
		}else{
			return Response::json(['message' => $response['errors']['details']], 500);
		}
		// if($response->failed()) {
		// 	return Response::json(['message' => $response['error']], 500);
		// }
	}

	public function refreshToken(Request $request) {
		$response = HttpHelper::refresh_token([]);
		//return $response;
		if($response['status']) {
			Session::put('authenticated',true);
			Session::put('token', $response['data']['access_token']);
			Session::put('refresh_token', $response['data']['refresh_token']);
			Session::put('expired',$response['data']['expires_in']*1000);
			Session::save();
			return Response()->json([
				'pesan' => $response['data'],
				'status_code'=>200,
			]);
		}else{
			$value = HttpHelper::logout();
			Session::forget('authenticated');
			Session::forget('token');
			Session::forget('user');

			return response()->json([
				'pesan' => $response['errors']['details'],
				'body' => view("auth.next_login")->render(),
				'status_code'=>422,
			]);
		}

	}

	/**
	 * Log user out
	 * @param Request $request
	 * @return type
	 */
	public function logout() {

		HttpHelper::logout();
		Session::forget('authenticated');
		Session::forget('token');
		Session::forget('user');
		return redirect()->to('/login');
	}

	public function authCheck(){
		$check = HttpHelper::check_token();
		return $check;
	}

}
