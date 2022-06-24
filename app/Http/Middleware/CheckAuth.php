<?php

namespace App\Http\Middleware;

use App\Helpers\HttpHelper;
use Closure;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        // if the session does not have 'authenticated' forget the user and redirect to login
        if ($request->session()->get('authenticated',false) === true) {
            $cek = HttpHelper::check_token();
            if ($cek['status_code'] == 500){
                return redirect()->to("login")->with('error', 'Sesi anda telah habis.');
            }
            return $next($request);
        } else {
            if ($request->ajax())
            {
                $request->session()->put('over',true);
                $request->session()->forget('authenticated');
                $request->session()->forget('user');
                $request->session()->forget('token');
                return response()->json('Unauthorized.', 401);
            }
            else
            {
                $request->session()->put('over',true);
                $request->session()->forget('authenticated');
                $request->session()->forget('user');
                $request->session()->forget('token');
                return redirect()->to("login")->with('error', 'Sesi anda telah habis.');
            }
        }
    }
}
