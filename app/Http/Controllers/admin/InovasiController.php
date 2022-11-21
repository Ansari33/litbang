<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;

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
        $listFoto =  $request->filex !== null ? json_decode($request->filex,true) : [];
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['pelaksana'] = $pelaksana;
        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['attachment'] = [];
        foreach ($listFoto as $lt => $ur){

            $loc = public_path('/')."/images/upload/";
            $lama_ft = $loc.$ur['nama'];
            if(file_exists($loc.$ur['nama'])){
                //File::delete($image_path);
                File::delete( $lama_ft );
            }
            copy($ur['url'],$loc.$ur['nama']);
            $body['attachment'][] = [
                'nama' => $ur['nama'],
                'url'  => $lama_ft
            ];
        }

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
        $listFoto = json_decode($request->filex,true);
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        $body['pelaksana'] = $pelaksana;
        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['attachment'] = [];
        //return $listFoto;
        foreach ($listFoto as $lt => $ur){
            //return $ur['nama'];
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
