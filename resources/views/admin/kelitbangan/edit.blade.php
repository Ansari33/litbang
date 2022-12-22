@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Kelitbangan - Edit Data</span>
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
                                        <div class="input-group date" id="kelitbangan_add" data-target-input="nearest">
                                            <input name="tanggal" id="tgl_kel_edit" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#kelitbangan_add"/>
                                            <div class="input-group-append" data-target="#kelitbangan_add" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Bidang:</label>
                                        {{ Form::select('lingkup',$bidang2,$data['lingkup'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Judul:</label>
                                        <textarea name="judul" class="form-control" cols="30" rows="2">{{ $data['judul'] }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Tipe:</label>
                                        {{ Form::select('tipe',['Fisik' => 'Fisik','Non Fisik' => 'Non Fisik'],$data['tipe'], ['title' => 'Pilih Tipe','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Abstrak:</label>
                                        <textarea name="abstrak" class="form-control" cols="30" rows="4">{{ $data['abstrak'] }}</textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tindak Lanjut:</label>
                                        <textarea name="tindak_lanjut" class="form-control" cols="30" rows="4">{{ $data['tindak_lanjut'] }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <div class="mb-7">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 my-2 my-md-0 mr-0">
                                                    <label>Pelaksana:</label>
                                                </div>
                                                <div class="col-md-8 my-2 my-md-0">
                                                    <div class="d-flex flex-row-reverse">
                                                        <div class="ml-2"><a href="javascript:;" id="btn_add_pelaksana" class="btn btn-light-primary btn-sm"><i class="flaticon2-plus mr-n1"></i></a></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="tbl_pelaksana_kelitbangan_add">
                                                <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama</th>
                                                    <th>Actions</th>
                                                </tr>

                                                </thead>
                                                @foreach($data['pelaksana'] as $item => $p)
                                                    <tr>
                                                        <td>{{ $item + 1 }}</td>
                                                        <td> <input class="form-control" value="{{ $p['nama'] }}"> </td>
                                                        <td><a href="javascript:;" id="delete"><i class="fa fa-trash"></i></a></td>
                                                    </tr>
                                                @endforeach
                                            </table>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
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
                                                                        <div class="uppy-Dashboard-AddFiles-info">
                                                                            <div class="uppy-Dashboard-note">Images and video only, 2–3 files, up to 1 MB</div>
                                                                        </div>
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
                                    <div class="col-lg-6">
                                        <!--begin::Card-->
                                        <div class="card card-custom card-stretch">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">Upload File Rangkuman</h3>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="uppy" id="kt_uppy_2">
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
                                                                        <div class="uppy-Dashboard-AddFiles-info">
                                                                            <div class="uppy-Dashboard-note">Images and video only, 2–3 files, up to 1 MB</div>
                                                                        </div>
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
                                    <div class="col-lg-6">
                                        <button type="button" id="btn_kelitbangan_edit_data" class="btn btn-primary mr-2">Save</button>
                                        <button type="button" class="btn btn-secondary" onclick="window.close()">Cancel</button>
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
        var file_list = [];
        var file_rangkuman = {
            'nama' : '',
            'url' : '',
        };
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
                    $.each(f.successful,function(i,e){
                        file_list.push({url :e.response.uploadURL,nama :e.name, tipe: e.data.type.split('/')[0]})
                    })

                });
                uppyDashboard.on('file-added', (file) => {
                    console.log('Added file', file)
                })
                attch = {!! json_encode($data['attachment']) !!};
                $.each(attch, function (idx, val) {
                    console.log(val)
                    var file_img = "{!! asset('files-attachment/laporan-kelitbangan/') !!}/" + val.nama;
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
                                    type: val.tipe, // file type
                                    data: file_blob, // file blob
                                    meta: {
                                        // optional, store the directory path of a file so Uppy can tell identical files in different directories apart.
                                        relativePath: "",
                                    },
                                    source: "{!! asset('files-attachment/laporan-kelitbangan/') !!}"+val.nama, // optional, determines the source of the file, for example, Instagram.
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

            var initUppy2 = function(){
                var id = '#kt_uppy_2';

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
                        maxNumberOfFiles: 1,
                        minNumberOfFiles: 1
                    }
                });

                uppyDashboard.use(Dashboard, options);
                uppyDashboard.use(Tus, { endpoint: 'https://master.tus.io/files/' });
                uppyDashboard.on('complete',function (f) {
                    console.log(f);
                    $.each(f.successful,function(i,e){
                        file_rangkuman = { url :e.response.uploadURL,nama :e.name, tipe: e.data.type.split('/')[0] };
                    })

                });
                uppyDashboard.on('file-added', (file) => {
                    console.log('Added file', file)
                })



                    var file_img = "{!! asset('rangkuman-kelitbangan') !!}/" + '{{ $data['rangkuman'] }}';
                    var tag_img = `<img src="${file_img}" style="display: none;" id="{{ $data['rangkuman'] }}`;
                    $('#form_edit_kelitbangan').append(tag_img);

                    var file_blob ;
                    fetch(file_img)
                    .then(res => res.blob())
                    .then(blob => {
                        const file = new File([blob], '{{ $data['rangkuman'] }}', blob)
                        console.log(file)
                        file_blob = file;
                        console.log('satu')
                    })
                    .then(
                        function () {
                            console.log('dua')
                            uppyDashboard.addFile({
                                name: '{{ $data['rangkuman'] }}', // file name
                                type: '{!! $data['rangkuman'] !!}'.toString().split('.')[-1], // file type
                                data: file_blob, // file blob
                                meta: {
                                    // optional, store the directory path of a file so Uppy can tell identical files in different directories apart.
                                    relativePath: "",
                                },
                                source: "{!! asset('rangkuman-kelitbangan') !!}/" + '{!! $data['rangkuman'] !!} ', // optional, determines the source of the file, for example, Instagram.
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
                    initUppy2();

                }
            };
        }();

        KTUtil.ready(function() {
            KTUppy.init();
        });

    </script>
    <script>

        $(function () {

            $('#kelitbangan_add').datetimepicker({
                format: 'L',
                //     s
            });
            $('#tgl_kel_edit').val('{{ \Carbon\Carbon::parse( $data['tanggal'] )->format('m/d/Y') }}');

            tablePelaksana = $(`#tbl_pelaksana_kelitbangan_add`).DataTable({
                columnDefs :[
                    { 'width' : '5%', 'target' : 0 },
                    { 'width' : '85%', 'target' : 1 },
                    { 'width' : '10%', 'target' : 2 },
                ]
            });
            attch = {!! json_encode($data['attachment']) !!};
            console.log(attch)


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
                    url: '/kelitbangan-update',
                    async: true,
                    data: {
                        datas : JSON.stringify(data),
                        pelaksana : JSON.stringify(pelaksana),
                        filex :JSON.stringify(file_list),
                        rangkuman :JSON.stringify(file_rangkuman)
                    },
                    success: function (res) {
                        console.log(res)
                        if (res.status === true){
                            Swal.fire('Berhasil!', res.message, 'success').then(
                                function (e) {
                                    window.close();
                                }
                            );

                        }else{
                            Swal.fire('Gagal!', res.message, 'danger');
                        }
                        //res.status === true ? Swal.fire('Berhasil!', res.message, 'success') : Swal.fire('Gagal!', res.message, 'danger');

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
            $('#btn_add_pelaksana').click(function(){
                tablePelaksana.row.add([
                    tablePelaksana.rows().count() + 1,
                    '<input type="text" class="form-control">',
                    '<a href="javascript:;" id="delete"> <i class="fa fa-trash"></i></a>'
                ]).draw(true);
            });
            $(`#tbl_pelaksana_kelitbangan_add`).on("click", "#delete", function () {
                $(`#tbl_pelaksana_kelitbangan_add`).DataTable().row($(this).parents('tr')).remove().draw(false);
            });
            //add_page('dashboard','dashboard','Dashboard');
        })
    </script>
@endpush
