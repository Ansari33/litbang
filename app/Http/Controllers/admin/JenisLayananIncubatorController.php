<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;
use File;

class JenisLayananIncubatorController extends Controller
{
  public function index()
  {
      return view('admin.jenis-layanan-incubator.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::jenis_layanan_incubator_datatable($request->all());
  }


    public function create()
    {

        return view('admin.jenis-layanan-incubator.add');
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        //return $body;
        return json_decode(HttpHelper::jenis_layanan_incubator_add($body));
    }
    public function edit($id)
    {
        $data = HttpHelper::jenis_layanan_incubator_get(['id' => $id])['data'];
        return view('admin.jenis-layanan-incubator.edit',compact('data'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        return json_decode(HttpHelper::jenis_layanan_incubator_update($body));
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::agenda_delete(['id' => $id]));
        return view('admin.agenda.index');
    }

}
