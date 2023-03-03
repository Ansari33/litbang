<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;
use File;

class ProfilController extends Controller
{
  public function index()
  {
      $data = HttpHelper::profil_get(['id' => 1])['data'];
      return view('admin.profil.index',compact('data'));
  }
  public function list(Request $request)
  {
    return HttpHelper::agenda_datatable($request->all());
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

        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');
        $body['waktu'] = Carbon::parse($body['waktu'])->format('h:i:s');
        //$body['pelaksana'] = $pelaksana;
        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
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

        //return $body;
        return json_decode(HttpHelper::agenda_add($body));
    }
    public function edit($id)
    {
        $data = HttpHelper::agenda_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        return view('admin.agenda.edit',compact('data','instansi'));
    }
    public function update(Request $request)
    {
        #return $request->all();
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        $logo = isset($request->logo) ? json_decode($request->logo,true) : [];
        $mainVideo = isset($request->mainVideo) ? json_decode($request->mainVideo,true) : [];
        $slider2 = isset($request->slider_2) ? json_decode($request->slider_2,true) : [];
        $slider3 = isset($request->slider_3) ? json_decode($request->slider_3,true) : [];
        if(isset($logo['nama']) and $logo['nama'] == "\n"){
            $loc = public_path('/files-attachment/logos/');
            #$loc = ('../public_html/files-attachment/logos/');
            $lama_ft = $loc.str_replace(' ','_',$logo['nama']);
            if(file_exists($lama_ft)){
                File::delete( $lama_ft );
            }
            File::copy($logo['url'],$lama_ft);
            $body['logo']= str_replace(' ','_',$logo['nama']);
        }
        if(isset($mainVideo['nama']) and $mainVideo['nama'] == "\n"){
            $loc = public_path('/files-attachment/main-video/');
            #$loc = ('../public_html/files-attachment/main-video/');
            $lama_ft = $loc.str_replace(' ','_',$mainVideo['nama']);
            if(file_exists($lama_ft)){
                File::delete( $lama_ft );
            }
            File::copy($mainVideo['url'],$lama_ft);
            $body['main_video']= str_replace(' ','_',$mainVideo['nama']);
        }
        if(isset($slider2['nama']) and $slider2['nama'] == "\n"){
            $loc = public_path('/files-attachment/slider2/');
            #$loc = ('../public_html/files-attachment/slider2/');
            $lama_ft = $loc.str_replace(' ','_',$slider2['nama']);
            if(file_exists($lama_ft)){
                File::delete( $lama_ft );
            }
            File::copy($slider2['url'],$lama_ft);
            $body['slider_2']= str_replace(' ','_',$slider2['nama']);
        }
        if(isset($slider3['nama'])){
        $loc = public_path('/files-attachment/slider3/');
        #$loc = ('../public_html/files-attachment/slider3/');
        $lama_ft = $loc.str_replace(' ','_',$slider3['nama']);
        if(file_exists($lama_ft)){
            File::delete( $lama_ft );
        }
        File::copy($slider3['url'],$lama_ft);
        $body['slider_3']= str_replace(' ','_',$slider3['nama']);
    }

        return json_decode(HttpHelper::profil_update($body));
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
