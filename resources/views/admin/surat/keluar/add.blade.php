@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Surat Keluar - Tambah Data</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="tab-content" id="page_content">
                    <div class="card">
                        <form id="form_edit_usulan_penelitian">
                            <div class="card-body">
                                <div class="row mb-5">
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Nomor:</label>
                                        <input name="nomor_urut" type="text" class="form-control" placeholder="Nomor" value="{{ $nomor }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tanggal Surat:</label>
                                        <div class="input-group date" id="tanggal_surat_keluar_add" data-target-input="nearest">
                                            <input name="tanggal_surat" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#tanggal_surat_keluar_add" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}"/>
                                            <div class="input-group-append" data-target="#tanggal_surat_keluar_add" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Nomor Surat</label>
{{--                                        <input name="nomor_surat" type="text" id class="form-control" placeholder="Nomor" value="{{ $nomor }}" />--}}
                                        <div class="input-group mb-5">
                                            <span class="input-group-text" id="pre_nomor">000-</span>
                                            <input name="nomor_surat" value="" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Klasifikasi Surat:</label>
                                        <select name="klasifikasi" class="form-control selectpicker" id ="pelanggan_pengiriman_penjualan_add" title="Pilih Jenis Surat" data-size = "7" data-live-search = "true" data-toggle="ajax" onchange="setNomor(this)">
                                            @foreach($jenis_surat as $jst => $js)
                                                <option value="{{ $js['id'] }}" data-kode="{{ $js['kode'] }}"> {{ $js['jenis'] }}</option>
                                            @endforeach
                                        </select>
{{--                                        {{ Form::select('klasifikasi',$jenis_surat,null, ['title' => 'Pilih Jenis Surat','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}--}}
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Perihal:</label>
                                        <textarea name="isi_perihal_singkat" class="form-control" cols="30" rows="4"></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tujuan:</label>
                                        <textarea name="tujuan" class="form-control" cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <!--begin::Card-->
                                        <div class="card card-custom card-stretch">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">Pilih File Surat</h3>
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
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <div class="col-lg-12">--}}
{{--                                        <label>Detail Berita:</label>--}}
{{--                                        <div class="col-lg-12 col-md-12 col-sm-12">--}}
{{--                                            <textarea class="summernote" id="kt_summernote_1" name="surat_keluar"></textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" id="btn_usulan_penelitian_edit_data" class="btn btn-primary mr-2">Save</button>
{{--                                        <button type="button" id="btn_usulan_penelitian_edit_data" class="btn btn-primary mr-2">cetak</button>--}}
                                        <button type="button" class="btn btn-secondary mr-2" onclick="close_content_tab('pembelian_permintaan_pembelian','tambah_data')">Cancel</button>
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
    <script src="{{ asset('admin/plugins/custom/uppy/uppy.bundle.js') }}"></script>
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
                        //maxFileSize: 1000000, // 1mb
                        maxNumberOfFiles: 1,
                        minNumberOfFiles: 1
                    }
                });

                uppyDashboard.use(Dashboard, options);
                uppyDashboard.use(Tus, { endpoint: 'https://master.tus.io/files/' });
                uppyDashboard.on('complete',function (f) {
                    console.log(f);
                    file_list = (f.successful.map((e, index) => { return {url :e.response.uploadURL,nama :e.name}  }));


                });
                uppyDashboard.on('file-added', (file) => {
                    console.log('Added file', file)
                })

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
        var kode_surat = {name: 'kode', value: ''};
        $(function () {

            $('#tanggal_surat_keluar_add').datetimepicker({
                format: 'L',
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

            $('#btn_usulan_penelitian_edit_data').click(function(){
                let data = $('#form_edit_usulan_penelitian').serializeArray();
                data.push(kode_surat);
                console.log(data);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    timeout: 50000,
                    url: '/surat-keluar-store',
                    async: true,
                    data: {
                        datas : JSON.stringify(data), file_surat : JSON.stringify(file_list)
                    },
                    success: function (res) {
                        console.log(res)
                        if (res.status === true){
                            Swal.fire('Berhasil!', 'Surat Berhasil!', 'success').then(
                                function (e){
                                    window.close();
                                }
                            );
                        }else{
                            Swal.fire('Gagal!', 'Surat Gagal', 'danger');
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

        function setNomor(v){
            console.log($('option:selected', v).attr('data-kode'));
            let kode = $('option:selected', v).attr('data-kode');
            $('#pre_nomor').html(kode+'-');
            kode_surat.value = kode+'-';
        }

    </script>
@endpush
