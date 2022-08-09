@extends('admin.layouts.app')
@section('title')
    List Agenda
@endsection
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap pl-0">
                <div class="col-md-12 pr-5 mr-2">
{{--                    <ul class="nav nav-light-primary nav-pills tabs-unlimited" id="menu_tab" role="tablist"></ul>--}}
                    <span class="nav-text bold ml-5">Agenda - Index</span>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid">
                <div class="tab-content" id="page_content">
                <div class="row">
                    <div class="col-lg-6">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">Pie Chart</h3>
                                </div>
                            </div>
                            <div class="card-body" style="position: relative;">
                                <div id="c_1e2r3t">

                                </div>
                            </div>
                        </div>
                        <!--end::Card-->
                    </div>
                    @foreach($dataForm as $form => $quis)
                    <div class="col-lg-6">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">Chart {{ $quis['pertanyaan'] }}</h3>
                                </div>
                            </div>
                            <div class="card-body" style="position: relative;">
                                <div id="c_{{ $quis['id'] }}">

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
        })


        function loadChart() {
            let dataForm = {!! json_encode( $dataForm) !!};
            $.each(dataForm, function (idx, val) {
                console.log(val.id)

            });

        }
        var KTApexChartsDemo = function () {
            // Private functions
            var _demo1 = function () {
                const apexChart = `#c_1e2r3t`;
                var options = {
                    series: [10, 20, 25, 30, 15],
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
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
                    colors: [primary, success, warning, danger, info]
                };

                var chart = new ApexCharts(document.querySelector(apexChart), options);
                chart.render();
            }

            return {
                // public functions
                init: function () {
                    _demo1();
                }
            };
        }();
    </script>
    @foreach($dataForm as $it => $vl)
    <script>
        var KTApexChartsDemo{{ $vl['id'] }} = function () {
            // Private functions
            var _demo{{ $vl['id'] }} = function () {
                const apexChart{{ $vl['id'] }} = `#c_{{ $vl['id'] }}`;
                var options{{ $vl['id'] }} = {
                    series: [10, 20, 25, 30, 15],
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels: ['Team A', 'Team B', 'Team C', 'Team D', 'Team E'],
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
                    colors: [primary, success, warning, danger, info]
                };

                var chart{{ $vl['id'] }} = new ApexCharts(document.querySelector(apexChart{{ $vl['id'] }}), options{{ $vl['id'] }});
                chart{{ $vl['id'] }}.render();
            }

            return {
                // public functions
                init: function () {
                    _demo{{ $vl['id'] }}();
                }
            };
        }();
    </script>
    @endforeach
@endpush
