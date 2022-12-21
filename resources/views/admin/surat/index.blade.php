@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
{{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Surat - Index</span>
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
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <a href="/surat-keluar-index" style="text-decoration: none !important;  color: inherit;">
                                            <!--begin::Card-->
                                            <div class="card card-custom card-stretch">
                                                <div class="card-header ribbon ribbon-top ribbon-ver">
                                                    <div class="ribbon-target bg-success" style="top: -2px; right: 20px;">
                                                        <i class="fas fa-envelope-square text-white"></i>
                                                    </div>
                                                    <h3 class="card-title">
                                                        Surat Keluar
                                                    </h3>
                                                </div>
                                                <div class="card-body">
                                                    Pengelolaan Surat Keluar
                                                </div>
                                            </div>
                                            <!--end::Card-->
                                            </a>
                                        </div>
                                        <div class="col-lg-4">
                                            <a href="/surat-masuk-index" style="text-decoration: none !important;  color: inherit;">
                                                <!--begin::Card-->
                                                <div class="card card-custom card-stretch">
                                                    <div class="card-header ribbon ribbon-top ribbon-ver">
                                                        <div class="ribbon-target bg-success" style="top: -2px; right: 20px;">
                                                            <i class="fas fa-envelope-open text-white"></i>
                                                        </div>
                                                        <h3 class="card-title">
                                                            Surat Masuk
                                                        </h3>
                                                    </div>
                                                    <div class="card-body">
                                                        Pengelolaan Surat Masuk
                                                    </div>
                                                </div>
                                                <!--end::Card-->
                                            </a>
                                        </div>
                                        <div class="col-lg-4">
                                            <!--begin::Card-->
                                            <a href="/jenis-surat-index" style="text-decoration: none !important;  color: inherit;">
                                                <div class="card card-custom card-stretch">
                                                <div class="card-header ribbon ribbon-top ribbon-ver">
                                                    <div class="ribbon-target bg-success" style="top: -2px; right: 20px;">
                                                        <i class="fas fa-envelope-o text-white"></i>
                                                    </div>
                                                    <div class="card-title">
                                                        <h3 class="card-label">Jenis Surat</h3>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    Pengelolaan Jenis Surat
                                                </div>
                                            </div>
                                            </a>
                                            <!--end::Card-->
                                        </div>
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
        var indexKelitbangan;
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
            //add_page('dashboard','dashboard','Dashboard');
            indexKelitbangan = $(`#tbl_kelitbangan`).DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                "deferRender": true,
                dom: "Btplir",
                columns : [
                    {data : 'id'},
                    {data : 'judul'},
                    {data : 'tanggal'},
                    // {data : 'deskripsi'},
                    // {data : 'tempat'},
                    {data : 'action'},
                ],
                // buttons: [
                //     $.extend( true, {}, buttonCommon, {
                //             extend: 'excelHtml5',
                //             SelectedOnly: true,
                //             customize: function(xlsx){
                //                 var table = xlsx.xl.worksheets['sheet1.xml'];
                //                 var kolom=['A','B','C','D','E','F','G','H','I','J'];
                //                 var j = 3;
                //                 for (var i = 0; i < tabelIndex.columns().count(); i++){
                //                     if( $(tabelIndex.column(i).header()).text() == 'Tanggal' || $(tabelIndex.column(i).header()).text() == 'Tanggal Jurnal' || $(tabelIndex.column(i).header()).text() == 'Tanggal Pembayaran'){
                //                         var test1 = $(tabelIndex.column(i).data()).toArray();
                //                         test1.forEach(test);
                //                         function test(item) {
                //                             var sementara = item.substr(90,101);
                //                             $(`c[r^= ${kolom[i]}${j}] t`, table).text(sementara);
                //                             j++;
                //
                //                         }
                //                     }
                //                 }
                //             }
                //         }
                //     ),
                //
                //     $.extend( true, {}, buttonCommon, {
                //         extend: 'pdfHtml5',
                //         orientation:'landscape',
                //         pageSize: 'LEGAL',
                //
                //     } ),
                //
                //     // 'excelHtml5',
                //     // 'pdfHtml5'
                // ],

                rowId: 'id',
                pageLength: 20,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/berita-list',
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
                    // {
                    //
                    //     targets: 3,
                    //     render: function (data) {
                    //
                    //         let parser = new DOMParser();
                    //         let doc = parser.parseFromString(data, 'text/html');
                    //         console.log(doc.body);
                    //         return data;
                    //
                    //         return `<label class="checkbox checkbox-single">
                    //             <input type="checkbox" value="" class="checkable" />
                    //             <span></span>
                    //           </label>`;
                    //     },
                    // },
                ],
            });
        })
        function deleteBerita(id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                //type: "POST",
                timeout: 50000,
                url: '/berita-delete/'+id,
                async: true,
                success: function (res) {
                    console.log(res)
                    res.status === true ? Swal.fire('Berhasil!', res.message, 'success') : Swal.fire('Gagal!', res.message, 'danger');
                    indexKelitbangan.ajax.reload();
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
            indexKelitbangan.ajax.reload();
        })
    </script>
@endpush
