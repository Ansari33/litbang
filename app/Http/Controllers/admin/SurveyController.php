<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Composer\Autoload\includeFile;
use File;
use Session;
use function PHPUnit\Framework\objectHasAttribute;

class SurveyController extends Controller
{
  public function index()
  {

        if(!Session::get('GAuth')){
            redirect()->to('/redirect');
        }

         $form   = json_decode(HttpHelper::form_get(),true);
         $respon = json_decode(HttpHelper::form_responses_get(),true);

         $dataForm = [];

          if(array_key_exists('error',$form)){
             return  redirect()->to('/redirect');
          }else{
              //return $respon;
              foreach ($form['items'] as $item => $frm) {
                  $idQuestion = $frm['questionItem']['question']['questionId'];
                  $dataForm[$item] = [
                      'id' => $idQuestion,
                      'pertanyaan' => $frm['title'],
                      'opsi' => [],
                      'jawaban' => [],
                      'analisa' => [],
                  ];


                  foreach ( $respon['responses'] as $item2 => $res) {
                      //return $res;
                      if(array_key_exists($idQuestion,$res['answers'])){
                          $dataForm[$item]['jawaban'][] = $jawaban = $res['answers'][$idQuestion]['textAnswers']['answers'][0]['value'];
                          if(array_key_exists('choiceQuestion',$frm['questionItem']['question'])){
                              if(array_key_exists($jawaban,$dataForm[$item]['analisa'])){
                                  $dataForm[$item]['analisa'][$jawaban][] = $jawaban;
                              }else{
                                  $dataForm[$item]['analisa'][$jawaban] = [];
                                  $dataForm[$item]['analisa'][$jawaban][] = $jawaban;
                              }
                          }
                      }

                  }
              }
          }

      return view('admin.survey.index',compact('dataForm'));
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
        $data = json_decode($request->datas,true);
        $pelaksana = json_decode($request->pelaksana,true);
        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');
        $body['waktu'] = Carbon::parse($body['waktu'])->format('h:i:s');
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

        return json_decode(HttpHelper::agenda_update($body));
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
