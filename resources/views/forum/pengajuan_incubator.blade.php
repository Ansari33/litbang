@extends('layout')

@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="form-widget">

                <div class="form-result"></div>

                <div class="row shadow bg-light border">

                    <div class="col-lg-4 dark" style="background:  url('{{ asset("/images/services/main-bg.jpg") }}') center center / cover; min-height: 400px;">
{{--                        <h3 class="center mt-5">Fitness Quotes</h3>--}}
{{--                        <div class="calories-wrap center w-100 px-2">--}}
{{--                            <span class="text-uppercase mb-0 ls2">Loosing Fat</span>--}}
{{--                            <h2 id="calories-count" class="calories display-3 mb-2 heading-block border-bottom-0 fw-semibold font-body py-2"></h2>--}}
{{--                            <span class="text-uppercase h6 ls3">Estimated Calories</span>--}}
{{--                        </div>--}}
{{--                        <small class="center m-0 position-absolute" style="bottom: 12px;">Metric Units</small>--}}
                    </div>
                    <link href="https://releases.transloadit.com/uppy/v2.12.2/uppy.min.css" rel="stylesheet">
                    <div class="col-lg-8 p-5">
                        <form class="row mb-0" id="form_usulan_penelitian"   enctype="multipart/form-data">
                            <div class="form-process">
                                <div class="css3-spinner">
                                    <div class="css3-spinner-scaler"></div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-name">Nomor:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" name="nomor" id="fitness-form-name" class="form-control required" value="{{ $nomor }}" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-name">Nomor Surat:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" name="nomor_surat" id="fitness-form-name" class="form-control required"  >
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-name">File Surat:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <div id="drag-drop-area"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-name">Layanan:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        {{ Form::select('layanan[]',$layanan,null, ['title' => 'Pilih Layanan','class' => 'form-control multi-select2', 'id' => 'jenis_layanan', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax','multiple' => 'multiple']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-name">Nama Pengaju:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" name="pengguna_layanan" id="fitness-form-name" class="form-control required" value="" placeholder="Nama Pengusul">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-email">Nomor Kontak:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" name="nomor_pengaju" id="fitness-form-email" class="form-control required" value="" placeholder="No Kontak Pengusul">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-email">Email:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" name="email_pengaju" id="fitness-form-email" class="form-control required" value="" placeholder="Email Pengusul">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-name">Instansi:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        {{ Form::select('instansi',$instansi,null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-email">Rancang Bangun:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" rows="2" name="rancang_bangun"></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 d-flex justify-content-end align-items-center">
                                <div id="alert-info" ></div>
{{--                                <button type="button" id="calories-trigger" class="btn btn-secondary">Calculate</button>--}}
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
        var uppy = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area',
                height: 180,
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
        })
    </script>

    <script>
        $('#btn_submit_usulan').click(function(){
            $('#alert-info').html('Memproses...  '+'<div class="class="spinner-grow"></div>');
             let data = $('#form_usulan_penelitian').serializeArray();
            let jenisLayanan = JSON.stringify($('#jenis_layanan').val());

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
                    datas:JSON.stringify(data),filex : JSON.stringify(file_list), jenisLayanan:jenisLayanan,
                },
                success: function (res) {
                    console.log(res);
                    if (res.status === true){
                        $('#alert-info').html('<div class="alert alert-success"><p>'+res.message+'</p></div>');
                        $('#form_usulan_penelitian').trigger('reset')
                    }else{
                        $('#alert-info').html('<div class="alert alert-success"><p>'+res.message+'</p></div>');
                    }
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
    </script>
@endpush
