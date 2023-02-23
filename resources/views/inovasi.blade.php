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
                <div class="col-lg-12"><div class="table-responsive">
                        <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Pelaksana</th>
                                <th>Tanggal</th>
                                <th style="text-align: center">Pedoman Teknis</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item => $inv)
                                <tr >
                                    <td style="width: 5%">{{ $item + 1 }}</td>
                                    <td style="width: 40%"><a href="/view-inovasi/{{ $inv['id'] }}" style="color: black">{{ $inv['nama'] }}</a> </td>
                                    <td style="width: 20%">
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

                                    <td style="width: 10%">{{ $inv['tanggal'] }}</td>
                                    <td style="width: 15%; text-align: center">
                                        <a href="{{ $inv['kelengkapan'] }}" target="_blank" class="btn btn-primary btn-sm">
                                            <i class="icon-external-link"></i>

                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div></div>

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
