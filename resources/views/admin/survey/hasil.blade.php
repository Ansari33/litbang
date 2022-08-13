@extends('admin.layouts.app')
@section('title')
    Hasil SUrvey
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
{{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Hasil Survey</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="tab-content" id="page_content">

                <div class="row">
{{--                    <div class="col-lg-6">--}}
{{--                        <!--begin::Card-->--}}
{{--                        <div class="card card-custom gutter-b">--}}
{{--                            <div class="card-header">--}}
{{--                                <div class="card-title">--}}
{{--                                    <h3 class="card-label">Pie Chart</h3>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-body" style="position: relative;">--}}
{{--                                <div id="c_1e2r3t">--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <!--end::Card-->--}}
{{--                    </div>--}}
                    @foreach($dataForm as $form => $quis)
                    <div class="col-lg-6">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">Hasil {{ $quis['pertanyaan'] }}</h3>
                                </div>
                            </div>
                            <div class="card-body" style="position: relative;">
                                <div id="c_{{ $quis['id'] }}">
                                    @if(count($quis['opsi']) < 1)
                                        <ul>
                                        @foreach($quis['jawaban'] as $qz => $qs)
                                            <li>{{ $qs }}</li>
                                        @endforeach
                                        </ul>

                                    @endif

                                </div>
                            </div>
                         </div>
                        <!--end::Card-->
                    </div>
                    @endforeach
                </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('admin/js/pages/features/charts/apexcharts.js') }}"></script>
    <script>
        var indexKelitbangan;

        const c6 = '#699399';
        const c7 = '#1BC5E5';
        const c8 = '#895099';
        const c9 = '#FFA899';
        const c10 = '#F64E99';

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
            loadChart();
            indexKelitbangan = $(`#tbl_kelitbangan`).DataTable({
                orderCellsTop: true,
                fixedHeader: true,
                "deferRender": true,
                dom: "Btplir",
                columns : [
                    {data : 'id'},
                    {data : 'nama'},
                    // {data : 'form_id'},
                    // {data : 'link'},
                    {data : 'keterangan'},
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
                    url: '/survey-list',
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
            $('#btn_reload_kelitbangan').on('click',function (e) {
                indexKelitbangan.ajax.reload();
            })
        })


        function loadChart() {
            let dataForm = {!! json_encode( $dataForm) !!};
            $.each(dataForm, function (idx, val) {
                console.log(val.id)

            });

        }
        var KTApexChartsDemo = function () {
            // Private functions
            // var _demo1 = function () {
            //     const apexChart = `#c_1e2r3t`;
            //     var options = {
            //         series: [10, 20, 25, 30, 15],
            //         chart: {
            //             width: 380,
            //             type: 'pie',
            //         },
            //         labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
            //         responsive: [{
            //             breakpoint: 480,
            //             options: {
            //                 chart: {
            //                     width: 200
            //                 },
            //                 legend: {
            //                     position: 'bottom'
            //                 }
            //             }
            //         }],
            //         colors: [primary, success, warning, danger, info]
            //     };
            //
            //     var chart = new ApexCharts(document.querySelector(apexChart), options);
            //     chart.render();
            // }

            @foreach($dataForm as $it => $vl)
                @if( count($vl['opsi']) > 0)
                    var _{{ $vl['id'] }} = function () {

                        const apexChart = `#c_{{ $vl['id'] }}`;
                        var options = {
                            series:{!! json_encode($vl['series']) !!},
                            chart: {
                                width: 380,
                                type: 'pie',
                            },
                            labels: {!! json_encode($vl['opsi']) !!},
                            responsive: [{
                                breakpoint: 480,
                                options: {
                                    chart: {
                                        width: 200
                                    },
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }],
                            colors: [primary, success, warning, danger, info,c6,c7,c8,c9,c10]
                        };

                        var chart = new ApexCharts(document.querySelector(apexChart), options);
                        chart.render();
                    }
                @endif
            @endforeach


            return {
                // public functions
                init: function () {
                    // _demo1();
                    @foreach($dataForm as $it => $vl)
                        @if( count($vl['opsi']) > 0)
                            _{{ $vl['id'] }}();
                        @endif
                    @endforeach
                }
            };
        }();
    </script>

@endpush
