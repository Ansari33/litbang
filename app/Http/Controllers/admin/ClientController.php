<?php

namespace App\Http\Controllers\admin;

use App\Helpers\HttpHelper;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\Factory;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;

class ClientController extends Controller
{
    public function index()
    {
        $kelitbangan = HttpHelper::kelitbangan_terkini()['data'];
        $inovasi = HttpHelper::inovasi_terkini()['data'];
        $attachment = HttpHelper::attachment_terkini()['data'];
        return view('home',compact('kelitbangan','inovasi','attachment'));
    }

    public function kelitbangan()
    {
        $data = HttpHelper::kelitbangan_list()['data'];
        return view('kelitbangan',compact('data'));
    }

    public function inovasi()
    {
        $data = HttpHelper::inovasi_list()['data'];
        return view('inovasi',compact('data'));
    }

    public function forumPenelitian()
    {
        $data = HttpHelper::usulan_penelitian_list_external()['data'];
        return view('forum.usulan_penelitian',compact('data'));
    }

    public function buatPenelitian()
    {
        $data =(HttpHelper::instansi_list())['data'];
        $instansi = collect($data)->pluck('nama','id')->toArray();
        $nomor = HttpHelper::usulan_penelitian_numbering()['data'];
        return view('forum.buat_penelitian',compact('instansi','nomor'));
    }

    public function forumInovasi()
    {
        $data = HttpHelper::usulan_inovasi_list()['data'];
        return view('forum.usulan_inovasi',compact('data'));
    }

    public function forumSurvey()
    {

        $data = HttpHelper::survey_list()['data'];

        return view('forum.survey',compact('data'));
    }

    public function forumRekomendasi()
    {
        $data = HttpHelper::usulan_inovasi_list()['data'];
        $nomor = '';
        $instansi = [];
        return view('forum.rekomendasi_penelitian',compact('data','nomor','instansi'));
    }

    public function buatInovasi()
    {
        $data =(HttpHelper::instansi_list())['data'];
        $instansi = collect($data)->pluck('nama','id')->toArray();
        return view('forum.buat_inovasi',compact('instansi'));
    }

    public function agenda()
    {
        $data = HttpHelper::agenda_list()['data'];
        return view('informasi.agenda_kegiatan',compact('data'));
    }

    public function berita(Request $page)
    {
        $coll_data = HttpHelper::berita_list(['page' => $page])['data'];
        $data = $this->paginate($coll_data);
        $data->withPath('/informasi-berita-artikel');
        return view('informasi.berita_artikel',compact('data','page'));
    }

    public function viewKelitbangan($id)
    {
        $data =  HttpHelper::kelitbangan_get(['id' => $id])['data'];
        $kelitbangan = HttpHelper::kelitbangan_terkini()['data'];
        $inovasi = null;
        return view('view-data.kelitbangan',compact('data','kelitbangan'));
    }

    public function viewInovasi($id)
    {
        $data =  HttpHelper::inovasi_get(['id' => $id])['data'];
        $inovasi = HttpHelper::inovasi_terkini()['data'];
        return view('view-data.inovasi',compact('data','inovasi'));
    }

    public function viewUsulanPenelitian($id)
    {
        $data =  HttpHelper::usulan_penelitian_get(['id' => $id])['data'];
        $inovasi_lain = HttpHelper::usulan_inovasi_terkini();
        return view('view-data.usulan_penelitian',compact('data'));
    }

    public function viewUsulanInovasi($id)
    {
        $data =  HttpHelper::usulan_inovasi_get(['id' => $id])['data'];
        $usulan_lain = HttpHelper::usulan_inovasi_terkini()['data'];
        return view('view-data.usulan_inovasi',compact('data','usulan_lain'));
    }

    public function viewBerita($id)
    {
        $data =  HttpHelper::berita_get(['id' => $id])['data'];
        $usulan_lain = HttpHelper::berita_terkini()['data'];
        return view('view-data.berita',compact('data','usulan_lain'));
    }

    public function galeriFoto()
    {
        $tempData = HttpHelper::attachment_get_foto()['data'];
        $data = $this->paginate($tempData,12);
        return view('galeri.foto',compact('data'));
    }

    public function galeriVideo()
    {
        $tempData = HttpHelper::attachment_get_video()['data'];
        $data = $this->paginate($tempData,12);
        return view('galeri.video',compact('data'));
    }

    public function regulasi()
    {
        $data = HttpHelper::regulasi_list()['data'];

        return view('informasi.regulasi',compact('data'));
    }

    public function uploadFile(Request $request){

        try {
            $namaFile = [];
            foreach ($request->all() as $fls => $fl){
                $namaFile[] = str_replace(' ','-',$fl->getClientOriginalName());
                $fl->move(base_path('public/'.$fl),str_replace(' ','-',$fl->getClientOriginalName()));
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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
