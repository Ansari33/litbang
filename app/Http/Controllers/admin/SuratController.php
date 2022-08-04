<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use Response;

class SuratController extends Controller
{
  public function index()
  {
      return view('admin.surat.index');
  }

  public function indexSuratKeluar()
  {
      return view('admin.surat.keluar.index');
  }

    public function listSuratKeluar(Request  $request)
    {
        return HttpHelper::surat_keluar_datatable($request->all());
    }

  public function createSuratKeluar()
  {
      $nomor = Str::random(10);
      return view('admin.surat.keluar.add',compact('nomor'));
  }

  public function list(Request $request)
  {

    return view('admin.usulan-penelitian.index');
  }
    public function create()
    {
        $instansi = $this->getInstansi();
        $nomor = HttpHelper::usulan_penelitian_numbering()['data'];
        return view('admin.usulan-penelitian.add',compact('instansi','nomor'));
    }

    public function storeSuratKeluar(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal_surat'] = Carbon::parse($body['tanggal_surat'])->format('Y-m-d');


        $listFoto = isset($request->file_surat) ? json_decode($request->file_surat,true) : [];
        foreach ($listFoto as $lt => $ur){
            $loc = public_path('/')."surat-keluar/";
            $strNama = str_replace(' ','-',$ur['nama']);
            $lama_ft = $loc.$strNama;
            if(file_exists($loc.$strNama)){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$strNama);
            $body['surat_keluar'] = $strNama;
        }
       //eturn $body;
        return json_decode(HttpHelper::surat_keluar_add($body));
    }
    public function editSuratKeluar($id)
    {
        $data = HttpHelper::surat_keluar_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        return view('admin.surat.keluar.edit',compact('data','instansi'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['attachment'] = [];
        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        foreach ($listFoto as $lt => $ur){
            $locFoto = public_path('/')."/images/upload/";
            $locVideo = public_path('/')."/videos/upload/";
            $loc = ($ur['tipe'] == 'video') ?  $locVideo : $locFoto;
            $strNama = str_replace(' ','-',$ur['nama']);
            $lama_ft = $loc.$strNama;
            if(file_exists($loc.$strNama)){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$strNama);
            $body['attachment'][] = [
                'nama' => $strNama,
                'url'  => $lama_ft,
                'type' => $ur['tipe'],
            ];
        }
        //return  $body;
        return json_decode(HttpHelper::usulan_penelitian_update($body));
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::usulan_penelitian_delete(['id' => $id]));
    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }

    public function openFile($request)
    {
        $file = public_path(). "/surat-keluar/".$request;

        $headers = array(
            'Content-Type: application/text',
        );

       return Response::download($file, $request);
    }

}
