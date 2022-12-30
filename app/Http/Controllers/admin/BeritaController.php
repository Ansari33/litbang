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

        $ss = [];
        foreach ($listFoto as $ii => $vv){
            $src = $vv->getAttribute('src') ;
            $arr_ext = explode('.',$src);
            $extension = \Arr::last($arr_ext);
            $namaFile = str_replace(' ','-',$body['judul']).'-'.$ii;
            $gambar = null;
            $urlFile = '';

            $image = substr($src, strpos($src, ',') + 1);
            if (base64_decode($image,true)){

                $image = str_replace('data:image/'.$extension.';base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $ss[] = $src;
                \File::put(base_path().'/files-attachment/berita/' .$namaFile.'.jpg', base64_decode($image));
                $urlFile = '/files-attachment/berita/'.$namaFile.'.jpg';

            }else{
                $gambar = $src;
                $ss[] = $src;
                $arr_ext = explode('.',$src);
                $extension = \Arr::last($arr_ext);

                $namaFile += '.'.$extension;
                file_put_contents((base_path().'/files-attachment/berita/').$namaFile, $gambar);
                $urlFile = '/files-attachment/berita/'.$namaFile;
            }

            $body['attachment'][] = ['nama' => $namaFile, 'url' => $urlFile,'tipe' => 'image'];
        }
        #return implode(',',$ss);

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
            $arr_ext = explode('.',$src);
            $extension = \Arr::last($arr_ext);
            $namaFile = str_replace(' ','-',$body['judul']).'-'.$ii;
            $gambar = null;
            $url = '';

            $image = substr($src, strpos($src, ',') + 1);
            if (base64_decode($image,true)){

                $image = str_replace('data:image/'.$extension.';base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $ss[] = $src;
                \File::put('../public_html/files-attachment/berita/' .$namaFile.'.jpg', base64_decode($image));
                $url = '/files-attachment/berita/' .$namaFile.'.jpg';

            }else{
                $gambar = $src;
                $ss[] = $src;
                $arr_ext = explode('.',$src);
                $extension = \Arr::last($arr_ext);

                $namaFile += '.'.$extension;
                file_put_contents(('../public_html/files-attachment/berita/').$namaFile, $gambar);
                $url = '/files-attachment/berita/' .$namaFile.'.'.$extension;

            }

            //$urlFile = ('/files-attachment/berita/').$namaFile;
            $body['attachment'][] = ['nama' => $namaFile, 'url' => $url,'tipe' => 'image'];
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
