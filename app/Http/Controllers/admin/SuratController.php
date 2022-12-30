<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Str;
use Response;
use PDF;
use Storage;

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

    public function listSuratKeluarByTanggal(Request  $request)
    {
        return HttpHelper::surat_keluar_datatable_by_tanggal($request->all());
    }

    public function createSuratKeluar()
  {
      $jenis_surat = $this->getJenisSurat();
      $nomor = HttpHelper::surat_keluar_nomor();
      return view('admin.surat.keluar.add',compact('nomor','jenis_surat'));
  }

    public function indexSuratMasuk()
  {
      return view('admin.surat.masuk.index');
  }

    public function listSuratMasuk(Request  $request)
  {
      return HttpHelper::surat_masuk_datatable($request->all());
  }

    public function listSuratMasukByTanggal(Request  $request)
    {
        return HttpHelper::surat_masuk_datatable_by_tanggal($request->all());
    }

    public function createSuratMasuk()
  {
      return $jenis_surat = $this->getJenisSurat();
        $nomor = HttpHelper::surat_masuk_nomor();
        $instansi = $this->getInstansi();
        return view('admin.surat.masuk.add',compact('nomor','jenis_surat','instansi'));
  }

    public function storeSuratMasuk(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal_surat'] = Carbon::parse($body['tanggal_surat'])->format('Y-m-d');
        $body['tanggal_penerimaan'] = Carbon::parse($body['tanggal_penerimaan'])->format('Y-m-d');

        $listFoto = isset($request->file_surat) ? json_decode($request->file_surat,true) : [];
        foreach ($listFoto as $lt => $ur){
            $loc = ('../public_html/files-attachment/surat-masuk/');
            $strNama = str_replace(' ','-',$ur['nama']);
            $lama_ft = $loc.$strNama;
            if(file_exists($loc.$strNama)){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$strNama);
            $body['surat_masuk'] = str_replace(' ','-',$ur['nama']);
        }


        return json_decode(HttpHelper::surat_masuk_add($body));
    }

    public function editSuratMasuk($id)
    {
        $data = HttpHelper::surat_masuk_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        $jenis_surat = $this->getJenisSurat();
        return view('admin.surat.masuk.edit',compact('data','instansi','jenis_surat'));
    }

    public function updateSuratMasuk(Request $request)
    {
        $data = json_decode($request->datas,true);

        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal_surat'] = Carbon::parse($body['tanggal_surat'])->format('Y-m-d');
        $body['tanggal_penerimaan'] = Carbon::parse($body['tanggal_penerimaan'])->format('Y-m-d');

        $listFoto = isset($request->file_surat) ? json_decode($request->file_surat,true) : [];
        foreach ($listFoto as $lt => $ur){
            $loc = ('../public_html/files-attachment/surat-masuk/');
            $strNama = str_replace(' ','-',$ur['nama']);
            $lama_ft = $loc.$strNama;
            if(file_exists($loc.$strNama)){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$strNama);
            $body['surat_masuk'] = str_replace(' ','-',$ur['nama']);
        }

        return json_decode(HttpHelper::surat_masuk_update($body));
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

        //return $request->all();
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal_surat'] = Carbon::parse($body['tanggal_surat'])->format('Y-m-d');

        $listFoto = isset($request->file_surat) ? json_decode($request->file_surat,true) : [];
        foreach ($listFoto as $lt => $ur){
            $loc = ('../public_html/files-attachment/surat-keluar/');
            $strNama = str_replace(' ','-',$ur['nama']);
            $lama_ft = $loc.$strNama;
            if(file_exists($loc.$strNama)){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$strNama);
            $body['surat_keluar'] = $strNama;
        }
        #$data = $body['surat_keluar'];

        return json_decode(HttpHelper::surat_keluar_add($body));
    }

    public function editSuratKeluar($id)
    {
        $data = HttpHelper::surat_keluar_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        $jenis_surat = $this->getJenisSurat();
        return view('admin.surat.keluar.edit',compact('data','instansi','jenis_surat'));
    }

    public function updateSuratKeluar(Request $request)
    {

        $data = json_decode($request->datas,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal_surat'] = Carbon::parse($body['tanggal_surat'])->format('Y-m-d');

        $listFoto = isset($request->file_surat) ? json_decode($request->file_surat,true) : [];
        foreach ($listFoto as $lt => $ur){
            $loc = ('../public_html/files-attachment/surat-keluar/');
            $strNama = str_replace(' ','-',$ur['nama']);
            $lama_ft = $loc.$strNama;
            if(file_exists($loc.$strNama)){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$strNama);
            $body['surat_keluar'] = $strNama;
        };

        return json_decode(HttpHelper::surat_keluar_update($body));
    }

    public function delete($id)
    {
        return json_decode(HttpHelper::usulan_penelitian_delete(['id' => $id]));
    }

    public function deleteSuratKeluar($id)
    {
        return json_decode(HttpHelper::surat_keluar_delete(['id' => $id]));
    }

    public function deleteSuratMasuk($id)
    {
        return json_decode(HttpHelper::surat_masuk_delete(['id' => $id]));
    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }

    public function getJenisSurat()
    {
        $data = HttpHelper::jenis_surat_list()['data'];
        return collect($data)->every(function ($item, $key) {
            $item['kode-jenis'] = $item['kode']. '-'. $item['jenis'];
        });

        return collect($data)->map(function ($post) {
                $post['kode_jenis'] = $post['kode'].'-'.$post['jenis'];
                return $post;
            })->pluck('kode_jenis','id')->toArray();
    }

    public function openFile($request)
    {
        $file = public_path(). "/surat-keluar/".$request;

        $headers = array(
            'Content-Type: application/pdf',
        );

       return Response::download($file, $request,$headers);
    }

    public function downloadSuratMasuk($request)
    {
        $file = public_path(). "/surat-masuk/".$request;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($file, $request,$headers);
    }

    public function indexJenisSurat()
    {
        return view('admin.surat.jenis.index');
    }

    public function listJenisSurat(Request  $request)
    {
        return HttpHelper::jenis_surat_datatable($request->all());
    }

    public function createJenisSurat()
    {
        return view('admin.surat.jenis.add');
    }

    public function storeJenisSurat(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];

        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        return json_decode(HttpHelper::jenis_surat_add($body));
    }

    public function editJenisSurat($id)
    {
        $data = HttpHelper::jenis_surat_get(['id' => $id])['data'];

        return view('admin.surat.jenis.edit',compact('data',));
    }

    public function updateJenisSurat(Request $request)
    {
        $data = json_decode($request->datas,true);
        $body = [];

        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }

        return json_decode(HttpHelper::jenis_surat_update($body));
    }

    public function deleteJenisSurat($id)
    {
        return json_decode(HttpHelper::jenis_surat_delete(['id' => $id]));
    }

    public function uploadSuratKeluar(Request $request){

        try {
            $namaFile = [];
            foreach ($request->all() as $fls => $fl){
                $namaFile[] = str_replace(' ','-',$fl->getClientOriginalName());
                $fl->move(('../public_html/files-attachment/surat-keluar/'),str_replace(' ','-',$fl->getClientOriginalName()));
            }

            return response()->json([
                'files' => $namaFile,
                'status' => true,
                'message' => 'Files Upload Success!'
            ],200
            );
        }catch (\Exception $er){
            return response()->json([
                'message' => $er->getMessage(),
                'status' => false,
            ],500
            );
        }

    }

    public function uploadSuratMasuk(Request $request){

        try {
            $namaFile = [];
            foreach ($request->all() as $fls => $fl){
                $namaFile[] = str_replace(' ','-',$fl->getClientOriginalName());
                $fl->move(('../public_html/files-attachment/surat-masuk/'),str_replace(' ','-',$fl->getClientOriginalName()));
            }

            return response()->json([
                'files' => $namaFile,
                'status' => true,
                'message' => 'Files Upload Success!'
            ],200
            );
        }catch (\Exception $er){
            return response()->json([
                'message' => $er->getMessage(),
                'status' => false,
            ],500
            );
        }

    }


}
