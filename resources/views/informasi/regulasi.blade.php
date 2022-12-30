@extends('layout')
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="mx-auto center clearfix" style="max-width: 900px;">
{{--                <img class="bottommargin" src="images/logo-side.png" alt="Image">--}}
                <h1>Regulasi</h1>

            </div>

            <div class="line"></div>

            <div class="row justify-content-center col-mb-50">
                <ul>
                @foreach($data as $re => $reg)
                <li><div class="col-sm-6 col-lg-12">
                    <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn">
{{--                        <div class="fbox-icon" style="">--}}
{{--                            <a href="#"><i class="icon-star"></i></a>--}}
{{--                        </div>--}}
                        <div class="fbox-content">
                            <a href="/files-attachment/regulasi/{{ $reg['file'] }}"><h4>{{ $reg['nama'] }}</h4></a>
{{--                            <p>Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>--}}
                        </div>
                    </div>
                </div></li>
                @endforeach
                </ul>
            </div>

        </div>
{{--        <div class="container clearfix">--}}
{{--            <div class="row">--}}
{{--                <div class="col-lg-10">--}}
{{--                    <div class="table-responsive">--}}
{{--                        <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">--}}
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th>No.</th>--}}
{{--                                <th>Nama</th>--}}
{{--                                <th>Tanggal</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            @foreach($data as $item => $reg)--}}
{{--                            <tr>--}}
{{--                                <td>{{ $item + 1  }}</td>--}}

{{--                                <td><a href="/download-regulasi/{{ $reg['file'] }}" style="color: inherit">{{ $reg['nama']  }}</a></td>--}}

{{--                                <td>{{ $reg['tanggal']  }}</td>--}}
{{--                            </tr>--}}
{{--                            @endForeach--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
@endsection
