@extends('layout')
@section('title')
    Inovasi
@endsection
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="heading-block center mb-0">
                <h3>Hasil Inovasi</h3>
                {{--                <span>Tabel Daftar Hasil Kelitbangan</span>--}}
            </div>
        </div>

        <div class="container clearfix">
            <div class="row">
                <div class="col-lg-10"><div class="table-responsive">
                        <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Pelaksana</th>
                                <th>Tanggal</th>
                                <th>Kelengkapan</th>
                            </tr>
                            </thead>
                            {{--                <tfoot>--}}
                            {{--                <tr>--}}
                            {{--                    <th>Name</th>--}}
                            {{--                    <th>Position</th>--}}
                            {{--                    <th>Office</th>--}}
                            {{--                    <th>Age</th>--}}
                            {{--                    <th>Start date</th>--}}
                            {{--                    <th>Salary</th>--}}
                            {{--                </tr>--}}
                            {{--                </tfoot>--}}
                            <tbody>
                            @foreach($data as $item => $inv)
                                <tr ondblclick="bukaInovasi({{ $inv['id'] }})">
                                    <td>{{ $item + 1 }}</td>
                                    <td>{{ $inv['nama'] }}</td>
                                    <td>
                                        @foreach($inv['pelaksana'] as $pl => $p)
                                            {{ $p['nama'] }},
                                        @endforeach
                                    </td>

                                    <td>{{ $inv['tanggal'] }}</td>
                                    <td>{{ $inv['kelengkapan'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div></div>
                <div class="col-lg-2"></div>
            </div>



        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>
        function bukaInovasi(id) {
            window.location.replace('/view-inovasi/'+id);
        }
        $(function() {
            $('#datatable1').dataTable();
        });

    </script>
@endpush
