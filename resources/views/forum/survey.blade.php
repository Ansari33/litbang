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
                    <h3>Survey  <span>Masyarakat!</span> </h3>
                    <span>Berikut Daftar Survey, Berikan <em>Tanggapan </em> Anda Dengan Mengisi Survey!</span>
                </div>

            </div>

        </div>

        <div class="section mb-0">
            <div class="container">
                <div class="row">
                @foreach($data as $item => $surv)
                    <div class="col-4 col-lg-auto mt-4 mt-lg-0">
                        <a href="{{ $surv['link'] }}" target="_blank" class="button button-large button-circle m-0">{{ $surv['nama'] }}</a>
                    </div>
                @endforeach
                </div>
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
