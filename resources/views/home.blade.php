@extends('layout')
@section('title')
    Beranda
@endsection
@section('content')
@php
 $arrayKajian = [
    '                <div class="col-sm-6 col-lg-3 text-center">
                    <h6>Kelitbangan Lingkup Inovasi dan Teknologi</h6>
                    <div class="">2022</div>
                    <h6>Injabar Unversitas Padjadjaran</h6>
                    <div>
                        <h5 class="text-uppercase" style="font-weight: 200;">Strategi Penanganan Stunting Kota Bandung (Penelitian Mandiri)</h5>
                        <p style="line-height: 1.8;">Transform, agency working families thinkers who make change happen communities. Developing nations legal aid public sector our ambitions future aid The Elders economic security Rosa.</p>
                        <a href="#" class="button button-border button-black button-rounded text-uppercase m-0">Read More</a>

                    </div>
                </div>',
                '                <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn" data-delay="200">
                    <h6>Kelitbangan Lingkup Inovasi dan Teknologi</h6>
                    <div class="">2022</div>
                    <h6>Injabar Unversitas Padjadjaran</h6>
                    <div>
                        <h5 class="text-uppercase" style="font-weight: 200;">Strategi Penanganan Stunting Kota Bandung (Penelitian Mandiri)</h5>
                        <p style="line-height: 1.8;">Transform, agency working families thinkers who make change happen communities. Developing nations legal aid public sector our ambitions future aid The Elders economic security Rosa.</p>
                        <a href="#" class="button button-border button-black button-rounded text-uppercase m-0">Read More</a>

                    </div>
                </div>',
];
@endphp
<div class="content-wrap">
  <div class="container clearfix">

{{--        <div class="mx-auto center clearfix" style="max-width: 900px;">--}}
{{--            <img class="bottommargin" src="images/logo-side.png" alt="Image">--}}
{{--            <h1>Welcome! This is <span>Canvas</span>.</h1>--}}
{{--            <h2>A very clean, responsive &amp; super flexible multipurpose theme that makes it easy to create a website of any category.</h2>--}}
{{--            <a href="#" class="button button-3d button-dark button-large ">Browse Features</a>--}}
{{--            <a href="#" class="button button-3d button-large">Buy Now</a>--}}
{{--        </div>--}}

{{--        <div class="line"></div>--}}

