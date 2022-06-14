<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KelitbanganController extends Controller
{
  public function index()
  {
      return view('admin.kelitbangan.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::kelitbangan_datatable($request->all());
    return view('admin.kelitbangan.index');
  }
    public function create()
    {
        $instansi = $this->getInstansi();
        return view('admin.kelitbangan.add',compact('instansi'));
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['pelaksana'] = $pelaksana;

        //return $body;
        return json_decode(HttpHelper::kelitbangan_add($body));

        return view('admin.kelitbangan.index');
    }
    public function edit($id)
    {
        $data = HttpHelper::kelitbangan_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        return view('admin.kelitbangan.edit',compact('data','instansi'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['pelaksana'] = $pelaksana;

        return json_decode(HttpHelper::kelitbangan_update($body));
        return view('admin.kelitbangan.index');
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::kelitbangan_delete(['id' => $id]));
        return view('admin.kelitbangan.index');
    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }
}
