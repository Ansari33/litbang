<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use http\Url;
use Illuminate\Http\Request;
use File;

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

        $listFoto = json_decode($request->filex,true);
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal']    = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['pelaksana']  = $pelaksana;
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
        $listFoto = json_decode($request->filex,true);
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['pelaksana'] = $pelaksana;
        $body['attachment'] = [];
        foreach ($listFoto as $lt => $ur){

            $loc = public_path('/')."/images/upload/";
            $lama_ft = $loc.$ur['nama'];
            if(file_exists($loc.$ur['nama'])){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$ur['nama']);
            $body['attachment'][] = [
                'nama' => $ur['nama'],
                'url'  => $lama_ft
            ];
        }

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
