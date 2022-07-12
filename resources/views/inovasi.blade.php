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
                            <tbody>
                            @foreach($data as $item => $inv)
                                <tr >
                                    <td>{{ $item + 1 }}</td>
                                    <td><a href="/view-inovasi/{{ $inv['id'] }}" style="color: black">{{ $inv['nama'] }}</a> </td>
                                    <td>
                                        @php
                                        $pelaksana = [];
                                        @endphp
                                        @foreach($inv['pelaksana'] as $pl => $p)
                                            @php
                                            $pelaksana[] = $p['nama'];
                                            @endphp
                                        @endforeach
                                        {{ implode(', ',$pelaksana) }}
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
