<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        $dataForm = [];
        return view('admin.survey.index',compact('dataForm'));


          #return $dataForm;

      return view('admin.survey.index',compact('dataForm'));
  }

  public function list(Request $request)
  {
    return HttpHelper::survey_datatable($request->all());
  }
    public function create()
    {
//        $response = Http::withToken(Session::get('GToken'))->timeout(env('API_TIMEOUT', '10000'))->post('https://forms.googleapis.com/v1/forms');
//        return $response;
        $instansi = $this->getInstansi();
        return view('admin.survey.add',compact('instansi'));
    }
    public function store(Request $request)
    {
        $data = json_decode($request->datas,true);

        $body = [];
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
//        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');

        return json_decode(HttpHelper::survey_add($body));
    }
    public function edit($id)
    {
        $data = HttpHelper::survey_get(['id' => $id])['data'];
        $instansi = $this->getInstansi();
        return view('admin.survey.edit',compact('data','instansi'));
    }
    public function update(Request $request)
    {
        $data = json_decode($request->datas,true);
        foreach ($data as $index => $value){
            $body[$value['name']] = $value['value'];
        }
//        $body['tanggal'] = Carbon::createFromFormat('d/m/Y',$body['tanggal'])->format('Y-m-d');

        return json_decode(HttpHelper::survey_update($body));
    }
    public function delete($id)
    {
        return json_decode(HttpHelper::survey_delete(['id' => $id]));
        return view('admin.agenda.index');
    }

    public function hasil($id)
    {
        if(!Session::get('GAuth')){
            redirect()->to('/redirect');
        }


        $form   = json_decode(HttpHelper::form_get($id),true);
        $respon = json_decode(HttpHelper::form_responses_get($id),true);

        if(array_key_exists('error',$form ) or array_key_exists('error',$respon ) ){
            redirect()->to('/redirect');
        }


        if(count($respon) == 0){
            return 'Belum Ada Respon';
        }

        $dataForm = [];
        if(array_key_exists('error',$form)){
            return  redirect()->to('/redirect');
        }else{

            foreach ($form['items'] as $item => $frm) {

                if (array_key_exists('questionItem',$frm)){
                    $idQuestion = $frm['questionItem']['question']['questionId'];
                    $dataForm[$item] = [
                        'id' => $idQuestion,
                        'pertanyaan' => $frm['title'],
                        'opsi' => [],
                        'jawaban' => [],
                        'analisa' => [],
                    ];
                }
                elseif (array_key_exists('questionGroupItem',$frm)){
                   foreach($frm['questionGroupItem']['questions'] as $gropi => $gItem){

                       $dataForm[$item] = [
                           'id' => $gItem['questionId'],
                           'pertanyaan' => $frm['title'],
                           'opsi' => [],
                           'jawaban' => [],
                           'analisa' => [],
                       ];
                   }
                }

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

                if(array_key_exists('choiceQuestion',$frm['questionItem']['question'])){
                    $dataForm[$item]['opsi'] = array_map(fn($value) =>   $value['value'],$frm['questionItem']['question']['choiceQuestion']['options'] );
                    foreach ($dataForm[$item]['opsi'] as $opsi => $opt){
                        if(array_key_exists($opt, $dataForm[$item]['analisa'])){
                            $dataForm[$item]['series'][] = count($dataForm[$item]['analisa'][$opt])/count($dataForm[$item]['jawaban'])*100;
                        }else{
                            $dataForm[$item]['series'][] = 0;
                        }
                    }
                }


            }
        }

        //return $dataForm;
        return view('admin.survey.hasil',compact('dataForm'));
    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }
}
