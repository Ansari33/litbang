@extends('layout')
@section('title')
    Kelitbangan
@endsection
@section('content')
<div class="content-wrap">
    <div class="container clearfix">
        <div class="heading-block center mb-0">
            <h3>Hasil Kelitbangan</h3>
            {{--                <span>Tabel Daftar Hasil Kelitbangan</span>--}}
        </div>
    </div>
    <div class="container clearfix">
        <div class="table-responsive">
            <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Lingkup</th>
                    <th>Judul</th>
                    <th>Pelaksana</th>
                    <th>Tahun</th>
{{--                    <th>Salary</th>--}}
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
                @foreach($data as $its => $k)
                <tr >
                    <td>{{ $its + 1 }}</td>
                    <td>{{ $k['lingkup_data']['nama'] }}</td>
                    <td><a href="/view-kelitbangan/{{ $k['id'] }}" style="color: black;">{{ $k['judul'] }}</a></td>
                    <td>
                        @foreach($k['pelaksana'] as $pl => $p)
                            {{ $p['nama'] }},
                        @endforeach
                    </td>
                    <td>{{ \Carbon\Carbon::parse($k['tanggal'])->format('Y') }}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
@push('custom-scripts')
    <script>
     function bukaKelitbangan(id) {
         window.location.replace('/view-kelitbangan/'+id);
     }
    $(function() {
        console.log('buat Datatable')
        $('#datatable1').dataTable();
    });

    </script>
@endpush
