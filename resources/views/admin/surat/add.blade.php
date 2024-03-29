@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Berita - Tambah Data</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="tab-content" id="page_content">
                    <form id="form_add_berita">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Judul:</label>
                                        <textarea name="judul" class="form-control" cols="30" rows="2"></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tanggal:</label>
                                        <div class="input-group date" id="tanggal_berita_add" data-target-input="nearest">
                                            <input name="tanggal" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#tanggal_berita_add" value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}"/>
                                            <div class="input-group-append" data-target="#tanggal_berita_add" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-12">
                                        <label>Detail Berita:</label>
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <textarea class="summernote" id="kt_summernote_1" name="deskripsi"></textarea>
                                        </div>
                                    </div>
{{--                                    <div class="col-lg-6">--}}
{{--                                        <label>Attachment:</label>--}}
{{--                                        <div class="uppy" id="kt_uppy_1">--}}
{{--                                            <div class="uppy-Root" dir="ltr">--}}
{{--                                                <div class="uppy-Dashboard DashboardContainer uppy-Dashboard--animateOpenClose uppy-size--height-md uppy-Dashboard--isInnerWrapVisible" data-uppy-theme="light" data-uppy-num-acquirers="0" data-uppy-drag-drop-supported="true" aria-hidden="false" aria-label="File Uploader">--}}
{{--                                                    <div class="uppy-Dashboard-overlay" tabindex="-1"></div>--}}
{{--                                                    <div class="uppy-Dashboard-inner" style="width: 750px; height: 470px;">--}}
{{--                                                        <div class="uppy-Dashboard-innerWrap">--}}
{{--                                                            <div class="uppy-Dashboard-dropFilesHereHint">Drop your files here</div>--}}
{{--                                                            <div class="uppy-Dashboard-AddFiles">--}}
{{--                                                                <input class="uppy-Dashboard-input" hidden="" aria-hidden="true" tabindex="-1" type="file" name="files[]" multiple="" accept="image/*,video/*">--}}
{{--                                                                <input class="uppy-Dashboard-input" hidden="" aria-hidden="true" tabindex="-1" webkitdirectory="" type="file" name="files[]" multiple="" accept="image/*,video/*">--}}
{{--                                                                <div class="uppy-Dashboard-AddFiles-title">Drop files here or <button type="button" class="uppy-u-reset uppy-Dashboard-browse UppyModalOpenerBtn" data-uppy-super-focusable="true">browse files</button>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="uppy-Dashboard-AddFiles-info">--}}
{{--                                                                    <div class="uppy-Dashboard-note">Images and video only, 2–3 files, up to 1 MB</div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                            <div class="uppy-Dashboard-progressindicators">--}}
{{--                                                                <div class="uppy-StatusBar is-waiting" aria-hidden="true">--}}
{{--                                                                    <div class="uppy-StatusBar-progress" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0" style="width: 0%;">--}}

{{--                                                                    </div>--}}
{{--                                                                    <div class="uppy-StatusBar-actions"></div>--}}
{{--                                                                </div>--}}
{{--                                                                <div class="uppy uppy-Informer" aria-hidden="true"><p role="alert"> </p></div>--}}
{{--                                                            </div>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <div class="col-lg-12">--}}
{{--                                        <label>Deskripsi Simple:</label>--}}
{{--                                        <textarea name="deskripsi" class="form-control" cols="30" rows="5"></textarea>--}}

{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" id="btn_berita_add_data" class="btn btn-primary mr-2">Save</button>
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
    <script src="{{ asset('admin/js/pages/crud/forms/editors/summernote.js') }}"></script>
    <script>
        // Class definition

        var KTSummernoteDemo = function () {
            // Private functions
            var demos = function () {
                $('.summernote').summernote({
                    height: 390
                });
            }

            return {
                // public functions
                init: function() {
                    demos();
                }
            };
        }();

        // Initialization
        jQuery(document).ready(function() {
            KTSummernoteDemo.init();
        });
    </script>
    <script>
        "use strict";
        var file_list = [];
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
                    file_list = (f.successful.map((e, index) => { return {url :e.response.uploadURL,nama :e.name}  }));


                });
                uppyDashboard.on('file-added', (file) => {
                })

                // uppyDashboard.use(GoogleDrive, { target: Dashboard, companionUrl: 'https://companion.uppy.io' });
                // uppyDashboard.use(Dropbox, { target: Dashboard, companionUrl: 'https://companion.uppy.io' });
                // uppyDashboard.use(Instagram, { target: Dashboard, companionUrl: 'https://companion.uppy.io' });
                // uppyDashboard.use(Webcam, { target: Dashboard });
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

            $('#kt_timepicker_2, #kt_timepicker_2_modal').timepicker({
                minuteStep: 1,
                defaultTime: '',
                showSeconds: true,
                showMeridian: false,
                snapToStep: true
            });

            $('#tanggal_berita_add').datetimepicker({
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
        $('#btn_berita_add_data').click(function(){
            let data = $('#form_add_berita').serializeArray();let pelaksana = [];
            // data.push({name : 'detail', value : $(`kt_summernote_1`).summernote('code')});
            // let htmlx = $('#summernote').summernote('code');
            // $('#ntmm').html(htmlx)
            // console.log(htmlx);
            // console.log($('#kt_summernote_1').text());

            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                timeout: 50000,
                url: '/berita-store',
                async: true,
                data: {
                    datas : JSON.stringify(data), pelaksana : JSON.stringify(pelaksana), filex : JSON.stringify(file_list),
                },
                success: function (res) {
                    console.log(res)
                    if (res.status === true){
                        Swal.fire('Berhasil!', res.message, 'success');
                        $('#form_add_berita').trigger('reset')
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
