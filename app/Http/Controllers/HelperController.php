<?php

namespace App\Http\Controllers;


use App\Helpers\HttpHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use File;


class HelperController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function saveAttachment($module,$attachment){
        $attachmentData = [];
        foreach ($attachment as $lt => $ur){
            $defPath = "/attachment/images/";
            if ($ur['tipe'] == 'image'){
                $defPath = $defPath;
            }elseif ($ur['tipe'] == 'video'){
                $defPath = "/attachment/videos/";
            }
            else{
                $defPath = "/attachment/documents/";
            }

            $loc = public_path('/').$defPath;
            $fileIni = $loc.$module.'-'.$ur['nama'];
            if(file_exists($fileIni)){
                File::delete( $fileIni );
            }
            copy($ur['url'],$fileIni);
            $attachmentData[] = [
                'nama' => $ur['nama'],
                'url'  => $fileIni,
                'tipe' => $ur['tipe']
            ];
        }
        return $attachmentData;

    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }

}
