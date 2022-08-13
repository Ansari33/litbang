@extends('admin.layouts.app')
@section('title')
    Edit {{ $data['nama'] }}
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Survey - Edit Data</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="tab-content" id="page_content">
                    <form id="form_edit_survey">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <a href="https://docs.google.com/forms/u/0/" target="_blank" class="btn btn-primary">Buka Google Form</a>
                                        <a href="https://docs.google.com/forms/d/{{ $data['form_id'] }}/edit" target="_blank" class="btn btn-primary ml-2">Buka Form Ini</a>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Nama:</label>
                                        <input type="hidden" name="id" class="form-control" value="{{ $data['id'] }}">
                                        <input type="text" name="nama" class="form-control" value="{{ $data['nama'] }}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Link:</label>
                                        <input type="text" name="link" class="form-control" value="{{ $data['link'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>ID Form:</label>
                                        <input type="text" name="form_id" class="form-control" value="{{ $data['form_id'] }}">
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Keterangan:</label>
                                        <textarea class="form-control" name="keterangan">{{ $data['keterangan'] }}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" id="btn_survey_edit_data" class="btn btn-primary mr-2">Save</button>
                                        <button type="button" class="btn btn-secondary" onclick="window.close()">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('admin/plugins/custom/uppy/uppy.bundle.js') }}"></script>
    <script>
        "use strict";
        var file_list = [];
        var attch = {};
        // Class definition
        var KTUppy = function () {
            const Tus = Uppy.Tus;
            const ProgressBar = Uppy.ProgressBar;
            const StatusBar = Uppy.StatusBar;
            const FileInput = Uppy.FileInput;
            const Informer = Uppy.Informer;

            // to get uppy companions working, please refer to the official documentation here: https://uppy.io/docs/companion/
            const Dashboard = Uppy.Dashboard;
            const Dropbox = Uppy.Dropbox;
            const GoogleDrive = Uppy.GoogleDrive;
            const Instagram = Uppy.Instagram;
            const Webcam = Uppy.Webcam;


            // Private functions
            var initUppy1 = function(){
                var id = '#kt_uppy_1';

                var options = {
                    proudlyDisplayPoweredByUppy: false,
                    target: id,
                    inline: true,
                    replaceTargetContent: true,
                    showProgressDetails: true,
                    note: 'No filetype restrictions.',
                    height: 470,
                    remove : true,
                    metaFields: [
                        { id: 'name', name: 'Name', placeholder: 'file name' },
                        { id: 'caption', name: 'Caption', placeholder: 'describe what the image is about' }
                    ],
                    browserBackButtonClose: true
                }

                var uppyDashboard = Uppy.Core({
                    //autoProceed: true,
                    restrictions: {
                        maxFileSize: 1000000, // 1mb
                        maxNumberOfFiles: 5,
                        minNumberOfFiles: 1
                    }
                });

                uppyDashboard.use(Dashboard, options);
                uppyDashboard.use(Tus, { endpoint: 'https://master.tus.io/files/' });
                uppyDashboard.on('complete',function (f) {
                    console.log(f);
                    file_list = (f.successful.map((e, index) => { return {url :e.response.uploadURL,nama :e.meta.name}  }));
                    console.log(file_list)

                });
                uppyDashboard.on('file-added', (file) => {
                    console.log('Added file', file)
                })
                attch = [];
                $.each(attch, function (idx, val) {
                    console.log(val)
                    var file_img = "{!! asset('images/upload/') !!}/" + val.nama;
                    //var file_blob = file_img.blob();
                    var tag_img = `<img src="${file_img}" style="display: none;" id="${val.nama}">`;
                    $('#form_edit_kelitbangan').append(tag_img);

                    var file_blob ;
                    fetch(file_img)
                        .then(res => res.blob())
                        .then(blob => {
                            const file = new File([blob], val.nama, blob)
                            console.log(file)
                            file_blob = file;
                            console.log('satu')
                        })
                        .then(
                            function () {
                                console.log('dua')
                                uppyDashboard.addFile({
                                    name: val.nama, // file name
                                    type: 'image/jpeg', // file type
                                    data: file_blob, // file blob
                                    meta: {
                                        // optional, store the directory path of a file so Uppy can tell identical files in different directories apart.
                                        relativePath: "",
                                    },
                                    source: val.url, // optional, determines the source of the file, for example, Instagram.
                                    isRemote: false, // optional, set to true if actual file is not in the browser, but on some remote server, for example,
                                    // when using companion in combination with Instagram.
                                })
                            }

                        )

                    // console.log(file_blob)


                });

                // uppyDashboard.use(GoogleDrive, { target: Dashboard, companionUrl: 'https://companion.uppy.io' });
                // uppyDashboard.use(Dropbox, { target: Dashboard, companionUrl: 'https://companion.uppy.io' });
                // uppyDashboard.use(Instagram, { target: Dashboard, companionUrl: 'https://companion.uppy.io' });
                // uppyDashboard.use(Webcam, { target: Dashboard });
            }

            return {
                // public functions
                init: function() {
                    initUppy1();
                    // initUppy2();
                    // initUppy3();
                    // initUppy4();
                    // initUppy5();
                    // initUppy6();

                    // setTimeout(function() {
                    //     swal.fire({
                    //         "title": "Notice",
                    //         "html": "Uppy demos uses <b>https://master.tus.io/files/</b> URL for resumable upload examples and your uploaded files will be temporarely stored in <b>tus.io</b> servers.",
                    //         "type": "info",
                    //         "buttonsStyling": false,
                    //         "confirmButtonClass": "btn btn-primary",
                    //         "confirmButtonText": "Ok, I understand",
                    //         "onClose": function(e) {
                    //             console.log('on close event fired!');
                    //         }
                    //
                    //     });
                    // }, 2000);
                }
            };
        }();

        KTUtil.ready(function() {
            KTUppy.init();
        });

        // uppy.on('upload-success', (file, response) => {
        //     console.log(file)
        //     console.log(response)
        // })


    </script>

    <script>
        $(function () {

            $('#kt_timepicker_2, #kt_timepicker_2_modal').timepicker({
                minuteStep: 1,
                defaultTime: '',
                showSeconds: true,
                showMeridian: false,
                snapToStep: true
            });

            $('#tanggal_agenda_edit').datetimepicker({
                format: 'L',
                //     s
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
            $('.selectpicker').selectpicker();
        })
        $('#btn_survey_edit_data').click(function(){
            let data = $('#form_edit_survey').serializeArray();let pelaksana = [];

            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                timeout: 50000,
                url: '/survey-update',
                async: true,
                data: {
                    datas : JSON.stringify(data), filex : JSON.stringify(file_list)
                },
                success: function (res) {
                    console.log(res)
                    if (res.status === true){
                        Swal.fire('Berhasil!', res.message, 'success').then(
                            function (){
                                window.close();
                            }
                        );

                    }else{
                        Swal.fire('Gagal!', res.message, 'danger');
                    }
                    //res.status === true ? Swal.fire('Berhasil!', res.message, 'success');  : Swal.fire('Gagal!', res.message, 'danger');
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

    </script>
@endpush
