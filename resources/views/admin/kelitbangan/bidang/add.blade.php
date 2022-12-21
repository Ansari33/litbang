@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Kelitbangan - Tambah Bidang</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="tab-content" id="page_content">
                    <form id="form_add_kelitbangan" enctype="multipart/form-data">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Nama Bidang:</label>
                                        <input name="nama" type="text" class="form-control" placeholder="Nama Bidang" value=""  />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Keterangan:</label>
                                        <textarea name="keterangan" class="form-control" cols="30" rows="2"></textarea>
                                    </div>
                                </div>

                            </div>


                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" id="btn_kelitbangan_add_data" class="btn btn-primary mr-2">Save</button>
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
        $(function () {
            $('#tanggal_kelitbangan_add').datetimepicker({
                format: 'L',
            });
            tablePelaksana = $(`#tbl_pelaksana_kelitbangan_add`).DataTable({
                columnDefs :[
                    { 'width' : '5%', 'target' : 0 },
                    { 'width' : '85%', 'target' : 1 },
                    { 'width' : '10%', 'target' : 2 },
                ]
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
        $('#btn_kelitbangan_add_data').click(function(){
            let data = $('#form_add_kelitbangan').serializeArray();let pelaksana = [];
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
                url: '/kelitbangan-store-bidang',
                async: true,
                data: {
                    datas : JSON.stringify(data),
                },
                success: function (res) {
                    console.log(res)
                    if (res.status === true){
                        Swal.fire('Berhasil!', res.message, 'success').then(
                            function (e) {
                                window.close();
                            }
                        );
                        //$('#form_add_kelitbangan').trigger('reset')
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
