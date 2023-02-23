<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;
use File;

class KategoriInformasiPublikController extends Controller
{
  public function index()
  {
      return view('admin.kategori-informasi-publik.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::kategori_informasi_publik_datatable($request->all());
  }


    public function create()
    {
        $jenis = [
            'Informasi Berkala' => 'Informasi Berkala',
            'Informasi Serta Merta' => 'Informasi Serta Merta',
            'Informasi Tersedia Setiap Saat' => 'Informasi Tersedia Setiap Saat',
        ];
        return view('admin.kategori-informasi-publik.add', compact('jenis'));
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        //return $body;
        return json_decode(HttpHelper::kategori_informasi_publik_add($body));
    }
    public function edit($id)
    {
        $jenis = [
            'Informasi Berkala' => 'Informasi Berkala',
            'Informasi Serta Merta' => 'Informasi Serta Merta',
            'Informasi Tersedia Setiap Saat' => 'Informasi Tersedia Setiap Saat',
        ];
        $data = HttpHelper::kategori_informasi_publik_get(['id' => $id])['data'];
        return view('admin.kategori-informasi-publik.edit',compact('data','jenis'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        return json_decode(HttpHelper::kategori_informasi_publik_update($body));
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::kategori_informasi_publik_delete(['id' => $id]));
    }

    public function getByJenis($id)
    {
        return (HttpHelper::kategori_informasi_publik_by_jenis(['jenis' => $id]))['data'];
    }

}
