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
                    <th>Bidang</th>
                    <th>Judul</th>
                    <th>Pelaksana</th>
                    <th>Tahun</th>
                    <th>Dokumen</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $its => $k)
                <tr >
                    <td style="width: 5%">{{ $its + 1 }}</td>
                    <td style="width: 10%">{{ $k['lingkup_data'] == null ? 'Tidak Ditemukan' : $k['lingkup_data']['nama'] }}</td>
                    <td style="width: 35%"><a href="/view-kelitbangan/{{ $k['id'] }}" style="color: black;">{{ $k['judul'] }}</a></td>
                    <td style="width: 25%">
                        @php
                         $pelaksana = [];
                        @endphp
                        @foreach($k['pelaksana'] as $pl => $p)
                            @php
                                $pelaksana [] = $p['nama'];
                            @endphp
                        @endforeach
                        {{ implode(', ',$pelaksana) }}
                    </td>
                    <td style="width: 5%">{{ \Carbon\Carbon::parse($k['tanggal'])->format('Y') }}</td>
                    <td style="width: 20%">
                        @foreach($k['attachment'] as $att => $at)
                            @if($at['url'] !== null)
                        <a href="{{ url('/files-attachment/laporan-kelitbangan/'.$at['nama']) }}"><i class="fa fa-file"></i>{{ $at['nama'] }}</a>
                            @endif
                        @endforeach
                    </td>
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
        let tbl_data = $('#datatable1').DataTable();
        // $(`#datatable1 thead tr`).first().clone().appendTo(`#datatable1`);
        // $(`#datatable1 thead tr:eq(1) th`).each(function (i) {
        //     console.log(i);
        //     let title = $(this).text();
        //     if (title == 'ID') {
        //         $(this).html('');
        //     } else {
        //         $(this).html('<input type="text" class="form-control" placeholder="' + title + '" />');
        //     }
        //     $('input', this).on('keyup', function (e) {
        //         tbl_data.column(i).search(this.value).draw();
        //     });
        // });
    });

    </script>
@endpush
