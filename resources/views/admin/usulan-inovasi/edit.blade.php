@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Usulan Inovasi - Edit Data</span>
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
                                        <div class="input-group date" id="tanggal_uinov_edit" data-target-input="nearest">
                                            <input name="tanggal" id="tgl_uinov_edit" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#tanggal_uinov_edit" />
                                            <div class="input-group-append" data-target="#tanggal_uinov_edit" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Instansi:</label>
                                        {{ Form::select('instansi',$instansi,$data['instansi'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Usulan:</label>
                                        <textarea name="usulan" class="form-control" cols="30" rows="2">{{ $data['usulan'] }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Latar Belakang:</label>
                                        <textarea name="latar_belakang" class="form-control" cols="30" rows="4">{{ $data['latar_belakang'] }}</textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tujuan:</label>
                                        <textarea name="tujuan" class="form-control" cols="30" rows="4">{{ $data['tujuan'] }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Pengusul:</label>
                                        <input name="pengusul" type="text" class="form-control" placeholder="Pengusul" value="{{ $data['pengusul'] }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Nomor Kontak:</label>
                                        <input name="nomor_kontak" type="text" class="form-control" placeholder="Nomor Kontak" value="{{ $data['nomor_kontak'] }}" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Email:</label>
                                        <input name="email" type="text" class="form-control" placeholder="Email" value="{{ $data['email'] }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Status:</label>
                                        <input name="status"  id="status" type="text" readonly class="form-control" placeholder="Status" value="{{ $data['status'] }}" />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" id="btn_kelitbangan_edit_data" class="btn btn-primary mr-2">Save</button>
                                        <button type="button" class="btn btn-secondary mr-2" onclick="window.close()">Cancel</button>
                                        <button type="button" id="btn_status_1" class="btn btn-success mr-2" onclick="updateStatus('Terkonfirmasi')">Konfirmasi</button>
                                        <button type="button" id="btn_status_2" class="btn btn-danger mr-2" onclick="updateStatus('Ditolak')">Tolak</button>
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

            $('#tanggal_uinov_edit').datetimepicker({
                format: 'L',
            });

            $('#tgl_uinov_edit').val('{{ \Carbon\Carbon::parse( $data['tanggal'] )->format('m/d/Y') }}');

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
                    url: '/usulan-inovasi-update',
                    async: true,
                    data: {
                        datas : JSON.stringify(data), pelaksana : JSON.stringify(pelaksana)
                    },
                    success: function (res) {
                        console.log(res)
                        console.log(res)
                        if (res.status === true){
                            Swal.fire('Berhasil!', 'Usulan Berhasil Diupdate!', 'success').then(
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

        function updateStatus(status){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                timeout: 50000,
                url: '/usulan-inovasi-update-status/',
                data:{'status' : status,'id' : '{{ $data['id'] }}'},
                async: true,
                success: function (res) {
                    console.log(res)
                    res.status === true ? Swal.fire('Berhasil!', res.message, 'success') : Swal.fire('Gagal!', res.message, 'danger');
                    $('#status').val(status)
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
