@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text">Kelitbangan - Edit Data</span>
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
                                        <div class="input-group date" id="tanggal_pengiriman_pesanan_add" data-target-input="nearest">
                                            <input name="tanggal" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#tanggal_pengiriman_pesanan_add" value="{{ \Carbon\Carbon::parse( $data['tanggal'])->format('d-m-Y') }}"/>
                                            <div class="input-group-append" data-target="#tanggal_pengiriman_pesanan_add" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Lingkup:</label>
                                        {{ Form::select('lingkup',$instansi,$data['lingkup'], ['title' => 'Pilih Pelanggan','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Judul:</label>
                                        <textarea name="judul" class="form-control" cols="30" rows="2">{{ $data['judul'] }}</textarea>
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
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" id="btn_kelitbangan_edit_data" class="btn btn-primary mr-2">Save</button>
                                        <button type="button" class="btn btn-secondary" onclick="close_content_tab('pembelian_permintaan_pembelian','tambah_data')">Cancel</button>
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
                    url: '/kelitbangan-update',
                    async: true,
                    data: {
                        datas : JSON.stringify(data), pelaksana : JSON.stringify(pelaksana)
                    },
                    success: function (res) {
                        console.log(res)
                        console.log(res)
                        if (res.status === true){
                            Swal.fire('Berhasil!', res.message, 'success').then(
                                function (e) {
                                    window.close();
                                }
                            );
                            // setTimeout(function () {
                            //     window.close();
                            // },1000)

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
