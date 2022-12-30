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

    public function saveAttachment($dir,$attachment){
        $attachmentData = [];
        foreach ($attachment as $lt => $ur){

            $loc = ('../public_html/files-attachment/').$dir;
            $fileIni = $loc.str_replace(' ','-',$ur['nama']);
            if(file_exists($fileIni)){
                File::delete( $fileIni );
            }
            copy($ur['url'],$fileIni);
            $attachmentData[] = [
                'nama' => str_replace(' ','-',$ur['nama']),
                'url'  => '/files-attachment/'.$dir.str_replace(' ','-',$ur['nama']),
                'tipe' => $ur['tipe']
            ];
        }
        return $attachmentData;

    }

    public function saveRangkumanKelitbangan($attachment){
        $attachmentData = [];

            $defPath = "files-attachment/rangkuman-kelitbangan/";
            $loc ='../public_html/'.$defPath;
            $fileIni = $loc.str_replace(' ','-',$attachment['nama']);
            if(file_exists($fileIni)){
                File::delete( $fileIni );
            }
            copy($attachment['url'],$fileIni);

        return $attachmentData;

    }

    public function getInstansi()
    {
        $data = HttpHelper::instansi_list()['data'];
        return collect($data)->pluck('nama','id')->toArray();
    }

}
