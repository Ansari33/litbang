@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text">Inovasi - Edit Data</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="tab-content" id="page_content">
                    <form id="form_edit_inovasi">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                </div>
                                <div class="form-group row">
                                    <input name="id" type="hidden" class="form-control" placeholder="Nomor" value="{{ $data['id'] }}" />
                                    <div class="col-lg-6">
                                        <label>Nomor:</label>
                                        <input name="nomor" type="text" class="form-control" placeholder="Nomor" value="{{ $data['nomor'] }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tanggal:</label>
                                        <div class="input-group date" id="inovasi_edit_div" data-target-input="nearest">
                                            <input name="tanggal" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#tanggal_inovasi_edit" value="{{ \Carbon\Carbon::parse($data['tanggal'])->format('d-m-Y') }}"/>
                                            <div class="input-group-append" data-target="#tanggal_tanggal_edit" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Nama:</label>
                                        <input name="nama" type="text" class="form-control" placeholder="Nama" value="{{ $data['nama'] }}" />
                                        {{--                                        {{ Form::select('lingkup',[ 1 => 'Agama',2 => 'Lingkungan' ],null, ['title' => 'Pilih Pelanggan','class' => 'form-control selectpicker', 'id' => 'kelitngan_lingkup_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}--}}
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tujuan:</label>
                                        <textarea name="tujuan" class="form-control" cols="30" rows="2">{{ $data['tujuan'] }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Manfaat:</label>
                                        <textarea name="manfaat" class="form-control" cols="30" rows="4">{{ $data['manfaat'] }}</textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Hasil:</label>
                                        <textarea name="hasil" class="form-control" cols="30" rows="4">{{ $data['hasil'] }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Deskripsi:</label>
                                        <textarea name="deskripsi" class="form-control" cols="30" rows="4">{{ $data['deskripsi'] }}</textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Kelengkapan:</label>
                                        <textarea name="kelengkapan" class="form-control" cols="30" rows="4">{{ $data['kelengkapan'] }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Instansi:</label>
                                        {{ Form::select('instansi',$instansi,$data['instansi'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    {{--                                    <div class="col-lg-6">--}}
                                    {{--                                        <label>Judul:</label>--}}
                                    {{--                                        <textarea name="judul" class="form-control" cols="30" rows="2"></textarea>--}}
                                    {{--                                    </div>--}}
                                </div>
                                {{--                                --}}

                                {{--                                <div class="form-group row">--}}
                                {{--                                    <label class="col-lg-3 col-form-label text-lg-right">Upload Files:</label>--}}
                                {{--                                    <div id="drag-drop-area"></div>--}}
                                {{--                                </div>--}}
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
                                            <table class="table table-bordered" id="tbl_pelaksana_inovasi_add">
                                                <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama</th>
                                                    <th>Actions</th>
                                                </tr>
                                                </thead>
                                                @foreach($data['pelaksana'] as $item => $p)
                                                    <tr>
                                                        <th>{{ $item + 1 }}</th>
                                                        <th><input type="text" class="form-control" value="{{ $p['nama'] }}"></th>
                                                        <th><a href="javascript:;" id="delete"><i class="fa fa-trash"></i></a></th>
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
                                        <button type="button" id="btn_inovasi_edit_data" class="btn btn-primary mr-2">Save</button>
                                        <button type="button" class="btn btn-secondary" onclick="close_content_tab('pembelian_permintaan_pembelian','tambah_data')">Cancel</button>
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
        var uppy = new Uppy.Core()
        uppy.use(Uppy.DragDrop, { target: '#drag-drop-area' })
        uppy.use(Uppy.Tus, { endpoint: 'https://tusd.tusdemo.net/files/' })
    </script>

    <script>
        var tablePelaksana;
        $(function () {

            tablePelaksana = $(`#tbl_pelaksana_inovasi_add`).DataTable({
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
        $('#btn_inovasi_edit_data').click(function(){
            let data = $('#form_edit_inovasi').serializeArray();
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
                url: '/inovasi-update',
                async: true,
                data: {
                    datas : JSON.stringify(data), pelaksana : JSON.stringify(pelaksana)
                },
                success: function (res) {
                    console.log(res)
                    if (res.status === true){
                        Swal.fire('Berhasil!', res.message, 'success');
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
        $('#btn_add_pelaksana').click(function(){
            tablePelaksana.row.add([
                tablePelaksana.rows().count() + 1,
                '<input type="text" class="form-control">',
                '<a href="javascript:;" id="delete"> <i class="fa fa-trash"></i></a>'
            ]).draw(true);
        });
        $(`#tbl_pelaksana_inovasi_add`).on("click", "#delete", function () {
            $(`#tbl_pelaksana_inovasi_add`).DataTable().row($(this).parents('tr')).remove().draw(false);
        });
    </script>
@endpush
