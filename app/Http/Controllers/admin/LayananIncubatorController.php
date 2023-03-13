<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;
use File;

class LayananIncubatorController extends Controller
{
  public function index()
  {
      return view('admin.layanan-incubator.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::layanan_incubator_datatable($request->all());
    return view('admin.agenda.index');
  }

   public function listByTanggal(Request $request)
    {
        return HttpHelper::agenda_datatable_by_tanggal($request->all());
    }
    public function create()
    {
        $instansi = $this->getInstansi();
        return view('admin.agenda.add',compact('instansi'));
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);
         $indikator = json_decode($request->indikator,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['indikator'] = [];
        if($request->nIndikator == 1){
            foreach ($indikator as $index => $value){
                if($value !== null){
                    $body['indikator'][$index] = str_replace(' ','_',$value[0]['nama']) ;
                    #$loc = public_path()."/files-attachment/indikator/";
                    $loc = "../public_html/files-attachment/indikator/";
                    $lama_ft = $loc.str_replace(' ','_',$value[0]['nama']);
                    if(file_exists($lama_ft)){
                        File::delete( $lama_ft );
                    }
                    File::copy($value[0]['url'],$lama_ft);
                    }
               
            }
        }
        
        $body['tanggal'] = date('Y-m-d');#Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');
        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        $jenisLayanan = implode(',',json_decode($request->jenisLayanan,true));
        $body['layanan'] = $jenisLayanan;
        $body['nindikator'] = $request->nIndikator;
        
    
       # return $body;
        foreach ($listFoto as $lt => $ur){

            #$loc = public_path()."/files-attachment/surat-pengajuan/";
            $loc = "../public_html/files-attachment/surat-pengajuan/";
            $lama_ft = $loc.$ur['nama'];
            if(file_exists($loc.$ur['nama'])){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$ur['nama']);
            $body['file_surat']=  str_replace(' ','_',$ur['nama']);

        }

        #return $body;
        return json_decode(HttpHelper::layanan_incubator_add($body));
    }

    public function edit($id)
    {
        $data = HttpHelper::layanan_incubator_get(['id' => $id])['data'];
        $datal =(HttpHelper::jenis_layanan_incubator_list())['data'];
        $layanan = collect($datal)->pluck('nama','nama')->toArray();
        $instansi = $this->getInstansi();
        return view('admin.layanan-incubator.edit',compact('data','instansi','layanan'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');
        //$body['waktu'] = Carbon::parse($body['waktu'])->format('h:i:s');
        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        $body['attachment'] = [];
//        foreach ($listFoto as $lt => $ur){
//
//            $loc = public_path('/')."/images/upload/";
//            $lama_ft = $loc.$ur['nama'];
//            if(file_exists($loc.$ur['nama'])){
//                File::delete( $lama_ft );
//            }
//            File::copy($ur['url'],$loc.$ur['nama']);
//            $body['attachment'][] = [
//                'nama' => $ur['nama'],
//                'url'  => $lama_ft
//            ];
//        }

        return json_decode(HttpHelper::layanan_incubator_update($body));
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::agenda_delete(['id' => $id]));
        return view('admin.agenda.index');
    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }
}
