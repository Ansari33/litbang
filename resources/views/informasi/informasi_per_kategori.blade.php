@extends('layout')
@section('title')
    Informasi Publik
@endsection
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="heading-block center mb-0">
                <h3>Daftar Informasi {{ $jenis }}</h3>
                {{--                <span>Tabel Daftar Hasil Kelitbangan</span>--}}
            </div>
        </div>

        <div class="container clearfix">
            <div class="row">
                <div class="col-lg-12"><div class="table-responsive">
                        <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th style="text-align: center">No.</th>
                                <th>Berkas</th>
                                <th style="text-align: center">Tahun</th>
                                <th>Link</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item => $inv)
                                <tr >
                                    <td style="width: 5%; text-align: center">{{ $item + 1 }}</td>
                                    <td > {{ $inv['nama'] }} </td>
                                    <td style="width: 17%; text-align: center"> {{ $inv['tahun'] }} </td>

                                    <td style="width: 8%; text-align: center">
                                        <a href="/files-attachment/informasi-publik/{{ $inv['dokumen'] }}" class="btn btn-outline-success btn-sm">
                                            <i class="icon-file-alt"></i>

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
