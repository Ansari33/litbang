<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UsulanInovasiController extends Controller
{
  public function index()
  {
      return view('admin.usulan-inovasi.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::usulan_inovasi_datatable($request->all());
    return view('admin.usulan-penelitian.index');
  }
    public function create()
    {
        $instansi = $this->getInstansi();
        return view('admin.usulan-penelitian.add',compact('instansi'));
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        //return $listFoto;
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
//        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['tanggal'] = date('Y-m-d');
        $body['attachment'] = [];

        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        foreach ($listFoto as $lt => $ur){
            $loc = public_path('/')."/images/upload/";
            $lama_ft = $loc.$ur['nama'];
            if(file_exists($loc.$ur['nama'])){
                //File::delete($image_path);
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$ur['nama']);
            $body['attachment'][] = [
                'nama' => $ur['nama'],
                'url'  => $lama_ft
            ];
        }

        return json_decode(HttpHelper::usulan_inovasi_add($body));

        return view('admin.usulan-penelitian.index');
    }
    public function edit($id)
    {
        $data = HttpHelper::usulan_inovasi_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        //return $instansi;
        return view('admin.usulan-inovasi.edit',compact('data','instansi'));
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

        return json_decode(HttpHelper::usulan_penelitian_update($body));
        return view('admin.usulan-penelitian.index');
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::usulan_penelitian_delete(['id' => $id]));
        return view('admin.usulan-penelitian.index');
    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }
}
