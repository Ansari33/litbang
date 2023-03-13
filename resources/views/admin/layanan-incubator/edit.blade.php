@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Pengajuan Layanan - View Data</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="tab-content" id="page_content">
                    <div class="card">
                        <form id="form_edit_kelitbangan">
                            <div class="card-body">
                                <div class="row mb-5">
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <input name="id" type="hidden" class="form-control" placeholder="Nomor" value="{{ $data['id'] }}" />
                                        <label>Nomor:</label>
                                        <input name="nomor" type="text" class="form-control" placeholder="Nomor" value="{{ $data['nomor'] }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tanggal:</label>
                                        <div class="input-group date" id="tanggal_uinov_edit" data-target-input="nearest">
                                            <input name="tanggal" id="tgl_uinov_edit" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#tanggal_uinov_edit" />
                                            <div class="input-group-append" data-target="#tanggal_uinov_edit" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Nomor Surat:</label>
                                        <input name="nomor_surat" type="text" class="form-control" placeholder=" Surat" value="{{ $data['nomor_surat'] }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>File Surat:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/surat-pengajuan/{{ $data['file_surat'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Layanan:</label>
                                        {{ Form::select('instansi',$layanan,explode(',',$data['layanan']), ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax','multiple' => 'multiple']) }}
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Instansi:</label>
                                        {{ Form::select('instansi',$instansi,$data['instansi'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Pengusul:</label>
                                        <input name="pengusul" type="text" class="form-control" placeholder="Pengusul" value="{{ $data['pengguna_layanan'] }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Nomor Kontak:</label>
                                        <input name="nomor_kontak" type="text" class="form-control" placeholder="Nomor Kontak" value="{{ $data['nomor_pengaju'] }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Email:</label>
                                        <input name="email" type="text" class="form-control" placeholder="Email" value="{{ $data['email_pengaju'] }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Status:</label>
                                        <input name="status"  id="status" type="text"  class="form-control" placeholder="Status" value="{{ $data['status'] }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Ide Gagasan:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['ide_gagasan'] }} </textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Latar Belakang:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['latar_belakang'] }} </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Dasar Hukum:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['dasar_hukum'] }} </textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Permasalahan:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['permasalahan'] }} </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Isu Strategis:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['isu_strategis'] }} </textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Metode Pembaharuan:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['metode'] }} </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Keunggulan:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['keunggulan'] }} </textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Cara Kerja:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['cara_kerja'] }} </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Tujuan:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['tujuan'] }} </textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Manfaat:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['manfaat'] }} </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Kaitan Dengan SDGS:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['sdgs'] }} </textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Proses:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['proses'] }} </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Kecepatan:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['kecepatan'] }} </textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Hasil:</label>
                                        <textarea class="form-control" rows="5"> {{ $data['hasil'] }} </textarea>
                                    </div>
                                </div>
                                <div class="form-group row" id="indikator">
                                    <div class="col-lg-12">
                                        <label><h6>Indikator: </h6></label>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Regulasi:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Peraturan Kepala Daerah/Peraturan Daerah',
                                            '2' => 'SK Kepala Daerah',
                                            '1' => 'SK Kepala Perangkat Daerah',
                                        ],$data['indikator_awal']['regulasi'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['regulasi'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['regulasi']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['regulasi']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>SDM:</label>
                                        {{ Form::select('sdm',[
                                            '3' => '>30 Orang',
                                            '2' => '11-30 Orang ',
                                            '1' => '1-10 Orang ',
                                        ],$data['indikator_awal']['sdm'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['sdm'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['sdm']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['sdm']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Angggaran:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0, T-1 dan T-2',
                                            '2' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-1 atau T-2',
                                            '1' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0 (tahun berjalan) ',
                                        ],$data['indikator_awal']['anggaran'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['anggaran'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['anggaran']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['anggaran']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Bimtek:</label>
                                        {{ Form::select('instansi',[
                                            '3' => '>2 Kali bimtek [bimtek, training, dan TOT] dalam 2 tahun terakhir',
                                            '2' => '2 Kali bimtek [bimtek, training, dan TOT] dalam 2 tahun terakhir',
                                            '1' => '1x bimtek [bimtek, training, dan TOT] dalam 2 tahun terakhir',
                                        ],$data['indikator_awal']['bimtek'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['bimtek'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['bimtek']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['bimtek']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Program:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Pemda sudah menuangkan program inovasi daerah dalam RKPD T-0, T-1 dan T-2',
                                            '2' => 'Pemda sudah menuangkan program inovasi daerah dalam RKPD T-1 dan T-2',
                                            '1' => 'Pemda sudah menuangkan program inovasi daerah dalam RKPD T-1 atau T-2',
                                        ],$data['indikator_awal']['program'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['program'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['program']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['program']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Aktor:</label>
                                        {{ Form::select('instansi',[
                                            '3' => '>5 Aktor',
                                            '2' => '4 Aktor',
                                            '1' => '3 Aktor',
                                        ],$data['indikator_awal']['aktor'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['aktor'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['aktor']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['aktor']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Pelaksana:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Ada pelaksana dan ditetapkan dengan SK Kepala Daerah',
                                            '2' => 'Ada pelaksana dan ditetapkan dengan SK Kepala Perangkat Daerah',
                                            '1' => 'Ada pelaksana namun tidak ditetapkan dengan SK Kepala Perangkat Daerah',
                                        ],$data['indikator_awal']['pelaksana'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['pelaksana'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['pelaksana']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['pelaksana']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Jejaring:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Inovasi melibatkan ≥5 Perangkat Daerah',
                                            '2' => 'Inovasi melibatkan 3-4 Perangkat Daerahal',
                                            '1' => 'Inovasi melibatkan 1-2 Perangkat Daerah',
                                        ],$data['indikator_awal']['jejaring'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['jejaring'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['regulasi']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['jejaring']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Sosialisasi:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Media Berita',
                                            '2' => 'Konten melalui Media Sosial',
                                            '1' => 'Foto Kegiatan berlatar belakang spanduk kegiatan inovasi yang diterapkan',
                                        ],$data['indikator_awal']['sosialisasi'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['sosialisasi'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['sosialisasi']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['sosialisasi']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Pedoman:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Telah terdapat Pedoman Teknis berupa buku yang dapat diakses secara online',
                                            '2' => 'Telah terdapat Pedoman Teknis berupa buku dalam bentuk elektronik ',
                                            '1' => 'Telah terdapat Pedoman Teknis berupa buku manual/cetak',
                                        ],$data['indikator_awal']['pedoman'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['pedoman'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['pedoman']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['pedoman']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Informasi:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Layanan aplikasi online',
                                            '2' => 'Layanan Email/Media Sosial',
                                            '1' => 'Layanan Telepon atau tatap muka langsung',
                                        ],$data['indikator_awal']['informasi'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['informasi'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['informasi']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['informasi']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Penciptaan:</label>
                                        {{ Form::select('instansi',[
                                            '3' => '1-4 Bulan',
                                            '2' => '5-8 Bulan',
                                            '1' => '9 Bulan keatas',
                                        ],$data['indikator_awal']['penciptaan'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['penciptaan'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['penciptaan']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['penciptaan']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Proses:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Hasil inovasi diperoleh dalam waktu 1 hari',
                                            '2' => 'Hasil inovasi diperoleh dalam waktu 2-5 hari',
                                            '1' => '≤Hasil inovasi diperoleh dalam waktu ≥6 hari',
                                        ],$data['indikator_awal']['proses'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['proses'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['proses']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['proses']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Penyelesaian:</label>
                                        {{ Form::select('instansi',[
                                            '3' => '≥71% ',
                                            '2' => '41%-70% ',
                                            '1' => '≤ 40%  Tidak ada pengaduan',
                                        ],$data['indikator_awal']['layanan'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['layanan'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['layanan']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['layanan']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Online:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Dukungan Perangkat Web Aplikasi dan Aplikasi Mobile [android atau iOS]',
                                            '2' => 'Dukungan Web Aplikas',
                                            '1' => 'Dukungan melalui Informasi Website atau Sosial Media',
                                        ],$data['indikator_awal']['online'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['online'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['online']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['online']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Replikasi:</label>
                                        {{ Form::select('instansi',[
                                            '3' => '3 Kali direplikasi di daerah lain yang berbeda',
                                            '2' => '2 Kali direplikasi di daerah lain yang berbeda',
                                            '1' => '1 Kali direplikasi di daerah lain)',
                                        ],$data['indikator_awal']['replikasi'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['replikasi'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['replikasi']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['replikasi']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Penggunaan IT:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Pelaksanaan kerja sudah didukung sistem',
                                            '2' => 'Pelaksanaan kerja secara elektronik',
                                            '1' => 'Pelaksanaan kerja secara manual/non elektronik',
                                        ],$data['indikator_awal']['it'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['it'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['it']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['it']}}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Kemanfaatan:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Jumlah pengguna atau penerima manfaat >201 Orang',
                                            '2' => 'Jumlah pengguna atau penerima manfaat 101-200 Orang',
                                            '1' => 'Jumlah pengguna atau penerima manfaat 1-100 Orang',
                                        ],$data['indikator_awal']['kemanfaatan'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['kemanfaatan'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['kemanfaatan']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['kemanfaatan']}}">
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Monitoring:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Laporan monev eksternal berdasarkan penelitian/kajian/analisis ',
                                            '2' => 'Pengukuran kepuasan dari Evaluasi Survei Kepuasan Masyarakat',
                                            '1' => 'Laporan monev internal Perangkat Daerah',
                                        ],$data['indikator_awal']['monitoring'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['monitoring'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['monitoring']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['monitoring']}}">
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <label>Kualitas:</label>
                                        {{ Form::select('instansi',[
                                            '3' => 'Memenuhi 5 Unsur Substansi',
                                            '2' => 'Memenuhi 3-4 Unsur Substansi',
                                            '1' => 'Memenuhi 1-2 Unsur Substansi',
                                        ],$data['indikator_awal']['kualitas'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-2">
                                        <label>File:</label>
                                        <p> <a class="btn btn-primary btn-sm" href="/files-attachment/indikator/{{ $data['file_indikator']['kualitas'] }}"> <i class="fa fa-download"></i> </a></p>
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Awal:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_awal']['kualitas']}}">
                                    </div>
                                    <div class="col-lg-2">
                                        <label>Nilai Akhir:</label>
                                        <input type="number" class="form-control" value="{{ $data['indikator_akhir']['kualitas']}}">
                                    </div>
                                   
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" id="btn_kelitbangan_edit_data" class="btn btn-primary mr-2">Save</button>
                                        <button type="button" class="btn btn-secondary mr-2" onclick="window.close()">Cancel</button>
                                        <button type="button" class="btn btn-secondary mr-2" >PDF</button>
                                        <button type="button" class="btn btn-success mr-2" >Excel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(function () {

            $('#tanggal_uinov_edit').datetimepicker({
                format: 'L',
            });

            $('#tgl_uinov_edit').val('{{ \Carbon\Carbon::parse( $data['tanggal'] )->format('m/d/Y') }}');

            tablePelaksana = $(`#tbl_pelaksana_kelitbangan_add`).DataTable({
                columnDefs :[
                    { 'width' : '5%', 'target' : 0 },
                    { 'width' : '85%', 'target' : 1 },
                    { 'width' : '10%', 'target' : 2 },
                ]
            });

            $('#menu_tab').scrollingTabs({
                bootstrapVersion: 4,
                enableSwiping: true,
                cssClassLeftArrow: 'fa fa-chevron-left',
                cssClassRightArrow: 'fa fa-chevron-right',
                scrollToTabEdge: true,
                handleDelayedScrollbar: true,
                scrollToActiveTab: true
            });
            $('#btn_kelitbangan_edit_data').click(function(){
                let data = $('#form_edit_kelitbangan').serializeArray();
                let pelaksana = [];
                let detail = tablePelaksana.rows().data().toArray();
                for (let index = 0; index < detail.length; index++) {
                    console.log(tablePelaksana.cell(index, 1).nodes().to$().find('input').val());
                    pelaksana[index] = tablePelaksana.cell(index, 1).nodes().to$().find('input').val();
                }
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    timeout: 50000,
                    url: '/layanan-incubator-update',
                    async: true,
                    data: {
                        datas : JSON.stringify(data), pelaksana : JSON.stringify(pelaksana)
                    },
                    success: function (res) {
                        console.log(res)
                        if (res.status === true){
                            Swal.fire('Berhasil!', 'Pengajuan Berhasil Diupdate!', 'success').then(
                                function (e) {
                                    window.close();
                                }
                            );

                        }else{
                            Swal.fire('Gagal!', res.message, 'danger');
                        }
                    },
                    error: function (res, textstatus) {
                        if (textstatus === "timeout") {
                            notice('Response Time Out', 'error');
                        } else {
                            notice(res.responseJSON.message, 'error');
                        }
                    }
                });
            });

        })

        function updateStatus(status){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                timeout: 50000,
                url: '/usulan-inovasi-update-status/',
                data:{'status' : status,'id' : '{{ $data['id'] }}'},
                async: true,
                success: function (res) {
                    console.log(res)
                    res.status === true ? Swal.fire('Berhasil!', res.message, 'success') : Swal.fire('Gagal!', res.message, 'danger');
                    $('#status').val(status)
                },
                error: function (res, textstatus) {
                    if (textstatus === "timeout") {
                        notice('Response Time Out', 'error');
                    } else {
                        notice(res.responseJSON.message, 'error');
                    }
                }
            });
        }
    </script>
@endpush