{{--        <div class="row justify-content-center col-mb-50">--}}
{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn">--}}
{{--                    <div class="fbox-icon">--}}
{{--                        <a href="#"><i class="icon-phone2"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="fbox-content">--}}
{{--                        <h3>Responsive Layout</h3>--}}
{{--                        <p>Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="200">--}}
{{--                    <div class="fbox-icon">--}}
{{--                        <a href="#"><i class="icon-eye"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="fbox-content">--}}
{{--                        <h3>Retina Ready Graphics</h3>--}}
{{--                        <p>Looks beautiful &amp; ultra-sharp on Retina Displays with Retina Icons, Fonts &amp; Images.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="400">--}}
{{--                    <div class="fbox-icon">--}}
{{--                        <a href="#"><i class="icon-star2"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="fbox-content">--}}
{{--                        <h3>Powerful Performance</h3>--}}
{{--                        <p>Optimized code that are completely customizable and deliver unmatched fast performance.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="600">--}}
{{--                    <div class="fbox-icon">--}}
{{--                        <a href="#"><i class="icon-video"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="fbox-content">--}}
{{--                        <h3>HTML5 Video</h3>--}}
{{--                        <p>Canvas provides support for Native HTML5 Videos that can be added to a Full Width Background.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="800">--}}
{{--                    <div class="fbox-icon">--}}
{{--                        <a href="#"><i class="icon-params"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="fbox-content">--}}
{{--                        <h3>Parallax Support</h3>--}}
{{--                        <p>Display your Content attractively using Parallax Sections that have unlimited customizable areas.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="1000">--}}
{{--                    <div class="fbox-icon">--}}
{{--                        <a href="#"><i class="icon-fire"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="fbox-content">--}}
{{--                        <h3>Endless Possibilities</h3>--}}
{{--                        <p>Complete control on each &amp; every element that provides endless customization possibilities.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="1200">--}}
{{--                    <div class="fbox-icon">--}}
{{--                        <a href="#"><i class="icon-bulb"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="fbox-content">--}}
{{--                        <h3>Light &amp; Dark Color Schemes</h3>--}}
{{--                        <p>Change your Website's Primary Scheme instantly by simply adding the dark class to the body.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="1400">--}}
{{--                    <div class="fbox-icon">--}}
{{--                        <a href="#"><i class="icon-heart2"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="fbox-content">--}}
{{--                        <h3>Boxed &amp; Wide Layouts</h3>--}}
{{--                        <p>Stretch your Website to the Full Width or make it boxed to surprise your visitors.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="feature-box fbox-sm fbox-plain" data-animate="fadeIn" data-delay="1600">--}}
{{--                    <div class="fbox-icon">--}}
{{--                        <a href="#"><i class="icon-note"></i></a>--}}
{{--                    </div>--}}
{{--                    <div class="fbox-content">--}}
{{--                        <h3>Extensive Documentation</h3>--}}
{{--                        <p>We have covered each &amp; everything in our Documentation including Videos &amp; Screenshots.</p>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>

    <div class="clear"></div>

    <div class="section parallax dark mb-0 border-bottom-0" style="background-image: url({{asset('images/parallax/7.jpg')}});" data-bottom-top="background-position:0px 0px;" data-top-bottom="background-position:0px -300px;">

        <div class="container clearfix">

            <div class="heading-block center">
                <h2>Bidang Penelitan dan Pengembangan</h2>
                <span>Built with passion &amp; intuitiveness in mind. Canvas is a masterclass piece of work presented to you.</span>
            </div>

            <div style="position: relative; margin-bottom: -60px;" data-height-xl="415" data-height-lg="342" data-height-md="262" data-height-sm="160" data-height-xs="102">
                <img src="{{asset('images/services/chrome.png')}}" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" alt="Chrome">
                <img src="{{asset('images/services/ipad3.png')}}" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="300" alt="iPad">
            </div>

        </div>

    </div>

    <div class="section border-top-0 topmargin-sm bottommargin-sm border-0 bg-transparent">
{{--        <div class="section mt-0 border-0 mb-0" >--}}
            <div class="container clearfix">

                <div class="heading-block center mb-0">
                    <h3>Kelitbangan</h3>
                    <span>Kajian Terkini</span>
                </div>

            </div>
{{--        //</div>--}}
        <div class="container clearfix" >

            <div class="row col-mb-50" id="post_kajian">
{{--                @foreach($arrayKajian as $k => $j)--}}
{{--                    {!! $j !!}--}}
{{--                @endforeach--}}
{{--                <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn">--}}
{{--                    <h6>Kelitbangan Lingkup Inovasi dan Teknologi</h6>--}}
{{--                    <div class="">2022</div>--}}
{{--                    <h6>Injabar Unversitas Padjadjaran</h6>--}}
{{--                    <div>--}}
{{--                        <h5 class="text-uppercase" style="font-weight: 200;">Wkajian Strategis Sosial ( Pemetaan Populasi Kunci AIDS )</h5>--}}
{{--                        <p style="line-height: 1.8; text-align: left;">Transform, agency working families thinkers who make change happen communities. Developing nations legal aid public sector our ambitions future aid The Elders economic security Rosa.</p>--}}
{{--                        <a href="#" class="button button-border button-black button-rounded text-uppercase m-0">Read More</a>--}}

{{--                    </div>--}}
{{--                </div>--}}



{{--                <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn" data-delay="400">--}}
{{--                    <h6>Kelitbangan Lingkup Inovasi dan Teknologi</h6>--}}
{{--                    <div class="">2022</div>--}}
{{--                    <h6>Injabar Unversitas Padjadjaran</h6>--}}
{{--                    <div>--}}
{{--                        <h5 class="text-uppercase" style="font-weight: 200;">Pengembangan Pusat Data Terintegrasi di Kota Bandung</h5>--}}
{{--                        <p style="line-height: 1.8;">Transform, agency working families thinkers who make change happen communities. Developing nations legal aid public sector our ambitions future aid The Elders economic security Rosa.</p>--}}
{{--                        <a href="#" class="button button-border button-black button-rounded text-uppercase m-0">Read More</a>--}}

{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-sm-6 col-lg-3 text-center" data-animate="bounceIn" data-delay="600">--}}
{{--                    <h6>Kelitbangan Lingkup Inovasi dan Teknologi</h6>--}}
{{--                    <div class="">2022</div>--}}
{{--                    <h6>Injabar Unversitas Padjadjaran</h6>--}}
{{--                    <div>--}}
{{--                        <h5 class="text-uppercase" style="font-weight: 200;">Why choose Us</h5>--}}
{{--                        <p style="line-height: 1.8;">Transform, agency working families thinkers who make change happen communities. Developing nations legal aid public sector our ambitions future aid The Elders economic security Rosa.</p>--}}
{{--                        <a href="#" class="button button-border button-black button-rounded text-uppercase m-0">Read More</a>--}}

{{--                    </div>--}}
{{--                </div>--}}
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

        <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-media pf-icons">
            <div class="grid-inner">
                <div class="portfolio-image">
                    <a href="portfolio-single.html">
                        <img src="images/portfolio/4/1.jpg" alt="Open Imagination">
                    </a>
                    <div class="bg-overlay">
                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                            <a href="images/portfolio/full/1.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>
                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a href="portfolio-single.html">Open Imagination</a></h3>
                    <span><a href="#">Media</a>, <a href="#">Icons</a></span>
                </div>
            </div>
        </article>

        <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-illustrations">
            <div class="grid-inner">
                <div class="portfolio-image">
                    <a href="portfolio-single.html">
                        <img src="images/portfolio/4/2.jpg" alt="Locked Steel Gate">
                    </a>
                    <div class="bg-overlay">
                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                            <a href="images/portfolio/full/2.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>
                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a href="portfolio-single.html">Locked Steel Gate</a></h3>
                    <span><a href="#">Illustrations</a></span>
                </div>
            </div>
        </article>

        <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-graphics pf-uielements">
            <div class="grid-inner">
                <div class="portfolio-image">
                    <a href="#">
                        <img src="images/portfolio/4/3.jpg" alt="Mac Sunglasses">
                    </a>
                    <div class="bg-overlay">
                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                            <a href="https://vimeo.com/89396394" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a href="portfolio-single-video.html">Mac Sunglasses</a></h3>
                    <span><a href="#">Graphics</a>, <a href="#">UI Elements</a></span>
                </div>
            </div>
        </article>

        <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-icons pf-illustrations">
            <div class="grid-inner">
                <div class="portfolio-image">
                    <a href="portfolio-single.html">
                        <img src="images/portfolio/4/4.jpg" alt="Open Imagination">
                    </a>
                    <div class="bg-overlay" data-lightbox="gallery">
                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                            <a href="images/portfolio/full/4.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
                            <a href="images/portfolio/full/4-1.jpg" class="d-none" data-lightbox="gallery-item"></a>
                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a href="portfolio-single-gallery.html">Morning Dew</a></h3>
                    <span><a href="#">Icons</a>, <a href="#">Illustrations</a></span>
                </div>
            </div>
        </article>

        <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-uielements pf-media">
            <div class="grid-inner">
                <div class="portfolio-image">
                    <a href="portfolio-single.html">
                        <img src="images/portfolio/4/5.jpg" alt="Console Activity">
                    </a>
                    <div class="bg-overlay">
                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                            <a href="images/portfolio/full/5.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>
                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a href="portfolio-single.html">Console Activity</a></h3>
                    <span><a href="#">UI Elements</a>, <a href="#">Media</a></span>
                </div>
            </div>
        </article>

        <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-graphics pf-illustrations">
            <div class="grid-inner">
                <div class="portfolio-image">
                    <a href="portfolio-single.html">
                        <img src="images/portfolio/4/6.jpg" alt="Open Imagination">
                    </a>
                    <div class="bg-overlay" data-lightbox="gallery">
                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                            <a href="images/portfolio/full/6.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>
                            <a href="images/portfolio/full/6-1.jpg" class="d-none" data-lightbox="gallery-item"></a>
                            <a href="images/portfolio/full/6-2.jpg" class="d-none" data-lightbox="gallery-item"></a>
                            <a href="images/portfolio/full/6-3.jpg" class="d-none" data-lightbox="gallery-item"></a>
                            <a href="portfolio-single-gallery.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a href="portfolio-single-gallery.html">Shake It!</a></h3>
                    <span><a href="#">Illustrations</a>, <a href="#">Graphics</a></span>
                </div>
            </div>
        </article>

        <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-uielements pf-icons">
            <div class="grid-inner">
                <div class="portfolio-image">
                    <a href="portfolio-single-video.html">
                        <img src="images/portfolio/4/7.jpg" alt="Backpack Contents">
                    </a>
                    <div class="bg-overlay">
                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                            <a href="https://www.youtube.com/watch?v=kuceVNBTJio" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="iframe"><i class="icon-line-play"></i></a>
                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a href="portfolio-single-video.html">Backpack Contents</a></h3>
                    <span><a href="#">UI Elements</a>, <a href="#">Icons</a></span>
                </div>
            </div>
        </article>

        <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-graphics">
            <div class="grid-inner">
                <div class="portfolio-image">
                    <a href="portfolio-single.html">
                        <img src="images/portfolio/4/8.jpg" alt="Sunset Bulb Glow">
                    </a>
                    <div class="bg-overlay">
                        <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                            <a href="images/portfolio/full/8.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>
                            <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                        </div>
                        <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                    </div>
                </div>
                <div class="portfolio-desc">
                    <h3><a href="portfolio-single.html">Sunset Bulb Glow</a></h3>
                    <span><a href="#">Graphics</a></span>
                </div>
            </div>
        </article>

    </div>

{{--    <a href="#" class="button button-full button-dark center text-end bottommargin-lg">--}}
{{--        <div class="container clearfix">--}}
{{--            We have more than 100+ predefined Portfolio Grid Layouts. <strong>See More</strong> <i class="icon-caret-right" style="top:4px;"></i>--}}
{{--        </div>--}}
{{--    </a>--}}

{{--    <div class="container clearfix">--}}

{{--        <div class="row align-items-center gutter-40 col-mb-50">--}}
{{--            <div class="col-md-5">--}}
{{--                <img data-animate="fadeInLeftBig" src="images/services/imac.png" alt="Imac">--}}
{{--            </div>--}}

{{--            <div class="col-md-7">--}}
{{--                <div class="heading-block">--}}
{{--                    <h2>Retina Device Ready.</h2>--}}
{{--                    <span>Fabulously Sharp &amp; Intuitive on your HD Devices.</span>--}}
{{--                </div>--}}

{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus deserunt, nobis quae eos provident quidem. Quaerat expedita dignissimos perferendis, nihil quo distinctio eius architecto reprehenderit maiores.</p>--}}

{{--                <a href="#" class="button button-border button-rounded button-large ms-0 topmargin-sm">Experience More</a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="line"></div>--}}

{{--    </div>--}}

{{--    <div class="container mx-auto clearfix">--}}

{{--        <div class="heading-block center">--}}
{{--            <h2>Canvas: We know you want it!</h2>--}}
{{--            <span>Built with passion &amp; intuitiveness in mind. Canvas is a masterclass piece of work presented to you.</span>--}}
{{--        </div>--}}

{{--        <div style="position: relative;" data-height-xl="624" data-height-lg="518" data-height-md="397" data-height-sm="242" data-height-xs="154">--}}
{{--            <img src="images/services/fbrowser.png" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="100" alt="Chrome">--}}
{{--            <img src="images/services/fmobile.png" style="position: absolute; top: 0; left: 0;" data-animate="fadeInUp" data-delay="400" alt="iPad">--}}
{{--            <img src="images/services/fbrowser2.png" style="position: absolute; top: 0; left: 0;" data-animate="fadeIn" data-delay="1200" alt="iPad">--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="section dark my-0 border-0" style="height: 500px; padding: 145px 0;">--}}

{{--        <div class="container clearfix">--}}

{{--            <div class="slider-caption slider-caption-center" style="position: relative;">--}}
{{--                <div data-animate="fadeInUp">--}}
{{--                    <h2 style="font-size: 42px;">Beautiful HTML5 Videos</h2>--}}
{{--                    <p class="d-none d-sm-block">Looks beautiful &amp; ultra-sharp on Retina Screen Displays. Powerful Layout with Responsive functionality that can be adapted to any screen size.</p>--}}
{{--                    <a href="#" class="button button-border button-rounded button-white button-light button-large ms-0 mb-0 d-none d-md-inline-block" style="margin-top: 20px;">Show More</a>--}}
{{--                </div>--}}
{{--            </div>--}}

{{--        </div>--}}

{{--        <div class="video-wrap">--}}
{{--            <video poster="images/videos/explore-poster.jpg" preload="none" loop autoplay muted>--}}
{{--                <source src='images/videos/explore.mp4' type='video/mp4' />--}}
{{--                <source src='images/videos/explore.webm' type='video/webm' />--}}
{{--            </video>--}}
{{--            <div class="video-overlay" style="background-color: rgba(0,0,0,0.3);"></div>--}}
{{--        </div>--}}

{{--    </div>--}}

    <div class="row bottommargin-lg align-items-stretch">

{{--        <div class="col-lg-4 dark col-padding overflow-hidden" style="background-color: #1abc9c;">--}}
{{--            <div>--}}
{{--                <h3 class="text-uppercase" style="font-weight: 600;">Why choose Us</h3>--}}
{{--                <p style="line-height: 1.8;">Transform, agency working families thinkers who make change happen communities. Developing nations legal aid public sector our ambitions future aid The Elders economic security Rosa.</p>--}}
{{--                <a href="#" class="button button-border button-light button-rounded text-uppercase m-0">Read More</a>--}}
{{--                <i class="icon-bulb bgicon"></i>--}}
{{--            </div>--}}

{{--        </div>--}}

{{--        <div class="col-lg-4 dark col-padding overflow-hidden" style="background-color: #34495e;">--}}
{{--            <div>--}}
{{--                <h3 class="text-uppercase" style="font-weight: 600;">Our Mission</h3>--}}
{{--                <p style="line-height: 1.8;">Frontline respond, visionary collaborative cities advancement overcome injustice, UNHCR public-private partnerships cause. Giving, country educate rights-based approach; leverage disrupt solution.</p>--}}
{{--                <a href="#" class="button button-border button-light button-rounded text-uppercase m-0">Read More</a>--}}
{{--                <i class="icon-cog bgicon"></i>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-lg-4 dark col-padding overflow-hidden" style="background-color: #e74c3c;">--}}
{{--            <div>--}}
{{--                <h3 class="text-uppercase" style="font-weight: 600;">What you get</h3>--}}
{{--                <p style="line-height: 1.8;">Sustainability involvement fundraising campaign connect carbon rights, collaborative cities convener truth. Synthesize change lives treatment fluctuation participatory monitoring underprivileged equal.</p>--}}
{{--                <a href="#" class="button button-border button-light button-rounded text-uppercase m-0">Read More</a>--}}
{{--                <i class="icon-thumbs-up bgicon"></i>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="clear"></div>--}}

    </div>

    <div class="container clearfix">

        <div class="row col-mb-50">
            <div class="col-lg-12">
                <div class="fancy-title title-border">
                    <h4>Inovasi Terkini</h4>
                </div>

                <div class="row posts-md col-mb-30" id="post_inovasi">
{{--                    <div class="entry col-md-4">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="entry-image">--}}
{{--                                <a href="#"><img src="images/magazine/thumb/11.jpg" alt="Image"></a>--}}
{{--                            </div>--}}
{{--                            <div class="entry-title title-sm nott">--}}
{{--                                <h3><a href="blog-single.html">Angkot Distancing Saredona BDG</a></h3>--}}
{{--                            </div>--}}
{{--                            <div class="entry-meta">--}}
{{--                                <ul>--}}
{{--                                    <li><i class="icon-calendar3"></i> Dinas Pendidikan</li>--}}
{{--                                    <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="entry-content">--}}
{{--                                <p>Medecins du Monde eradicate sustainability free expression contribution assessment expert humanitarian relief.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="entry col-md-4">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="entry-image">--}}
{{--                                <a href="#"><img src="images/magazine/thumb/14.jpg" alt="Image"></a>--}}
{{--                            </div>--}}
{{--                            <div class="entry-title title-sm nott">--}}
{{--                                <h3><a href="blog-single.html">Smart Card</a></h3>--}}
{{--                            </div>--}}
{{--                            <div class="entry-meta">--}}
{{--                                <ul>--}}
{{--                                    <li><i class="icon-calendar3"></i> Badan Perencanaan Pembangunan, Penelitian dan Pengembangan</li>--}}
{{--                                    <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 13</a></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                            <div class="entry-content">--}}
{{--                                <p>Urban public institutions life-saving women and children Rockefeller combat malaria honesty. Sustainability foster immunize treatment.</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>

{{--            <div class="col-lg-4">--}}
{{--                <div class="fancy-title title-border">--}}
{{--                    <h4>Client Testimonials</h4>--}}
{{--                </div>--}}

{{--                <div class="fslider testimonial p-0 border-0 shadow-none" data-animation="slide" data-arrows="false">--}}
{{--                    <div class="flexslider">--}}
{{--                        <div class="slider-wrap">--}}
{{--                            <div class="slide">--}}
{{--                                <div class="testi-image">--}}
{{--                                    <a href="#"><img src="images/testimonials/3.jpg" alt="Customer Testimonails"></a>--}}
{{--                                </div>--}}
{{--                                <div class="testi-content">--}}
{{--                                    <p>Similique fugit repellendus expedita excepturi iure perferendis provident quia eaque. Repellendus, vero numquam?</p>--}}
{{--                                    <div class="testi-meta">--}}
{{--                                        Steve Jobs--}}
{{--                                        <span>Apple Inc.</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="slide">--}}
{{--                                <div class="testi-image">--}}
{{--                                    <a href="#"><img src="images/testimonials/2.jpg" alt="Customer Testimonails"></a>--}}
{{--                                </div>--}}
{{--                                <div class="testi-content">--}}
{{--                                    <p>Natus voluptatum enim quod necessitatibus quis expedita harum provident eos obcaecati id culpa corporis molestias.</p>--}}
{{--                                    <div class="testi-meta">--}}
{{--                                        Collis Ta'eed--}}
{{--                                        <span>Envato Inc.</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="slide">--}}
{{--                                <div class="testi-image">--}}
{{--                                    <a href="#"><img src="images/testimonials/1.jpg" alt="Customer Testimonails"></a>--}}
{{--                                </div>--}}
{{--                                <div class="testi-content">--}}
{{--                                    <p>Incidunt deleniti blanditiis quas aperiam recusandae consequatur ullam quibusdam cum libero illo rerum!</p>--}}
{{--                                    <div class="testi-meta">--}}
{{--                                        John Doe--}}
{{--                                        <span>XYZ Inc.</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="card topmargin overflow-hidden">--}}
{{--                    <div class="card-body">--}}
{{--                        <h4>Opening Hours</h4>--}}

{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit reprehenderit voluptates.</p>--}}

{{--                        <ul class="iconlist mb-0">--}}
{{--                            <li><i class="icon-time color"></i> <strong>Mondays-Fridays:</strong> 10AM to 7PM</li>--}}
{{--                            <li><i class="icon-time color"></i> <strong>Saturdays:</strong> 11AM to 3PM</li>--}}
{{--                            <li><i class="icon-time text-danger"></i> <strong>Sundays:</strong> Closed</li>--}}
{{--                        </ul>--}}

{{--                        <i class="icon-time bgicon"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>

    </div>

    <div class="section mb-0">
        <div class="container clearfix">

            <div class="heading-block center">
                <h3>Hubungi Kami <span>Newsletter</span></h3>
            </div>

            <div class="subscribe-widget">
                <div class="widget-subscribe-form-result"></div>
                <form id="widget-subscribe-form2" action="include/subscribe.php" method="post" class="mb-0">
                    <div class="input-group input-group-lg mx-auto" style="max-width:600px;">
                        <div class="input-group-text"><i class="icon-email2"></i></div>
                        <input type="email" name="widget-subscribe-form-email" class="form-control required email" placeholder="Enter your Email">
                        <button class="btn btn-secondary" type="submit">Hubungi Sekarang</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div id="oc-clients" class="section bg-transparent mt-0 owl-carousel owl-carousel-full image-carousel footer-stick carousel-widget" data-margin="80" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6">

        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/1.png')}}" alt="Clients"></a></div>
        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/2.png')}}" alt="Clients"></a></div>
        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/3.png')}}" alt="Clients"></a></div>
        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/4.png')}}" alt="Clients"></a></div>
        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/5.png')}}" alt="Clients"></a></div>
        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/6.png')}}" alt="Clients"></a></div>
        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/7.png')}}" alt="Clients"></a></div>
        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/8.png')}}" alt="Clients"></a></div>
        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/9.png')}}" alt="Clients"></a></div>
        <div class="oc-item"><a href="#"><img src="{{asset('images/clients/10.png')}}" alt="Clients"></a></div>

    </div>


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
