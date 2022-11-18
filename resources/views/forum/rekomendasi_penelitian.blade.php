@extends('layout')
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="form-widget">

                <div class="form-result"></div>

                <div class="row shadow bg-light border">

                    <div class="col-lg-4 dark" style="background:  url('https://images.unsplash.com/photo-1450101499163-c8848c66ca85?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1000&q=80') center ; min-height: 400px;">
                        <h3 class="center mt-5">Form Permintaan</h3>
                        <div class="calories-wrap center w-100 px-2">
                            <span class="text-uppercase mb-0 ls2">Surat Rekomendasi</span>
                            <h2 id="calories-count" class="calories display-3 mb-2 heading-block border-bottom-0 fw-semibold font-body py-2"></h2>
                            <span class="text-uppercase h6 ls3">Penelitian</span>
                        </div>

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
                                        <label for="fitness-form-name">Judul penelitian:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="usulan"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-name">Nama :</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" name="pengusul" id="fitness-form-name" class="form-control required" value="" placeholder="Nama Pengusul">
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-name">Asal Institusi:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="Asal Institusi"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-name">Email:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="email" name="pengusul" id="fitness-form-name" class="form-control required" value="" placeholder="Email">

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-email">No. HP:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" name="hp" id="fitness-form-email" class="form-control required" value="" placeholder="Nomor Kontak">

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <div class="row">
                                    <div class="col-sm-2 col-form-label">
                                        <label for="fitness-form-email">File Pelengkap:</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <div id="drag-drop-area"></div>

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
        var file_list = [];
        var uppy = new Uppy.Core()
            .use(Uppy.Dashboard, {
                inline: true,
                target: '#drag-drop-area',
                height: 270,
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                timeout: 50000,
                url: '/usulan-penelitian-store',
                async: true,
                data: {
                    datas : JSON.stringify(data), filex:JSON.stringify(file_list)
                },
                success: function (res) {
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
                        // notice('Response Time Out', 'error');
                    } else {
                        $('#alert-info').html('<div class="alert alert-danger"><p>'+res.message+'</p></div>');
                       // notice(res.responseJSON.message, 'error');
                    }
                }
            });
        });
    </script>
@endpush
