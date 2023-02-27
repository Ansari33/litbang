@extends('admin.layouts.app')
@section('title')
    Edit Agenda {{ $data['nama'] }}
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
                    {{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Agenda - Edit Data</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="tab-content" id="page_content">
                    <form id="form_edit_agenda">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-5">
                                </div>
                                <div class="form-group row">
                                    <input type="hidden" value="{{ $data['id'] }}" name="id">
                                    <div class="col-lg-6">
                                        <label>Nama Agenda:</label>
                                        <textarea name="nama" class="form-control" cols="30" rows="2"> {{ $data['nama'] }}</textarea>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tanggal:</label>
                                        <div class="input-group date" id="tanggal_agenda_edit" data-target-input="nearest">
                                            <input name="tanggal" id="tgl_edit" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#tanggal_agenda_edit"/>
                                            <div class="input-group-append" data-target="#tanggal_agenda_edit" data-toggle="datetimepicker">
                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label class="">Waktu:</label>
                                        <div class="input-group timepicker">
                                            <input class="form-control" name="waktu" id="kt_timepicker_2" readonly placeholder="Select time" type="text" value="{{ $data['waktu'] }}"/>
                                            <div class="input-group-append">
                                               <span class="input-group-text">
                                                <i class="la la-clock-o"></i>
                                               </span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-6">
                                        <label>Tempat:</label>
                                        <textarea name="tempat" class="form-control" cols="30" rows="3">{{ $data['tempat'] }}</textarea>
                                    </div>
                                </div>

                            </div>

                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="button" id="btn_agenda_edit_data" class="btn btn-primary mr-2">Save</button>
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

            $('#kt_timepicker_2, #kt_timepicker_2_modal').timepicker({
                minuteStep: 1,
                defaultTime: '',
                showSeconds: true,
                showMeridian: false,
                snapToStep: true
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
        $('#btn_agenda_edit_data').click(function(){
            let data = $('#form_edit_agenda').serializeArray();let pelaksana = [];

            console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                timeout: 50000,
                url: '/agenda-update',
                async: true,
                data: {
                    datas : JSON.stringify(data)
                },
                success: function (res) {
                    console.log(res)
                    if (res.status === true){
                        Swal.fire('Berhasil!', res.message, 'success');
                        $('#form_edit_agenda').trigger('reset')
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
