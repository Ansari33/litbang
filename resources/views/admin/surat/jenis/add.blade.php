@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Jenis Surat - Tambah Data</span>
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
                                        <label>jenis Surat:</label>
                                        <input name="jenis" type="text" class="form-control" placeholder="" value="" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Kode Surat:</label>
                                        <input name="kode" type="text" class="form-control" placeholder="" value="" />
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Keterangan:</label>
                                        <textarea name="keterangan" class="form-control" cols="30" rows="5"></textarea>
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" id="btn_usulan_penelitian_edit_data" class="btn btn-primary mr-2">Save</button>
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
                    url: '/jenis-surat-store',
                    async: true,
                    data: {
                        datas : JSON.stringify(data)
                    },
                    success: function (res) {
                        console.log(res)
                        if (res.status === true){
                            Swal.fire('Berhasil!', 'Jenis Surat Berhasil Dibuat!', 'success').then(
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
    </script>
@endpush
