<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $kelitbangan = HttpHelper::kelitbangan_terkini()['data'];
        $inovasi = HttpHelper::inovasi_terkini()['data'];
        return view('home',compact('kelitbangan','inovasi'));
    }

    public function kelitbangan()
    {
        $data = HttpHelper::kelitbangan_list()['data'];
        return view('kelitbangan',compact('data'));
    }

    public function inovasi()
    {
        $data = HttpHelper::inovasi_list()['data'];

        return view('inovasi',compact('data'));
    }

    public function viewKelitbangan($id)
    {
        $data =  HttpHelper::kelitbangan_get(['id' => $id])['data'];
        $kelitbangan = HttpHelper::kelitbangan_terkini()['data'];
        $inovasi = null;
        return view('view-data.kelitbangan',compact('data','kelitbangan'));
    }

    public function viewInovasi($id)
    {
        $data =  HttpHelper::inovasi_get(['id' => $id])['data'];
        $inovasi = HttpHelper::inovasi_terkini()['data'];
        return view('view-data.inovasi',compact('data','inovasi'));
    }
}
