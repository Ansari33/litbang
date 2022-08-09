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

    public function createSuratKeluar()
  {
      $nomor = Str::random(10);
      return view('admin.surat.keluar.add',compact('nomor'));
  }

    public function indexSuratMasuk()
  {
      return view('admin.surat.masuk.index');
  }

    public function listSuratMasuk(Request  $request)
  {
      return HttpHelper::surat_masuk_datatable($request->all());
  }

    public function createSuratMasuk()
  {
        $nomor = Str::random(10);
        return view('admin.surat.masuk.add',compact('nomor'));
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
            $loc = public_path('/')."surat-masuk/";
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
        return view('admin.surat.masuk.edit',compact('data','instansi'));
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
            $loc = public_path('/')."surat-masuk/";
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
        $data = $body['surat_keluar'];
        $pdf = PDF::loadView('admin.surat.print', compact('data',))->setPaper('letter', 'potrait')->setWarnings(false);
        $content = $pdf->download()->getOriginalContent();
        File::put(public_path('/surat-keluar/').$body['nomor_urut'].'.pdf',$content);
        //return Storage::put('/surat-keluar/'.$body['nomor_urut'].'.pdf',$content);

        return json_decode(HttpHelper::surat_keluar_add($body));
    }

    public function editSuratKeluar($id)
    {
        $data = HttpHelper::surat_keluar_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        return view('admin.surat.keluar.edit',compact('data','instansi'));
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
            $loc = public_path('/')."surat-keluar/";
            $strNama = str_replace(' ','-',$ur['nama']);
            $lama_ft = $loc.$strNama;
            if(file_exists($loc.$strNama)){
                File::delete( $lama_ft );
            }
            File::copy($ur['url'],$loc.$strNama);
            $body['surat_keluar'] = $strNama;
        }
        $data = $body['surat_keluar'];
        $pdf = PDF::loadView('admin.surat.print', compact('data',))->setPaper('letter', 'potrait')->setWarnings(false);
        $content = $pdf->download()->getOriginalContent();
        File::put(public_path('/surat-keluar/').$body['nomor_urut'].'.pdf',$content);

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


}
