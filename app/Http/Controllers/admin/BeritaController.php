<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use DOMDocument as doc;


class BeritaController extends Controller
{
  public function index()
  {
      return view('admin.berita.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::berita_datatable($request->all());
  }

    public function listByTanggal(Request $request)
    {
        return HttpHelper::berita_datatable_by_tanggal($request->all());
    }
    public function create()
    {
        $instansi = $this->getInstansi();
        return view('admin.berita.add',compact('instansi'));
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
        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        $body['attachment'] = [];

        $html = new \DOMDocument();
        $html->loadHTML($body['deskripsi']);
        $listFoto = $html->getElementsByTagName('img');

        foreach ($listFoto as $ii => $vv){
            $src = $vv->getAttribute('src') ;
            $extension = explode('/', explode(':', substr($src, 0, strpos($src, ';')))[1])[1];
            $namaFile = str_replace(' ','-',$body['judul']).'-'.$ii.'.'.strval($extension);
            $data = substr($src, strpos($src, ',') + 1);
            $data = base64_decode($data);


            file_put_contents(public_path('/files-attachment/berita/').$namaFile, $data);
            $urlFile = public_path('/files-attachment/berita/').$namaFile;
            $body['attachment'][] = ['nama' => $namaFile, 'url' => $urlFile];
        }
        return json_decode(HttpHelper::berita_add($body));
    }
    public function edit($id)
    {
        $data = HttpHelper::berita_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        return view('admin.berita.edit',compact('data','instansi'));
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
//        $body['waktu'] = Carbon::parse($body['waktu'])->format('h:i:s');
        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        $body['attachment'] = [];

        $html = new \DOMDocument();
        $html->loadHTML($body['deskripsi']);
        $listFoto = $html->getElementsByTagName('img');

        foreach ($listFoto as $ii => $vv){
            $src = $vv->getAttribute('src') ;
            $extension = explode('/', explode(':', substr($src, 0, strpos($src, ';')))[1])[1];
            $namaFile = str_replace(' ','-',$body['judul']).'-'.$ii.'.'.strval($extension);
            $data = substr($src, strpos($src, ',') + 1);
            $data = base64_decode($data);


            file_put_contents(public_path('/files-attachment/berita/').$namaFile, $data);
            $urlFile = public_path('/files-attachment/berita/').$namaFile;
            $body['attachment'][] = ['nama' => $namaFile, 'url' => $urlFile];
        }

        return json_decode(HttpHelper::berita_update($body));
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::berita_delete(['id' => $id]));
        return view('admin.berita.index');
    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }
}
