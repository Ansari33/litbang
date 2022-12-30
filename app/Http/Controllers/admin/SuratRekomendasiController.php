<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;
use File;

class SuratRekomendasiController extends Controller
{
  public function index()
  {
      return view('admin.surat-rekomendasi.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::surat_rekomendasi_datatable($request->all());
  }

   public function listByTanggal(Request $request)
    {
        return HttpHelper::surat_rekomendasi_datatable_by_tanggal($request->all());
    }
    public function create()
    {
        $instansi = $this->getInstansi();
        return view('admin.surat-rekomendasi.add',compact('instansi'));
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);

        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        //$body['pelaksana'] = $pelaksana;
        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        $body['attachment'] = [];
        foreach ($listFoto as $lt => $ur){

            $loc = "../public_html/files-attachment/surat-rekomendasi/";
            $lama_ft = $loc.str_replace(' ','-',$ur['nama']);
            if(file_exists($loc.str_replace(' ','-',$ur['nama']))){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.str_replace(' ','-',$ur['nama']));
            $body['attachment'][] = [
                'nama' => str_replace(' ','-',$ur['nama']),
                'url'  => 'files-attachment/surat-rekomendasi/'.str_replace(' ','-',$ur['nama']),
            ];
        }

        //return $body;
        return json_decode(HttpHelper::surat_rekomendasi_add($body));
    }
    public function edit($id)
    {
        $data = HttpHelper::surat_rekomendasi_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        return view('admin.surat-rekomendasi.edit',compact('data','instansi'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        $body['attachment'] = [];
        foreach ($listFoto as $lt => $ur){

            $loc = "../public_html/files-attachment/surat-rekomendasi/";
            $fixNama = str_replace(' ','-',$ur['nama']);
            $lama_ft = $loc.$fixNama;
            if(file_exists($lama_ft)){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$lama_ft);
            $body['attachment'][] = [
                'nama' => $ur['nama'],
                'url'  => "files-attachment/surat-rekomendasi/".$fixNama,
            ];
        }

        return json_decode(HttpHelper::surat_rekomendasi_update($body));
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::surat_rekomendasi_delete(['id' => $id]));
    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }
}
