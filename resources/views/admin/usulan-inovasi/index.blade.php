@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
{{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Usulan Inovasi - Index</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="tab-content" id="page_content">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content" id="content_data_pembelian_permintaan_pembelian">
                                <div class="tab-pane fade show active" id="permintaan_pembelian_list" role="tabpanel"
                                     aria-labelledby="permintaan_pembelian_list">
                                    <div class="container-auto ml-7 mb-7">
                                        <div class="row">
{{--                                            <div class="row">--}}
{{--                                                <div class="col-md-0 my-2 my-md-0">--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButtonPermintaanPembelian"--}}
{{--                                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                            Pengaturan Kolom--}}
{{--                                                        </button>--}}
{{--                                                        <div class="dropdown-menu" id="columnSettingPermintaanPembelian" aria-labelledby="dropdownMenuButton">--}}
{{--                                                            <a class="dropdown-item" href="javascript:void(0)"><label class="checkbox">--}}
{{--                                                                    <input type="checkbox" id="CheckboxesPermintaanPembelian_Nomor" class="menuPermintaanPembelian"--}}
{{--                                                                           name="CheckboxesPermintaanPembelian_1" value="Nomor">--}}
{{--                                                                    <span></span> &nbsp; Nomor </label> </a>--}}
{{--                                                            <a class="dropdown-item" href="javascript:void(0)"><label class="checkbox">--}}
{{--                                                                    <input type="checkbox" id="CheckboxesPermintaanPembelian_Tanggal" class="menuPermintaanPembelian"--}}
{{--                                                                           name="CheckboxesPermintaanPembelian_2" value="Tanggal">--}}
{{--                                                                    <span></span> &nbsp; Tanggal</label></a>--}}
{{--                                                            <a class="dropdown-item" href="javascript:void(0)"><label class="checkbox">--}}
{{--                                                                    <input type="checkbox" id="CheckboxesPermintaanPembelian_Pemasok" class="menuPermintaanPembelian"--}}
{{--                                                                           name="CheckboxesPermintaanPembelian_3" value="Pemasok">--}}
{{--                                                                    <span></span> &nbsp; Pemasok</label></a>--}}
{{--                                                            <a class="dropdown-item" href="javascript:void(0)"><label class="checkbox">--}}
{{--                                                                    <input type="checkbox" id="CheckboxesPermintaanPembelian_Keterangan" class="menuPermintaanPembelian"--}}
{{--                                                                           name="CheckboxesPermintaanPembelian_4" value="Keterangan">--}}
{{--                                                                    <span></span> &nbsp; Keterangan</label></a>--}}

{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                                <div class="col-md-auto my-2 my-md-0">--}}
{{--                                                    <div class="dropdown">--}}
{{--                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownAksiButtonPermintaanPembelian" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
{{--                                                            Aksi--}}
{{--                                                        </button>--}}
{{--                                                        <div class="dropdown-menu" aria-labelledby="dropdownAksiButtonPermintaanPembelian">--}}
{{--                                                            <a class="dropdown-item" href="#" id="AksiButtonPermintaanPembelian_Edit">Edit</a>--}}
{{--                                                            <a class="dropdown-item" href="#" id="AksiButtonPermintaanPembelian_Hapus">Hapus</a>--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
                                            <div class="col-md-8 ml-auto my-md-0">
                                                <div class="d-flex flex-row-reverse">

                                                    <div class="ml-2"><a href="javascript:;" class="btn btn-light-success btn-sm"
                                                                         onclick="" id="btn_reload_kelitbangan"><i
                                                                class="flaticon2-reload mr-n1"></i></a></div>


                                                    <!-- Filter Tanggal -->

                                                    <div class="col-lg-3">
                                                        <a href="javascript:;" class="btn btn-icon btn-light-primary btn-sm"
                                                           id="search_permintaan_pembelian_date" onclick="filterTanggal()"><i class="flaticon-search"></i></a>&nbsp;
                                                        <a href="javascript:;" class="btn btn-icon btn-light-primary btn-sm"
                                                           id="reset_permintaan_pembelian_date" onclick="resetData()"><i
                                                                class="flaticon2-circular-arrow"></i></a>&nbsp;
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="input-group date" id="kelitbangan_awal" data-target-input="nearest">
                                                            <input name="tanggal" id="tgl_awal" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#kelitbangan_awal" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}"/>
                                                            <div class="input-group-append" data-target="#kelitbangan_awal" data-toggle="datetimepicker">
                                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-3">
                                                        <div class="input-group date" id="kelitbangan_akhir" data-target-input="nearest">
                                                            <input name="tanggal" id="tgl_akhir" onkeydown="return false" type="text" class="form-control datetimepicker-input" placeholder="Pilih Tanggal" data-target="#kelitbangan_akhir" value="{{ \Carbon\Carbon::now()->format('d-m-Y') }}"/>
                                                            <div class="input-group-append" data-target="#kelitbangan_akhir" data-toggle="datetimepicker">
                                                                <span class="input-group-text"><i class="ki ki-calendar"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Filter End -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-separate table-head-custom table-checkable"
                                               id="tbl_kelitbangan">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Usulan</th>
                                                <th>Pengusul</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        var indexUsulInovasi;
        var buttonCommon;
        $(function () {

            $('#kelitbangan_awal').datetimepicker({
                format: 'L',
            });
            $('#kelitbangan_akhir').datetimepicker({
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
            buttonCommon = {
                exportOptions: {
                    columns: getExportOptions(),
                    modifier: {
                        order: 'index',
                        page : 'all',
                        search: 'applied',
                    },
                    stripHtml:true,

                }
            };

            function getExportOptions(){
                return [function ( idx, data, node ) {
                    if($(node).text() === 'Actions' || $(node).hasClass('col-dt-hidden'))
                    { return false; }
                    return true;
                }
                ];
            }

            resetData();
        })

        function filterTanggal() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let awal = $('#tgl_akhir').val().split('/')[2] + '-' + $('#tgl_akhir').val().split('/')[0] + '-' + $('#tgl_akhir').val().split('/')[1];
            let akhir = $('#tgl_awal').val().split('/')[2] + '-' + $('#tgl_awal').val().split('/')[0] + '-' + $('#tgl_awal').val().split('/')[1];
            console.log(awal, akhir);

            indexUsulInovasi = $(`#tbl_kelitbangan`).DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                "deferRender": true,
                dom: "Btplir",
                bDestroy:true,
                columns : [
                    {data : 'id'},
                    {data : 'usulan'},
                    {data : 'pengusul'},
                    {data : 'tanggal'},
                    {data : 'status'},
                    {data : 'action'},
                ],
                buttons: [
                    $.extend( true, {}, buttonCommon, {
                            extend: 'excelHtml5',
                            SelectedOnly: true,
                            customize: function(xlsx){
                                var table = xlsx.xl.worksheets['sheet1.xml'];
                                var kolom=['A','B','C','D','E','F','G','H','I','J'];
                                var j = 3;
                                for (var i = 0; i < indexUsulInovasi.columns().count(); i++){
                                    if( $(indexUsulInovasi.column(i).header()).text() == 'Tanggal' || $(indexUsulInovasi.column(i).header()).text() == 'Tanggal Jurnal' || $(indexUsulInovasi.column(i).header()).text() == 'Tanggal Pembayaran'){
                                        var test1 = $(indexUsulInovasi.column(i).data()).toArray();
                                        test1.forEach(test);
                                        function test(item) {
                                            var sementara = item.substr(90,101);
                                            $(`c[r^= ${kolom[i]}${j}] t`, table).text(sementara);
                                            j++;

                                        }
                                    }
                                }
                            }
                        }
                    ),

                    $.extend( true, {}, buttonCommon, {
                        extend: 'pdfHtml5',
                        orientation:'landscape',
                        pageSize: 'LEGAL',

                    } ),

                    // 'excelHtml5',
                    // 'pdfHtml5'
                ],

                rowId: 'id',
                pageLength: 20,
                processing: true,
                serverSide: true,
                ajax: {
                    type:'POST',
                    url: '/usulan-inovasi-list-tanggal',
                    async: true,
                    data:{'tanggal_awal':awal,'tanggal_akhir':akhir},
                    error: function (res) {
                        $('.dataTables_processing').hide();
                        notice(res.responseJSON.message, 'error');
                    }
                },
                deferRender: true,
                select: !1,
                colReorder: !0,
                sorting: [
                    [1, "asc"]
                ],
                pagingType: "full_numbers",
                stateSave: !1,
                language: {
                    "zeroRecords": "Data tidak ditemukan...",
                    "processing": '<span class="text-danger">Mengambil Data....</span>'
                },
                lengthMenu: [
                    [20, 50, 100, 200,-1],
                    [20, 50, 100, 200,'All']
                ],
                //columns: params.content.columns,
                headerCallback: function (thead, data, start, end, display) {
                    thead.getElementsByTagName('th')[0].innerHTML = `
                            <label class="checkbox checkbox-single">
                                    <input type="checkbox" value="" class="group-checkable"/>
                                    <span></span>
                            </label>`;
                },
                columnDefs: [
                    {
                        "defaultContent": "-",
                        "targets": "_all"
                    },
                    {
                        targets: 0,
                        width: '30px',
                        className: 'dt-left',
                        orderable: false,
                        searchable: false,
                        render: function () {
                            return `<label class="checkbox checkbox-single">
                                <input type="checkbox" value="" class="checkable" />
                                <span></span>
                              </label>`;
                        },
                    },
                ],
            });
        }

        function resetData(){
            indexUsulInovasi = $(`#tbl_kelitbangan`).DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                "deferRender": true,
                dom: "Btplir",
                bDestroy:true,
                columns : [
                    {data : 'id'},
                    {data : 'usulan'},
                    {data : 'pengusul'},
                    {data : 'tanggal'},
                    {data : 'status'},
                    {data : 'action'},
                ],
                buttons: [
                    $.extend( true, {}, buttonCommon, {
                            extend: 'excelHtml5',
                            SelectedOnly: true,
                            customize: function(xlsx){
                                var table = xlsx.xl.worksheets['sheet1.xml'];
                                var kolom=['A','B','C','D','E','F','G','H','I','J'];
                                var j = 3;
                                for (var i = 0; i < indexUsulInovasi.columns().count(); i++){
                                    if( $(indexUsulInovasi.column(i).header()).text() == 'Tanggal' || $(indexUsulInovasi.column(i).header()).text() == 'Tanggal Jurnal' || $(indexUsulInovasi.column(i).header()).text() == 'Tanggal Pembayaran'){
                                        var test1 = $(indexUsulInovasi.column(i).data()).toArray();
                                        test1.forEach(test);
                                        function test(item) {
                                            var sementara = item.substr(90,101);
                                            $(`c[r^= ${kolom[i]}${j}] t`, table).text(sementara);
                                            j++;

                                        }
                                    }
                                }
                            }
                        }
                    ),

                    $.extend( true, {}, buttonCommon, {
                        extend: 'pdfHtml5',
                        orientation:'landscape',
                        pageSize: 'LEGAL',

                    } ),

                    // 'excelHtml5',
                    // 'pdfHtml5'
                ],

                rowId: 'id',
                pageLength: 20,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/usulan-inovasi-list',
                    async: true,
                    error: function (res) {
                        $('.dataTables_processing').hide();
                        notice(res.responseJSON.message, 'error');
                    }
                },
                deferRender: true,
                select: !1,
                colReorder: !0,
                sorting: [
                    [1, "asc"]
                ],
                pagingType: "full_numbers",
                stateSave: !1,
                language: {
                    "zeroRecords": "Data tidak ditemukan...",
                    "processing": '<span class="text-danger">Mengambil Data....</span>'
                },
                lengthMenu: [
                    [20, 50, 100, 200,-1],
                    [20, 50, 100, 200,'All']
                ],
                //columns: params.content.columns,
                headerCallback: function (thead, data, start, end, display) {
                    thead.getElementsByTagName('th')[0].innerHTML = `
                            <label class="checkbox checkbox-single">
                                    <input type="checkbox" value="" class="group-checkable"/>
                                    <span></span>
                            </label>`;
                },
                columnDefs: [
                    {
                        "defaultContent": "-",
                        "targets": "_all"
                    },
                    {
                        targets: 0,
                        width: '30px',
                        className: 'dt-left',
                        orderable: false,
                        searchable: false,
                        render: function () {
                            return `<label class="checkbox checkbox-single">
                                <input type="checkbox" value="" class="checkable" />
                                <span></span>
                              </label>`;
                        },
                    },
                ],
            });
        }
        function deleteUsulanInovasi(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                //type: "POST",
                timeout: 50000,
                url: '/usulan-inovasi-delete/'+id,
                async: true,
                success: function (res) {
                    console.log(res)

                    res.status === true ? Swal.fire('Berhasil!', res.message, 'success') : Swal.fire('Gagal!', res.message, 'danger');
                    indexUsulInovasi.ajax.reload();
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
        $('#btn_reload_kelitbangan').on('click',function (e) {
            indexUsulInovasi.ajax.reload();
        })
    </script>
@endpush
