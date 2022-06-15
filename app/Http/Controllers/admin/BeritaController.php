<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
  public function index()
  {
      return view('admin.berita.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::berita_datatable($request->all());
    return view('admin.berita.index');
  }
    public function create()
    {
        $instansi = $this->getInstansi();
        return view('admin.berita.add',compact('instansi'));
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);
        //$pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');
        //$body['waktu'] = Carbon::parse($body['waktu'])->format('h:i:s');
        //$body['pelaksana'] = $pelaksana;

        //return $body;
        return json_decode(HttpHelper::berita_add($body));

        return view('admin.berita.index');
    }
    public function edit($id)
    {
        $data = HttpHelper::berita_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        return view('admin.berita.edit',compact('data','instansi'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');
//        $body['waktu'] = Carbon::parse($body['waktu'])->format('h:i:s');

        return json_decode(HttpHelper::berita_update($body));
        return view('admin.berita.index');
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::berita_delete(['id' => $id]));
        return view('admin.berita.index');
    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }
}
