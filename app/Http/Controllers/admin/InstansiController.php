<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index()
    {
        return view('admin.inovasi.index');
    }
    public function list(Request $request)
    {
        return HttpHelper::inovasi_datatable($request->all());
    }

    public function listByTanggal(Request $request)
    {
        return HttpHelper::inovasi_datatable_by_tanggal($request->all());
    }

    public function create()
    {
        return view('admin.inovasi.add');
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');

        return json_decode(HttpHelper::inovasi_add($body));
    }

    public function edit($id)
    {
        $data = HttpHelper::inovasi_get(['id' => $id])['data'];

        return view('admin.inovasi.edit',compact('data'));
    }

    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        return json_decode(HttpHelper::inovasi_update($body));
    }

    public function delete($id)
    {
        return json_decode(HttpHelper::inovasi_delete(['id' => $id]));
    }
}
