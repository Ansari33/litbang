@extends('layout')
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

{{--            <div class="heading-block center border-bottom-0 bottommargin-lg">--}}
{{--                <h1>Daftar Usulan Penelitian</h1>--}}
{{--                <span>Daftar Usulan Penelitian</span>--}}
{{--            </div>--}}
            <div class="row align-items-center">
                <div class="col-12 col-lg">
                    <h3>Survey  <span>Index Kepuasan</span> Masyarakat!</h3>
                    <span>Berikan <em>Tanggapan </em> Anda, Dengan Mengisi Survey tentang Kepuasan!</span>
                </div>
                <div class="col-12 col-lg-auto mt-4 mt-lg-0">
                    <a href="https://forms.gle/EUfoEjynEJ3Hx1XDA" target="_blank" class="button button-large button-circle m-0">Mulai Survey</a>
                </div>
            </div>

        </div>

        <div class="section mb-0">
            <div class="container">

{{--                <div class="table-responsive">--}}
{{--                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th style="width: 5%;">No.</th>--}}
{{--                            <th style="width: 45%;">Usulan</th>--}}
{{--                            <th style="width: 20%;">Pengusul</th>--}}
{{--                            <th style="width: 15%; text-align: center">Tanggal</th>--}}
{{--                            <th style="width: 55%; text-align: center">Status</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <style>--}}
{{--                            .link-detail hover {--}}
{{--                                cursor: pointer;--}}
{{--                            }--}}
{{--                        </style>--}}
{{--                        @foreach($data as $dt => $d)--}}
{{--                        <tr class="link-detail"  >--}}
{{--                            <td>{{$dt+1}}</td>--}}
{{--                            <td> <a href="/view-usulan-inovasi/{{ $d['id'] }}" style="color: black">{{ $d['usulan'] }}</a> </td>--}}
{{--                            <td>{{ $d['pengusul'] }}</td>--}}
{{--                            <td style="text-align: center">{{ $d['tanggal'] }}</td>--}}
{{--                            <td style="text-align: center">{{ $d['status'] }}</td>--}}
{{--                        </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}


            </div>
        </div>

        <div id="oc-clients-full" class="owl-carousel owl-carousel-full image-carousel footer-stick carousel-widget" data-margin="30" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false"data-items-xs="3" data-items-sm="4" data-items-md="5" data-items-lg="6" data-items-xl="7" style="padding: 30px 0;">

            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/1.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/2.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/3.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/4.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/5.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/6.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/7.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/8.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/9.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/10.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/11.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/12.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/13.png')}}" alt="Clients"></a></div>
            <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/14.png')}}" alt="Clients"></a></div>

        </div>


    </div>
@endsection
@push('custom-scripts')
    <script src="{{asset('admin/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script>
        function viewUsulanInovasi(id) {
            window.location.replace('/view-usulan-inovasi/'+id);
        }
        var tabel;
        {{--var data = {!! json_encode($data) !!};--}}
        $(function() {
           tabel = $('#datatable1').removeAttr('width').DataTable({

           });

            // $.each(data, function (key, value) {
            //     tabel.row.add([
            //         key +1,
            //         value['usulan'],
            //         value['pengusul'],
            //         value['tanggal'],
            //         value['status'],
            //     ]).draw(true);
            // });
        });
    </script>
@endpush
