<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;
use File;

class InformasiPublikController extends Controller
{
  public function index()
  {
      return view('admin.informasi-publik.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::informasi_publik_datatable($request->all());
  }

    public function create()
    {
        $jenis = [
            'Informasi Berkala' => 'Informasi Berkala',
            'Informasi Serta Merta' => 'Informasi Serta Merta',
            'Informasi Tersedia Setiap Saat' => 'Informasi Tersedia Setiap Saat',
        ];
        return view('admin.informasi-publik.add',compact('jenis'));
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);
        $attachment = json_decode($request->filed,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['dokumen'] ='';
        foreach ($attachment as $lt => $ur){

            $loc = ('../public_html/files-attachment/informasi-publik/');
            #$loc = public_path('/files-attachment/informasi-publik/');
            $fileIni = $loc.str_replace(' ','-',$ur['nama']);
            if(file_exists($fileIni)){
                File::delete( $fileIni );
            }
            copy($ur['url'],$fileIni);
           $body['dokumen'] = str_replace(' ','-',$ur['nama']);
        }

        return json_decode(HttpHelper::informasi_publik_add($body));
    }
    public function edit($id)
    {
        $jenis = [
            'Informasi Berkala' => 'Informasi Berkala',
            'Informasi Serta Merta' => 'Informasi Serta Merta',
            'Informasi Tersedia Setiap Saat' => 'Informasi Tersedia Setiap Saat',
        ];
        $data = HttpHelper::informasi_publik_get(['id' => $id])['data'];
        return view('admin.informasi-publik.edit',compact('data','jenis'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $attachment = json_decode($request->filed,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['dokumen'] ='';
        foreach ($attachment as $lt => $ur){

            $loc = ('../public_html/files-attachment/informasi-publik/');
            #$loc = public_path('/files-attachment/informasi-publik/');
            $fileIni = $loc.str_replace(' ','-',$ur['nama']);
            if(file_exists($fileIni)){
            }else{
                copy($ur['url'],$fileIni);
            }

            $body['dokumen'] = str_replace(' ','-',$ur['nama']);
        }
        return json_decode(HttpHelper::informasi_publik_update($body));
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::informasi_publik_delete(['id' => $id]));
    }

}
