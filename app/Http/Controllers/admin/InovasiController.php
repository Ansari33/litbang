<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InovasiController extends Controller
{
    public function index()
    {
        return view('admin.inovasi.index');
    }
    public function list(Request $request)
    {
        return HttpHelper::inovasi_datatable($request->all());
    }
    public function create()
    {
        $instansi = $this->getInsatnsi();
        return view('admin.inovasi.add',compact('instansi'));
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

        return json_decode(HttpHelper::inovasi_add($body));
    }
    public function edit($id)
    {
        $data = HttpHelper::inovasi_get(['id' => $id])['data'];
        $instansi = $this->getInsatnsi();
        return view('admin.inovasi.edit',compact('data','instansi'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        $body['pelaksana'] = $pelaksana;
        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        return json_decode(HttpHelper::inovasi_update($body));
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::inovasi_delete(['id' => $id]));
    }

    public function getInsatnsi()
    {
        $data =(HttpHelper::instansi_list())['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }
}
