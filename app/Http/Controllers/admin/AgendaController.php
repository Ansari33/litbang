<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
  public function index()
  {
      return view('admin.agenda.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::agenda_datatable($request->all());
    return view('admin.agenda.index');
  }
    public function create()
    {
        $instansi = $this->getInstansi();
        return view('admin.agenda.add',compact('instansi'));
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);

        //$pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');
        $body['waktu'] = Carbon::parse($body['waktu'])->format('h:i:s');
        //$body['pelaksana'] = $pelaksana;
        $listFoto = json_decode($request->filex);
        $body['attachment'] = [];
        foreach ($listFoto as $lt => $ur){

            $loc = url('/')."\images\upload\d-";
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

        //return $body;
        return json_decode(HttpHelper::agenda_add($body));

        return view('admin.agenda.index');
    }
    public function edit($id)
    {
        $data = HttpHelper::agenda_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        return view('admin.agenda.edit',compact('data','instansi'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');
        $body['waktu'] = Carbon::parse($body['waktu'])->format('h:i:s');
        $listFoto = json_decode($request->filex);
        $body['attachment'] = [];
        foreach ($listFoto as $lt => $ur){

            $loc = url('/')."\images\upload\d-";
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

        return json_decode(HttpHelper::agenda_update($body));
        return view('admin.agenda.index');
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
