@extends('layout')
@section('title')
    Beranda
@endsection
@section('content')

<div class="content-wrap">
  <div class="container clearfix">



    </div>

    <div class="clear"></div>

    <div class="section parallax dark mb-0 border-bottom-0" style="background-image: url({{asset('images/parallax/7.jpg')}});" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;">

        <div class="container clearfix">

            <div class="heading-block center">
                <h3>BADAN PENELITIAN DAN PENGEMBANGAN DAERAH KOTA MAKASSAR</h3>
{{--                <span>Built with passion &amp; intuitiveness in mind. Canvas is a masterclass piece of work presented to you.</span>--}}
            </div>

            <div style="position: relative; margin-bottom: -60px;" data-height-xl="415" data-height-lg="342" data-height-md="262" data-height-sm="160" data-height-xs="102">
                <img src="{{asset('images/balaikota1.jpeg')}}" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" alt="Chrome">
{{--                <img src="{{asset('images/balaikota2.jpg')}}" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="300" alt="iPad">--}}
            </div>

        </div>

    </div>

    <div class="section border-top-0 topmargin-sm bottommargin-sm border-0 bg-transparent">
            <div class="container clearfix">

                <div class="heading-block center mb-0">
                    <h3>Kelitbangan</h3>
                    <span>Kajian Terkini</span>
                </div>

            </div>

        <div class="container clearfix" >

            <div class="row col-mb-50" id="post_kajian">

            </div>

        </div>
    </div>

    <div class="section mt-0 border-0 mb-0" >
        <div class="container clearfix">

            <div class="heading-block center mb-0">
                <h2>Galeri</h2>
                <span>Foto dan Video Kegiatan</span>
            </div>

        </div>
    </div>

    <!-- Portfolio Items
    ============================================= -->
    <div id="portfolio" class="portfolio row g-0 portfolio-reveal grid-container">
        @foreach($attachment as $key => $att)

            @if($att['tipe'] == 'video')
                @if(file_exists(base_path($att['url'])))
                <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-graphics pf-uielements">
                    <div class="grid-inner">
                        <div class="portfolio-image">
                            <a href="#">
                                <video src="{{asset($att['url'])}} " style="height: 200px; width: 100%;">

                                </video>
{{--                                <img src="{{asset('videos/upload/').'/'.$att['nama']}}" alt="Mac Sunglasses" style="height: 200px; width: 100%;">--}}
                            </a>
                            <div class="bg-overlay">
                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                                    <a href="{{ $att['url']}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                                    <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                                </div>
                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                            </div>
                        </div>
                        <div class="portfolio-desc">
{{--                            <h3><a href="portfolio-single-video.html">Mac Sunglasses</a></h3>--}}
{{--                            <span><a href="#">Graphics</a>, <a href="#">UI Elements</a></span>--}}
                        </div>
                    </div>
                </article>
                @endif
            @else
                @if(file_exists(base_path('/'.$att['url'])))
                <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-media pf-icons">
                    <div class="grid-inner">
                        <div class="portfolio-image">
                            <a href="portfolio-single.html">
                                <img src="{{ $att['url'] }}" alt="Open Imagination" style="height: 200px; width: 100%;">
                            </a>
                            <div class="bg-overlay">
                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                                    <a href="{{ $att['url'] }}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="image" title="Image"><i class="icon-line-eye"></i></a>
{{--                                    <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>--}}
                                </div>
                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                            </div>
                        </div>
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single.html">Open Imagination</a></h3>--}}
{{--                            <span><a href="#">Media</a>, <a href="#">Icons</a></span>--}}
{{--                        </div>--}}
                    </div>
                </article>
                @endif
            @endif
        @endforeach


    </div>



    <div class="row bottommargin-lg align-items-stretch">


    </div>

    <div class="container clearfix">

        <div class="row col-mb-50">
            <div class="col-lg-12">
                <div class="fancy-title title-border">
                    <h4>Inovasi Terkini</h4>
                </div>

                <div class="row posts-md col-mb-30" id="post_inovasi">

                </div>
            </div>

        </div>

    </div>

{{--    <div class="section mb-0">--}}
{{--        <div class="container clearfix">--}}

{{--            <div class="heading-block center">--}}
{{--                <h3>Hubungi Kami <span>Newsletter</span></h3>--}}
{{--            </div>--}}

{{--            <div class="subscribe-widget">--}}
{{--                <div class="widget-subscribe-form-result"></div>--}}
{{--                <form id="widget-subscribe-form2" action="include/subscribe.php" method="post" class="mb-0">--}}
{{--                    <div class="input-group input-group-lg mx-auto" style="max-width:600px;">--}}
{{--                        <div class="input-group-text"><i class="icon-email2"></i></div>--}}
{{--                        <input type="email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">--}}
{{--                        <button class="btn btn-secondary" type="submit">Hubungi Sekarang</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}

{{--    <div id="oc-clients" class="section bg-transparent mt-0 owl-carousel owl-carousel-full image-carousel footer-stick carousel-widget" data-margin="80" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6">--}}

{{--        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/1.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/2.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/3.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/4.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/5.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/6.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/7.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/8.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/9.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/10.png')}}" alt="Clients"></a></div>--}}

{{--    </div>--}}


</div>
@endsection
@push('custom-scripts')
    <script>
        var list = {!! json_encode( $kelitbangan ) !!};
        var inovasi = {!! json_encode( $inovasi ) !!};
        $(function() {
            loadKajian(list);
            loadInovasi(inovasi);
        });
    </script>
@endpush
