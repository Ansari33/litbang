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
                                <input type="hidden" value="{{ $data['id'] }}" name="id">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Jenis:</label>
                                        {{ Form::select('jenis',$jenis,$data['jenis'], ['title' => 'Pilih Jenis','class' => 'form-control selectpicker', 'id' => 'jenis_informasi', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Kategori:</label>
                                        <select class="form-control selectpicker" name="kategori" id="select_kategori">
                                            <option value="{{ $data['kategori'] }}" selected> {{ $data['kategori'] }} </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Berkas:</label>
                                        <input name="nama" class="form-control" value="{{ $data['nama'] }}" >
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tahun:</label>
                                        <input name="tahun" class="form-control" value="{{ $data['tahun'] }}">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Note: Jika Tidak ada perubahan file, bisa diabaikan!</label>
                                        <!--begin::Card-->
                                        <div class="card card-custom card-stretch">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">Upload File Laporan</h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="uppy" id="kt_uppy_1">
                                                    <div class="uppy-Root" dir="ltr">
                                                        <div class="uppy-Dashboard DashboardContainer uppy-Dashboard--animateOpenClose uppy-size--height-md uppy-Dashboard--isInnerWrapVisible" data-uppy-theme="light" data-uppy-num-acquirers="0" data-uppy-drag-drop-supported="true" aria-hidden="false" aria-label="File Uploader">
                                                            <div class="uppy-Dashboard-overlay" tabindex="-1"></div>
                                                            <div class="uppy-Dashboard-inner" style="width: 750px; height: 470px;">
                                                                <div class="uppy-Dashboard-innerWrap">
                                                                    <div class="uppy-Dashboard-dropFilesHereHint">Drop your files here</div>
                                                                    <div class="uppy-Dashboard-AddFiles">
                                                                        <input class="uppy-Dashboard-input" hidden="" aria-hidden="true" tabindex="-1" type="file" name="files[]" multiple="" accept="image/*,video/*">
                                                                        <input class="uppy-Dashboard-input" hidden="" aria-hidden="true" tabindex="-1" webkitdirectory="" type="file" name="files[]" multiple="" accept="image/*,video/*">
                                                                        <div class="uppy-Dashboard-AddFiles-title">Drop files here or <button type="button" class="uppy-u-reset uppy-Dashboard-browse UppyModalOpenerBtn" data-uppy-super-focusable="true">browse files</button>
                                                                        </div>
                                                                        {{--                                                                        <div class="uppy-Dashboard-AddFiles-info">--}}
                                                                        {{--                                                                            <div class="uppy-Dashboard-note">Images and video only, 2–3 files, up to 1 MB</div>--}}
                                                                        {{--                                                                        </div>--}}
                                                                    </div>
                                                                    <div class="uppy-Dashboard-progressindicators">
                                                                        <div class="uppy-StatusBar is-waiting" aria-hidden="true">
                                                                            <div class="uppy-StatusBar-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="width: 0%;">

                                                                            </div>
                                                                            <div class="uppy-StatusBar-actions"></div>
                                                                        </div>
                                                                        <div class="uppy uppy-Informer" aria-hidden="true"><p role="alert"> </p></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Card-->
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" id="btn_kelitbangan_edit_data" class="btn btn-primary mr-2">Save</button>
                                        <button type="button" class="btn btn-secondary mr-2" onclick="window.close()">Cancel</button>
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
    <script src="{{ asset('admin/plugins/custom/uppy/uppy.bundle.js') }}"></script>
    <script>
        "use strict";
        var file_list = [
            {'nama' : '{!! $data['dokumen'] !!}' },
        ];
        var file_rangkuman = {
            'nama' : '',
            'url' : '',
        };
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
                    height: 200,
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
                        maxFileSize: 10000000, // 1mb
                        maxNumberOfFiles: 1,
                        minNumberOfFiles: 1
                    }
                });

                uppyDashboard.use(Dashboard, options);
                uppyDashboard.use(Tus, { endpoint: 'https://master.tus.io/files/' });
                uppyDashboard.on('complete',function (f) {
                    console.log(f);
                    $.each(f.successful,function(i,e){
                        file_list.push({url :e.response.uploadURL,nama :e.name, tipe: e.data.type.split('/')[0]})
                    })
                    //file_list.push( f.successful.map((e, index) => { return {url :e.response.uploadURL,nama :e.name, tipe: e.data.type.split('/')[0]}  }) );

                });
                uppyDashboard.on('file-added', (file) => {
                    console.log('Added file', file)
                });
                uppyDashboard.on('file-removed', (file, reason) => {
                    console.log('Removed file', file)
                })
                var file_img = "{!! asset('infromasi-publik') !!}/" + '{{ $data['dokumen'] }}';
                var tag_img = `<img src="${file_img}" style="display: none;" id="{{ $data['dokumen'] }}`;
                $('#form_edit_kelitbangan').append(tag_img);

                var file_blob ;
                fetch(file_img)
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], '{{ $data['dokumen'] }}', blob)
                        console.log(file)
                        file_blob = file;
                        console.log('satu')
                    })
                    .then(
                        function () {
                            console.log('dua')
                            uppyDashboard.addFile({
                                name: '{{ $data['dokumen'] }}', // file name
                                type: '{!! $data['dokumen'] !!}'.toString().split('.')[-1], // file type
                                data: file_blob, // file blob
                                meta: {
                                    // optional, store the directory path of a file so Uppy can tell identical files in different directories apart.
                                    relativePath: "",
                                },
                                source: "{!! asset('informasi-publik') !!}/" + '{!! $data['dokumen'] !!} ', // optional, determines the source of the file, for example, Instagram.
                                isRemote: false, // optional, set to true if actual file is not in the browser, but on some remote server, for example,
                                // when using companion in combination with Instagram.
                            })
                        }

                    )

            }

            return {
                // public functions
                init: function() {
                    initUppy1();
                }
            };
        }();

        KTUtil.ready(function() {
            KTUppy.init();
        });
    </script>
    <script>
        $(function () {


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

                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    timeout: 50000,
                    url: '/informasi-publik-update',
                    async: true,
                    data: {
                        datas : JSON.stringify(data), filed : JSON.stringify(file_list)
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
            $('#jenis_informasi').change(function(){
                let jenis = $('#jenis_informasi').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    // type: "POST",
                    timeout: 50000,
                    url: '/kategori-informasi-publik-by-jenis/'+jenis,
                    async: true,

                    success: function (res) {
                        console.log(res)
                        $('#select_kategori').html('');
                        $.each(res,function (i,v) {
                            $('#select_kategori').append(
                                `<option value="${v.kategori}">${v.kategori}</option>`
                            );
                        });
                        $('#select_kategori').selectpicker('refresh');
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
    </script>

@endpush
