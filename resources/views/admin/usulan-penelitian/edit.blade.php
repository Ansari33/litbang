@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Penelitian - Edit Data</span>
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
                                        <label>Usulan:</label>
                                        <textarea name="usulan" class="form-control" cols="30" rows="3">{{ $data['usulan'] }}</textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Pengusul:</label>
                                        <input name="pengusul" type="text" class="form-control" placeholder="Pengusul" value="{{ $data['pengusul'] }}" />
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
                                        <label>Faktor Pendukung:</label>
                                        <textarea name="faktor_pendukung" class="form-control" cols="30" rows="4">{{ $data['faktor_pendukung'] }}</textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Faktor Penghambat:</label>
                                        <textarea name="faktor_penghambat" class="form-control" cols="30" rows="4">{{ $data['faktor_penghambat'] }}</textarea>
                                    </div>
                                </div>
{{--                                <div class="form-group row">--}}
{{--                                    <div class="col-lg-6">--}}
{{--                                        <label>Pengusul:</label>--}}
{{--                                        <input name="nomor" type="text" class="form-control" placeholder="Pengusul" value="{{ $data['pengusul'] }}" />--}}
{{--                                    </div>--}}
{{--                                    <div class="col-lg-6">--}}
{{--                                        <label>Nomor Kontak:</label>--}}
{{--                                        <input name="nomor" type="text" class="form-control" placeholder="Nomor Kontak" value="{{ $data['nomor_kontak'] }}" />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Instansi:</label>
                                        {{ Form::select('instansi',$instansi,$data['instansi'], ['title' => 'Pilih Instansi','class' => 'form-control selectpicker', 'id' => 'pelanggan_pengiriman_penjualan_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Email Pengusul:</label>
                                        <input name="email" type="text" class="form-control" placeholder="Pengusul" value="{{ $data['email'] }}" />
                                    </div>
                                </div>
                                <div class="form-group row">

                                    <div class="col-lg-6">
                                        <label>Status:</label>
                                        <input name="status" type="text" id="status" readonly class="form-control" placeholder="Nomor Kontak" value="{{ $data['status'] }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label>File Pelengkap :</label>
                                        @foreach($data['attachment'] as $att => $at)
                                            <a href="/files-attachment/usulan-penelitian/{{ $at['nama'] }}"> <i class="fa fa-download"></i><span>{{ $at['nama'] }}</span></a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="button" id="btn_usulan_penelitian_edit_data" class="btn btn-primary mr-2">Save</button>
                                        <button type="button" class="btn btn-secondary mr-2" onclick="close_content_tab('pembelian_permintaan_pembelian','tambah_data')">Cancel</button>
                                        <button type="button" id="btn_status_1" class="btn btn-info mr-2" onclick="setStatus('Proses')">Set Konfirmasi</button>
                                        <button type="button" id="btn_status_2" class="btn btn-success mr-2" onclick="setStatus('Terlaksana')">Set Terlaksana</button>
                                        <button type="button" id="btn_status_3" class="btn btn-warning mr-2" onclick="setStatus('Tidak Terkasan')">Set Tidak TerLaksana</button>
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
                let pelaksana = [];
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
                        datas : JSON.stringify(data), pelaksana : JSON.stringify(pelaksana)
                    },
                    success: function (res) {
                        if (res.status === true){
                            Swal.fire('Berhasil!', res.message, 'success').then(
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
                url: '/usulan-penelitian-set-status',
                async: true,
                data: {
                    datas : { id : '{{ $data['id'] }}', status : status }
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
