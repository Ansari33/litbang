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
                <div class="col-sm-6 col-lg-12">
                    <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-star"></i></a>
                        </div>
                        <div class="fbox-content">
                            <h5>Undang - Undang No.23 Tahun 2014 Tentang Pemerintahan Daerah</h5>
{{--                            <p>Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>--}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-12">
                    <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="200">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-star"></i></a>
                        </div>
                        <div class="fbox-content">
                            <h5>Peraturan Daerah Kota Bandung Nomor 12 Tahun 2009 tentang Pembentukan SOTK di lingkungan Pemerintah Kota Bandung</h5>
{{--                            <p>Looks beautiful &amp; ultra-sharp on Retina Displays with Retina Icons, Fonts &amp; Images.</p>--}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-12">
                    <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-star"></i></a>
                        </div>
                        <div class="fbox-content">
                            <h5>Undang - Undang No.23 Tahun 2014 Tentang Pemerintahan Daerah</h5>
                            {{--                            <p>Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>--}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-12">
                    <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="200">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-star"></i></a>
                        </div>
                        <div class="fbox-content">
                            <h5>Peraturan Walikota Bandung Nomor 410 Tahun 2010 tentang Rincian tugas pokok, fungsi, uraian tugas dan tata kerja Badan perencanaan pembangunan daerah Kota Bandung, Susunan Organisasi Badan Perencanaan Pembangunan Daerah Kota Bandung.</h5>
                            {{--                            <p>Looks beautiful &amp; ultra-sharp on Retina Displays with Retina Icons, Fonts &amp; Images.</p>--}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-12">
                    <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-star"></i></a>
                        </div>
                        <div class="fbox-content">
                            <h5>Peraturan Daerah Kota Bandung Nomor 03 Tahun 2014 tentang RPJMD Kota Bandung Tahun 2013 - 2018.</h5>
                            {{--                            <p>Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>--}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-12">
                    <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="200">
                        <div class="fbox-icon">
                            <a href="#"><i class="icon-star"></i></a>
                        </div>
                        <div class="fbox-content">
                            <h5>Peraturan Menteri Dalam Negeri Nomor 20 Tahun 2011 tentang Pedoman Penelitian dan Pengembangan di Lingkungan Kementerian Dalam Negeri dan Pemerintahan Daerah</h5>
                            {{--                            <p>Looks beautiful &amp; ultra-sharp on Retina Displays with Retina Icons, Fonts &amp; Images.</p>--}}
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container clearfix">
            <div class="row">
                <div class="col-lg-10">
                    <div class="table-responsive">
                        <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Tanggal</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item => $reg)
                            <tr>
                                <td>{{ $item + 1  }}</td>

                                <td><a href="/download-regulasi/{{ $reg['file'] }}" style="color: inherit">{{ $reg['nama']  }}</a></td>

                                <td>{{ $reg['tanggal']  }}</td>
                            </tr>
                            @endForeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
