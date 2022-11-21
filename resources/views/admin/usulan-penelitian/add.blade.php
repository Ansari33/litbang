@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Penelitian - Tambah Data</span>
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
                                        <input name="nomor" type="text" class="form-control" placeholder="Nomor" value="{{ $nomor }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tanggal:</label>
                                        <div class="input-group date" id="usul_pen_add" data-target-input="nearest">
                                            <input name="tanggal" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#usul_pen_add" />
                                            <div class="input-group-append" data-target="#usul_pen_add" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Usulan:</label>
                                        <textarea name="usulan" class="form-control" cols="30" rows="3"></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Pengusul:</label>
                                        <input name="pengusul" type="text" class="form-control" placeholder="Pengusul" value="" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Latar Belakang:</label>
                                        <textarea name="latar_belakang" class="form-control" cols="30" rows="4"></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tujuan:</label>
                                        <textarea name="tujuan" class="form-control" cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Faktor Pendukung:</label>
                                        <textarea name="faktor_pendukung" class="form-control" cols="30" rows="4"></textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Faktor Penghambat:</label>
                                        <textarea name="faktor_penghambat" class="form-control" cols="30" rows="4"></textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Instansi:</label>
                                        {{ Form::select('instansi',$instansi,null, ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Email:</label>
                                        <input name="email" type="text" class="form-control" placeholder="Email Pengusul" value="" />
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Dokumen:</label>
                                        <!--begin::Card-->
                                        <div class="card card-custom card-stretch">
                                            <div class="card-header">
                                                <div class="card-title">
                                                    <h3 class="card-label">Upload File Attchment</h3>
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
                                    {{--                                    <div class="col-lg-6">--}}
                                    {{--                                        <div class="dropzone dropzone-default dropzone-primary dz-clickable" id="kt_dropzone_2">--}}
                                    {{--                                            <div class="dropzone-msg dz-message needsclick">--}}
                                    {{--                                                <h3 class="dropzone-msg-title">Drop files here or click to upload.</h3>--}}
                                    {{--                                                <span class="dropzone-msg-desc">Upload up to 10 files</span>--}}
                                    {{--                                            </div>--}}
                                    {{--                                        </div>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <div class="form-group row">

{{--                                    <div class="col-lg-6">--}}
{{--                                        <label>Status:</label>--}}
{{--                                        <input name="status" type="text" id="status" readonly class="form-control" placeholder="status" value="Proses" />--}}
{{--                                    </div>--}}
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" id="btn_usulan_penelitian_edit_data" class="btn btn-primary mr-2">Save</button>
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
    <script>

        $(function () {

            $('#usul_pen_add').datetimepicker({
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
            let  pelaksana = [];
            $('#btn_usulan_penelitian_edit_data').click(function(){
                let data = $('#form_edit_usulan_penelitian').serializeArray();
                console.log(data);
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
                        datas : JSON.stringify(data), pelaksana : JSON.stringify(pelaksana)
                    },
                    success: function (res) {
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

        function setStatus(status){
            $('#status').val(status);
            let data = $('#form_edit_usulan_penelitian').serializeArray();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                timeout: 50000,
                url: '/usulan-penelitian-update',
                async: true,
                data: {
                    datas : JSON.stringify(data)
                },
                success: function (res) {
                    if (res.status === true){
                        Swal.fire('Berhasil!', 'Status Berhasil Diupdate!', 'success').then(
                            function (e) {
                                // window.close();
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
        }
    </script>
@endpush
