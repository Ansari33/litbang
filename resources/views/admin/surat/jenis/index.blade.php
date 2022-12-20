@extends('admin.layouts.app')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
{{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Jenis Surat - Index</span>
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

                                            <div class="col-md-8 ml-auto my-md-0">
                                                <div class="d-flex flex-row-reverse">
                                                    <div class="ml-2"><a href="/jenis-surat-tambah" class="btn btn-light-primary btn-sm"
                                                                         onclick="" target="_blank"><i
                                                                class="flaticon2-plus mr-n1"></i></a></div>
                                                    <div class="ml-2"><a href="javascript:;" class="btn btn-light-success btn-sm"
                                                                         onclick="" id="btn_reload_kelitbangan"><i
                                                                class="flaticon2-reload mr-n1"></i></a></div>

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

                                                <th>Jenis </th>
                                                <th>Kode </th>
                                                <th>Keterangan </th>
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
        var indexKelitbangan;
        var buttonCommon;
        $(function () {

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
            resetData();

        })

        $(`#tbl_kelitbangan thead tr`).first().clone().appendTo(`#tbl_kelitbangan thead`);
        $(`#tbl_kelitbangan thead tr:eq(1) th`).each(function (i) {
            let title = $(this).text();
            if (title == 'ID') {
                $(this).html('');
            } else {
                $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
            }
            $('input', this).on('keyup', function (e) {

                // if (e.which == 13) {
                indexKelitbangan.column(i).search(this.value).draw();
                //   console.log(this.value);
                // }
            });
        });


        function resetData(){
            indexKelitbangan = $(`#tbl_kelitbangan`).DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                "deferRender": true,
                dom: "Btplir",
                bDestroy:true,
                columns : [
                    {data : 'id'},
                    {data : 'jenis'},
                    {data : 'kode'},
                    {data : 'keterangan'},
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
                                for (var i = 0; i < tabelIndex.columns().count(); i++){
                                    if( $(tabelIndex.column(i).header()).text() == 'Tanggal' || $(tabelIndex.column(i).header()).text() == 'Tanggal Jurnal' || $(tabelIndex.column(i).header()).text() == 'Tanggal Pembayaran'){
                                        var test1 = $(tabelIndex.column(i).data()).toArray();
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
                    url: '/jenis-surat-list',
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

        function deleteJenisSurat(id) {
            Swal.fire({
                title: "Hapus Data?",
                text: "Data Akan Dihapus Jika Dilanjutkan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "lanjutkan!"
                }).then(function(result) {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        //type: "POST",
                        timeout: 50000,
                        url: '/jenis-surat-delete/'+id,
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
            });

        }
        $('#btn_reload_kelitbangan').on('click',function (e) {
            indexKelitbangan.ajax.reload();
        })

    </script>
@endpush
