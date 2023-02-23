@extends('layout')
@section('title')
    Informasi Publik
@endsection
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="heading-block center mb-0">
                <h3>Daftar {{ $jenis }}</h3>
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
                                <th>Kategori</th>
                                <th>Link</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item => $inv)
                                <tr >
                                    <td style="width: 5%">{{ $item + 1 }}</td>
                                    <td > {{ $inv['kategori'] }} </td>

                                    <td style="width: 10%; text-align: center">
                                        <a href="/informasi-by-kategori/{{ $inv['kategori'] }}" class="btn btn-primary btn-sm">
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
