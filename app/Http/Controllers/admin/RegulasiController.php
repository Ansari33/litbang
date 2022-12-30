<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;
use File;
use Response;

class RegulasiController extends Controller
{
  public function index()
  {
      return view('admin.regulasi.index');
  }
  public function list(Request $request)
  {
    return HttpHelper::regulasi_datatable($request->all());
  }
    public function create()
    {
        $instansi = [];
        return view('admin.regulasi.add',compact('instansi'));
    }

    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);

        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');
        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        //$body['attachment'] = [];
        foreach ($listFoto as $lt => $ur){

            $loc = ('../public_html/files-attachment/regulasi/');
            $namaFile = str_replace(' ','_',$ur['nama']);
            $tersimpan = $loc.$namaFile;
            if(file_exists($tersimpan)){
                File::delete( $tersimpan );
            }
            File::copy($ur['url'],$tersimpan);
            $body['file'] = $namaFile;
        }

        return json_decode(HttpHelper::regulasi_add($body));
    }

    public function edit($id)
    {
        $data = HttpHelper::regulasi_get(['id' => $id])['data'];

        return view('admin.regulasi.edit',compact('data',));
    }

    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);

        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');
        $listFoto = isset($request->filex) ? json_decode($request->filex,true) : [];
        //$body['attachment'] = [];
        foreach ($listFoto as $lt => $ur){

            $loc = ('../public_html/files-attachment/regulasi/');
            $namaFile = str_replace(' ','_',$ur['nama']);
            $tersimpan = $loc.$namaFile;
            if(file_exists($tersimpan)){
                File::delete( $tersimpan );
            }
            File::copy($ur['url'],$tersimpan);
            $body['file'] = $namaFile;
        }
        //return $body;
        return json_decode(HttpHelper::regulasi_update($body));
    }

    public function delete($id)
    {
        return json_decode(HttpHelper::regulasi_delete(['id' => $id]));
    }

    public function downloadRegulasi($file)
    {
        $regulasi = public_path(). "/regulasi/".$file;
        $headers = array(
            'Content-Type: application/pdf',
        );

        return Response::download($regulasi, $file,$headers);
    }

    public function uploadFile(Request $request){

        try {
            $namaFile = [];
            foreach ($request->all() as $fls => $fl){
                $namaFile[] = str_replace(' ','-',$fl->getClientOriginalName());
                $fl->move(('../public_html/files-attachment/regulasi/'),str_replace(' ','-',$fl->getClientOriginalName()));
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
