<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use http\Url;
use Illuminate\Http\Request;
use File;
use App\Http\Controllers\HelperController;
use PHPMailer\PHPMailer\Exception;

class KelitbanganController extends Controller
{
  public function index()
  {
      return view('admin.kelitbangan.index');
  }

  public function list(Request $request)
  {
    return HttpHelper::kelitbangan_datatable($request->all());
  }

  public function listByTanggal(Request $request)
  {
    return HttpHelper::kelitbangan_datatable_by_tanggal($request->all());
  }

  public function create()
    {
        $instansi = HelperController::getInstansi();
        $nomor = HttpHelper::kelitbangan_nomor();
        return view('admin.kelitbangan.add',compact('instansi','nomor'));
    }

  public function store(Request $request)
    {

        $attachment = json_decode($request->filex,true);
        $data       = json_decode($request->datas,true);
        $pelaksana  = json_decode($request->pelaksana,true);

        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal']    = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['pelaksana']  = $pelaksana;
        $body['attachment'] = HelperController::saveAttachment('kelitbangan',$attachment);
        //return $body;
        return json_decode(HttpHelper::kelitbangan_add($body));
    }

  public function edit($id)
    {
        $data = HttpHelper::kelitbangan_get(['id' => $id])['data'];
        $instansi = HelperController::getInstansi();
        return view('admin.kelitbangan.edit',compact('data','instansi'));
    }

  public function update(Request $request)
    {
        $attachment = json_decode($request->filex,true);
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::parse($body['tanggal'])->format('Y-m-d');
        $body['pelaksana'] = $pelaksana;
        $body['attachment'] = HelperController::saveAttachment('kelitbangan',$attachment);

        return json_decode(HttpHelper::kelitbangan_update($body));
    }

  public function delete($id)
    {
        return json_decode(HttpHelper::kelitbangan_delete(['id' => $id]));
    }

  public function attachment(Request $request){

      try {
          $namaFile = [];
          foreach ($request->all() as $fls => $fl){
              $namaFile[] = str_replace(' ','-',$fl->getClientOriginalName());
              $fl->move(base_path('public/attachment'),str_replace(' ','-',$fl->getClientOriginalName()));
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

  public function export($tanggal)
    {
        $arrTanggal = explode('_',$tanggal);

        $data = HttpHelper::filterTanggalFakturPembelian(
            [
                'tgl_awal' => $arrTanggal[0],
                'tgl_akhir' => $arrTanggal[1]
            ])['data'];
        $dataExcel = [];
        $excepData = ['id','pemasok_id','jadwal_pengiriman_id','gudang_id'];
        foreach ( $data as $index => $item) {
            foreach ( $item as $id => $item2) {
                $total_bayar = 0;
                $total_harga = 0;
                if (!in_array($id,$excepData)){
                    if ($id == 'pemasok'){
                        $dataExcel[$index][] = $item2['nama'];
                    }
                    elseif ($id == 'kena_pajak' || $id == 'termasuk_pajak' ){
                        $dataExcel[$index][] = $item2 != 0 ? 'Ya' : 'Tidak';
                    }
                    elseif ($id == 'is_uang_muka' ){
                        $dataExcel[$index][] = $item2 != 0 ? 'Uang Muka' : 'Faktur';
                    }
                    elseif ($id == 'gudang' ){

                        $dataExcel[$index][] = $item2 !== null ? $item2['nama'] : '-';
                    }
                    elseif ($id == 'pembayaran_list' ){
                        foreach ($item2 as $i2 => $i3) {
                            $total_bayar += $i3['nominal_pembayaran'];
                        }

                        $dataExcel[$index][] = $total_bayar;
                    }
                    else{
                        $dataExcel[$index][] = $item2;

                    }


                }

            }
            $dataExcel[$index][] = $total_bayar == $item['total_harga'] ? 'Lunas' : 'Belum Lunas';
        }
        array_unshift($dataExcel,['Nomor', 'Tanggal','Kena Pajak','Termasuk Pajak','Tipe','Keterangan','Total Harga','Pemasok','Gudang','Terbayar','status']);
        //return $dataExcel;
        $export = new DataToExcel([
            $dataExcel
        ]);

        return Excel::download($export, 'invoices.xlsx');
    }

}
