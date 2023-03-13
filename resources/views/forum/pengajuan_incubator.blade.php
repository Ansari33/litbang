@extends('layout')

@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="form-widget">

                <div class="form-result" style="text-align: center">
                    <h3> <u>Form Layanan INKUBATOR </u></h3>
                </div>

                <div class="row shadow bg-light border">

                    <link href="https://releases.transloadit.com/uppy/v2.12.2/uppy.min.css" rel="stylesheet">
                    <div class="col-lg-12 p-5">
                        <form class="row mb-0" id="form_usulan_penelitian"   enctype="multipart/form-data">
                            <div class="form-process">
                                <div class="css3-spinner">
                                    <div class="css3-spinner-scaler"></div>
                                </div>
                            </div>

                            <div class="col-6 form-group">
                                <div class="row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="fitness-form-name">Nomor Surat:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="nomor_surat" id="fitness-form-name" class="form-control required"  >
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="fitness-form-name">File Surat:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div id="drag-drop-area"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="fitness-form-name">Layanan:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ Form::select('layanan[]',$layanan,null, ['title' => 'Pilih Layanan','class' => 'form-control multi-select2', 'id' => 'jenis_layanan', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax','multiple' => 'multiple']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="fitness-form-name">Nama Pengaju:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="pengguna_layanan" id="fitness-form-name" class="form-control required" value="" placeholder="Nama Pengusul">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="fitness-form-email">Nomor Kontak:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="nomor_pengaju" id="fitness-form-email" class="form-control required" value="" placeholder="No Kontak Pengusul">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="fitness-form-email">Email:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" name="email_pengaju" id="fitness-form-email" class="form-control required" value="" placeholder="Email Pengusul">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 form-group">
                                <div class="row">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="fitness-form-name">Instansi:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        {{ Form::select('instansi',$instansi,null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 form-group" id="ide-gagasan" style="display: none">
                                <div class="row form-group">
                                    <div class="col-sm-3 col-form-label">
                                        <label for="fitness-form-name">Ide Gagasan:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="ide_gagasan"></textarea>
                                    </div>
                                    <div class="mt-3"></div>
                                    <div class="col-sm-3 col-form-label">
                                        <label for="fitness-form-name">Latar Belakang:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" name="latar_belakang" rows="5"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div id="profil" class="col-lg-12 row mt-4" style="display:none;">
                                <label for="fitness-form-name"><strong>Profil</strong>:</label>
                                <label for="fitness-form-name">Rancang Bangun:</label>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Dasar Hukum:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="dasar_hukum"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Permasalahan:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="permasalahan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Isu Strategi:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="isu_strategis"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Metode Pembaharuan:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="metode"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Keunggulan:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="keunggulan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Cara Kerja:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="cara_kerja"></textarea>
                                        </div>
                                    </div>
                                </div>
                                 <div class="mt-4">

                                 </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Tujuan:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="tujuan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Manfaat:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="manfaat"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Kaitan Dengan SDGS:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="kaitan_dengan_sdgs"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Proses:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="proses"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Kecepatan:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="kecepatan"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Hasil:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="hasil"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div id="validasi" class="col-lg-12 row mt-5" style="display:none;">
                                <label for="fitness-form-name"><strong>Validasi</strong>:</label>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Regulasi Inovasi Daerah:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('regulasi',[
                                            '3' => 'Peraturan Kepala Daerah/Peraturan Daerah',
                                            '2' => 'SK Kepala Daerah',
                                            '1' => 'SK Kepala Perangkat Daerah',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-regulasi"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Ketersediaan SDM:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('ketersediaan_sdm',[
                                            '3' => '>30 Orang',
                                            '2' => '11-30 Orang ',
                                            '1' => '1-10 Orang ',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-sdm"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Dukungan Anggaran:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('dukugan_anggaran',[
                                            '3' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0, T-1 dan T-2',
                                            '2' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-1 atau T-2',
                                            '1' => 'Anggaran dialokasikan pada kegiatan penerapan inovasi di T-0 (tahun berjalan) ',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File :</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-anggaran"></div>
                                        </div>
                                    </div>
                                </div>
                                 <div style="height: 35px;">

                                 </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Bimtek Inovasi:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('bimtek',[
                                            '3' => '>2 Kali bimtek [bimtek, training, dan TOT] dalam 2 tahun terakhir',
                                            '2' => '2 Kali bimtek [bimtek, training, dan TOT] dalam 2 tahun terakhir',
                                            '1' => '1x bimtek [bimtek, training, dan TOT] dalam 2 tahun terakhir',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File :</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-bimtek"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Program dan Kegiatan:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('program_kegiatan',[
                                            '3' => 'Pemda sudah menuangkan program inovasi daerah dalam RKPD T-0, T-1 dan T-2',
                                            '2' => 'Pemda sudah menuangkan program inovasi daerah dalam RKPD T-1 dan T-2',
                                            '1' => 'Pemda sudah menuangkan program inovasi daerah dalam RKPD T-1 atau T-2',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File :</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-program"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Keterlibatan Aktor:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('keterlibatan_aktor',[
                                            '3' => '>5 Aktor',
                                            '2' => '4 Aktor',
                                            '1' => '3 Aktor',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-aktor"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Pelaksana Inovasi:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('pelaksana',[
                                            '3' => 'Ada pelaksana dan ditetapkan dengan SK Kepala Daerah',
                                            '2' => 'Ada pelaksana dan ditetapkan dengan SK Kepala Perangkat Daerah',
                                            '1' => 'Ada pelaksana namun tidak ditetapkan dengan SK Kepala Perangkat Daerah',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-pelaksana"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Jejaring Inovasi:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('jejaring',[
                                            '3' => 'Inovasi melibatkan ≥5 Perangkat Daerah',
                                            '2' => 'Inovasi melibatkan 3-4 Perangkat Daerahal',
                                            '1' => 'Inovasi melibatkan 1-2 Perangkat Daerah',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-jejaring"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Sosialisasi Inovasi:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('sosialisasi',[
                                            '3' => 'Media Berita',
                                            '2' => 'Konten melalui Media Sosial',
                                            '1' => 'Foto Kegiatan berlatar belakang spanduk kegiatan inovasi yang diterapkan',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-sosialisasi"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Pedoman Teknis:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('pedoman_teknis',[
                                            '3' => 'Telah terdapat Pedoman Teknis berupa buku yang dapat diakses secara online',
                                            '2' => 'Telah terdapat Pedoman Teknis berupa buku dalam bentuk elektronik ',
                                            '1' => 'Telah terdapat Pedoman Teknis berupa buku manual/cetak',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-pedoman"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Kemudahan Layanan:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('kemudahan_informasi',[
                                            '3' => 'Layanan aplikasi online',
                                            '2' => 'Layanan Email/Media Sosial',
                                            '1' => 'Layanan Telepon atau tatap muka langsung',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-informasi"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Kecepatan Penciptaaan:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('kecepatan_penciptaan',[
                                            '3' => '1-4 Bulan',
                                            '2' => '5-8 Bulan',
                                            '1' => '9 Bulan keatas',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-penciptaan"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Kemudahan Proses:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('kemudahan_proses',[
                                            '3' => 'Hasil inovasi diperoleh dalam waktu 1 hari',
                                            '2' => 'Hasil inovasi diperoleh dalam waktu 2-5 hari',
                                            '1' => '≤Hasil inovasi diperoleh dalam waktu ≥6 hari',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-proses"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Penyelesaian Layanan:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('penyelesaian_layanan',[
                                            '3' => '≥71% ',
                                            '2' => '41%-70% ',
                                            '1' => '≤ 40%  Tidak ada pengaduan',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-penyelesaian"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Online Sistem:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('online_sistem',[
                                            '3' => 'Dukungan Perangkat Web Aplikasi dan Aplikasi Mobile [android atau iOS]',
                                            '2' => 'Dukungan Web Aplikas',
                                            '1' => 'Dukungan melalui Informasi Website atau Sosial Media',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-online"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Replikasi:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('replikasi',[
                                            '3' => '3 Kali direplikasi di daerah lain yang berbeda',
                                            '2' => '2 Kali direplikasi di daerah lain yang berbeda',
                                            '1' => '1 Kali direplikasi di daerah lain)',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-replikasi"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Penggunaan IT:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('penggunaan_it',[
                                            '3' => 'Pelaksanaan kerja sudah didukung sistem',
                                            '2' => 'Pelaksanaan kerja secara elektronik',
                                            '1' => 'Pelaksanaan kerja secara manual/non elektronik',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-it"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Kemanfaatan Inovasi:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('kemanfaatan',[
                                            '3' => 'Jumlah pengguna atau penerima manfaat >201 Orang',
                                            '2' => 'Jumlah pengguna atau penerima manfaat 101-200 Orang',
                                            '1' => 'Jumlah pengguna atau penerima manfaat 1-100 Orang',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-kemanfaatan"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Monitoring dan Evaluasi:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('monitoring_evaluasi',[
                                            '3' => 'Laporan monev eksternal berdasarkan penelitian/kajian/analisis ',
                                            '2' => 'Pengukuran kepuasan dari Evaluasi Survei Kepuasan Masyarakat',
                                            '1' => 'Laporan monev internal Perangkat Daerah',
                                        ],null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-monitoring"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group" >
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">Kualitas Inovasi:</label>
                                        </div>
                                        <div class="col-sm-9">
                                        {{ Form::select('kualitas',[
                                            '3' => 'Memenuhi 5 Unsur Substansi',
                                            '2' => 'Memenuhi 3-4 Unsur Substansi',
                                            '1' => 'Memenuhi 1-2 Unsur Substansi',
                                        ],null, ['title' => 'Pilih Kualitas','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6 form-group">
                                    <div class="row">
                                        <div class="col-sm-3 col-form-label">
                                            <label for="fitness-form-name">File:</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <div id="drag-drop-area-kualitas"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-12 d-flex justify-content-end align-items-center">
                                <div id="alert-info" ></div>
                                <button type="button" id="btn_submit_usulan" class="btn btn-success ms-2 ml-5">Submit Usulan</button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </div>
    </div>
@endsection
@push('custom-scripts')
    <script src="{{ asset('admin/plugins/custom/uppy/uppy.bundle.js') }}"></script>
    <script>
        $(function () {
            $('.multi-select2').select2();
        })
        var file_list = [];
        var indikator = 0;
        var file_regulasi = null;;
        var file_sdm = null;
        var file_anggaran = null;
        var file_bimtek = null;
        var file_program = null;
        var file_aktor = null;
        var file_pelaksana = null;
        var file_jejaring = null;
        var file_sosialisasi = null;
        var file_pedoman = null;
        var file_informasi = null;
        var file_penciptaan = null;
        var file_proses = null;
        var file_penyelesaian = null;
        var file_online = null;
        var file_replikasi = null;
        var file_it = null;
        var file_kemanfaatan =null;null;
        var file_monitoring = null;
        var file_kualitas = null;
        var uppy = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy.on('complete', (result) => {
            //console.log(result);
            file_list = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });

        var uppy2 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-regulasi',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy2.on('complete', (result) => {
            //console.log(result);
            file_regulasi = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });

        var uppy3 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-sdm',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy3.on('complete', (result) => {
            //console.log(result);
            file_sdm = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy4 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-anggaran',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy4.on('complete', (result) => {
            //console.log(result);
            file_anggaran = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy5 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-bimtek',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy5.on('complete', (result) => {
            //console.log(result);
            file_bimtek = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy6 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-program',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy6.on('complete', (result) => {
            //console.log(result);
            file_program = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy7 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-aktor',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy7.on('complete', (result) => {
            //console.log(result);
            file_aktor = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy8 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-pelaksana',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy8.on('complete', (result) => {
            //console.log(result);
            file_pelaksana = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy9 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-jejaring',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy9.on('complete', (result) => {
            //console.log(result);
            file_jejaring = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy10 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-sosialisasi',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy10.on('complete', (result) => {
            //console.log(result);
            file_sosialisasi = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy11 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-pedoman',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy11.on('complete', (result) => {
            //console.log(result);
            file_pedoman = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy12 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-informasi',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy12.on('complete', (result) => {
            //console.log(result);
            file_informasi = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy13 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-penciptaan',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy13.on('complete', (result) => {
            //console.log(result);
            file_penciptaan = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy14 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-proses',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy14.on('complete', (result) => {
            //console.log(result);
            file_proses = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy15 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-penyelesaian',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy15.on('complete', (result) => {
            //console.log(result);
            file_penyelesaian = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy16 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-online',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy16.on('complete', (result) => {
            //console.log(result);
            file_online = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy17 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-replikasi',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy17.on('complete', (result) => {
            //console.log(result);
            file_replikasi = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy18 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-it',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy18.on('complete', (result) => {
            //console.log(result);
            file_it = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy19 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-kemanfaatan',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy19.on('complete', (result) => {
            //console.log(result);
            file_kemanfaatan = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy20 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-monitoring',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy20.on('complete', (result) => {
            //console.log(result);
            file_monitoring = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
        var uppy21 = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area-kualitas',
                height: 150,
                maxNumberOfFiles: 1,
                minNumberOfFiles: 1,
                restrictions: {
                    //maxFileSize: 1000000, // 1mb
                    maxNumberOfFiles: 1,
                    minNumberOfFiles: 1
                }
            })

            .use(Uppy.Tus, {endpoint: 'https://tusd.tusdemo.net/files/'})

        uppy21.on('complete', (result) => {
            //console.log(result);
            file_kualitas = (result.successful.map((e, index) => { return { url :e.response.uploadURL,nama :e.name,tipe:e.type.split('/')[0] }  }));
            console.log('Upload complete! We’ve uploaded these files:', result.successful)
        });
    </script>

    <script>
        $('#btn_submit_usulan').click(function(){
            $('#btn_submit_usulan').attr('disabled',true);
            $('#alert-info').html('Memproses...  '+'<div class="class="spinner-grow"></div>');
             let data = $('#form_usulan_penelitian').serializeArray();
            let jenisLayanan = JSON.stringify($('#jenis_layanan').val());
            fileIndikator = {
                 'regulasi' : file_regulasi,
                 'sdm' : file_sdm ,
                 'anggaran' : file_anggaran ,
                 'bimtek' : file_bimtek,
                 'program' : file_program ,
                 'aktor' : file_aktor ,
                 'pelaksana' : file_pelaksana,
                 'jejaring' : file_jejaring,
                 'sosialisasi' : file_sosialisasi,
                 'pedoman' : file_pedoman ,
                 'informasi' : file_informasi ,
                 'penciptaan' : file_penciptaan,
                 'proses' : file_proses,
                 'penyelesaian' : file_penyelesaian,
                 'online' : file_online,
                 'replikasi' : file_replikasi,
                 'it' : file_it,
                 'kemanfaatan' : file_kemanfaatan,
                 'monitoring' : file_monitoring,
                 'kualitas' : file_kualitas,
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                timeout: 50000,
                url: '/layanan-incubator-store',
                async: true,
                data: {
                    datas:JSON.stringify(data),
                    filex : JSON.stringify(file_list), 
                    jenisLayanan:jenisLayanan,
                    indikator : JSON.stringify(fileIndikator),
                    nIndikator : indikator
                },
                success: function (res) {
                    console.log(res);
                    if (res.status === true){
                        $('#alert-info').html('<div class="alert alert-success"><p>'+res.message+'</p></div>');
                        $('#form_usulan_penelitian').trigger('reset')
                    }else{
                        $('#alert-info').html('<div class="alert alert-success"><p>'+res.message+'</p></div>');
                    }
                    $('#btn_submit_usulan').attr('disabled',false);
                    //res.status === true ? Swal.fire('Berhasil!', res.message, 'success');  : Swal.fire('Gagal!', res.message, 'danger');
                },
                error: function (res, textstatus) {
                    if (textstatus === "timeout") {
                        $('#alert-info').html('<div class="alert alert-danger"><p>'+res.message+'</p></div>');
                    } else {
                        $('#alert-info').html('<div class="alert alert-danger"><p>'+res.message+'</p></div>');
                    }
                }
            });
        });

        $('#jenis_layanan').change(function(){
            let jenisLayanan = ($('#jenis_layanan').val());
            let ide = 0;
            let rancang = 0;
            let validasi = 0;
            console.log(jenisLayanan);
            if(jenisLayanan.length == 0){
                $('#ide-gagasan').css('display','none') ;
                $('#profil').css('display','none') ;
                $('#validasi').css('display','none') ;
            }

            $.each(jenisLayanan, function (i,v) {
                rancang = 1;
                if (v.toString().toLowerCase().includes('ide gagasan')){
                    ide = 1;
                    rancang = 0;

                }
                    
                if (v.toString().toLowerCase().includes('validasi')){
                    validasi = 1;
                    indikator = 1

                }
                
            });
            ide == 1 ? $('#ide-gagasan').css('display','block') : $('#ide-gagasan').css('display','none');
            rancang == 1 ? $('#profil').css('display','inherit') : $('#profil').css('display','none');
            validasi == 1 ? $('#validasi').css('display','inherit')  : $('#validasi').css('display','none');
            ide = rancang = 0;

        });
    </script>
@endpush
