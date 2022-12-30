<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;

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

    public function listByTanggal(Request $request)
    {
        return HttpHelper::usulan_inovasi_datatable_by_tanggal($request->all());
        return view('admin.usulan-penelitian.index');
    }

    public function create()
    {
        $instansi = $this->getInstansi();
        $nomor = HttpHelper::usulan_inovasi_nomor();
        return view('admin.usulan-penelitian.add',compact('instansi','nomor'));
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];

        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
//        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['tanggal'] = date('Y-m-d');
        $body['attachment'] = [];

        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        foreach ($listFoto as $lt => $ur){

            $loc = ('../public_html/files-attachment/laporan-usulan-inovasi/');
            $strNama = str_replace(' ','-',$ur['nama']);
            $lama_ft = $loc.$strNama;
            if(file_exists($lama_ft)){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$lama_ft);
            $body['attachment'][] = [
                'nama' => $strNama,
                'url'  => '/files-attachment/laporan-usulan-inovasi/'.$strNama,
                //'type' => $ur['tipe'],
            ];
        }

        return json_decode(HttpHelper::usulan_inovasi_add($body));

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
        $body = [];

        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
       $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        //$body['tanggal'] = date('Y-m-d');
        $body['attachment'] = [];

        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        foreach ($listFoto as $lt => $ur){
            $loc = ('../public_html/files-attachment/laporan-usulan-inovasi/');
            $strNama = str_replace(' ','-',$ur['nama']);
            $lama_ft = $loc.$strNama;
            if(file_exists($loc.$strNama)){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$strNama);
            $body['attachment'][] = [
                'nama' => $strNama,
                'url'  => 'files-attachment/laporan-usulan-inovasi/'.$strNama,
               // 'type' => $ur['tipe'],
            ];
        }

        return json_decode(HttpHelper::usulan_inovasi_update($body));
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::usulan_inovasi_delete(['id' => $id]));
    }

    public function updateStatus(Request  $request)
    {
        return json_decode(HttpHelper::usulan_inovasi_update_status(['status' => $request->status,'id' => $request->id]));
    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }
}
