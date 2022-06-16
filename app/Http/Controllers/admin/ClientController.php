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
