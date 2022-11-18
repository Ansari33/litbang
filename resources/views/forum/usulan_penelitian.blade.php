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
                    <h3>Daftar  <span>Usulan Penelitian</span> yang Telah Kami Terima!</h3>
                    <span>Ajukan <em>Usulan Penelitan </em> Anda,  Ayo Sama - sama Meneliti!</span>
                </div>
                <div class="col-12 col-lg-auto mt-4 mt-lg-0">
                    <a href="/usul-penelitian" target="_blank" class="button button-large button-circle m-0">Usulkan Penelitian</a>
                </div>
            </div>

        </div>

        <div class="section mb-0">
            <div class="container">

                <div class="table-responsive">
                    <table id="datatable1" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th style="width: 5%">No.</th>
                            <th style="width: 40%">Usulan</th>
                            <th style="width: 25%">Pengusul</th>
                            <th style="width: 15%; text-align: center ">Tanggal</th>
                            <th style="width: 15%; text-align: center;">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $dt => $d)
                            <tr>
                                <td>{{ $dt+1 }}</td>
                                <td><a href="/view-usulan-penelitian/{{ $d['id'] }}" style="color:#000;">{{ $d['usulan'] }}</a> </td>
                                <td>{{ $d['pengusul']}}</td>
                                <td style="text-align: center">{{ $d['tanggal'] }}</td>
                                <td class="" style="text-align: center" >{{ $d['status'] }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

{{--                <div class="grid-filter-wrap">--}}
{{--                    <!-- Grid Filter--}}
{{--                    ============================================= -->--}}
{{--                    <ul class="grid-filter" data-container="#portfolio">--}}

{{--                        <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>--}}
{{--                        <li><a href="#" data-filter=".pf-icons">Icons</a></li>--}}
{{--                        <li><a href="#" data-filter=".pf-illustrations">Illustrations</a></li>--}}
{{--                        <li><a href="#" data-filter=".pf-uielements">UI Elements</a></li>--}}
{{--                        <li><a href="#" data-filter=".pf-media">Media</a></li>--}}
{{--                        <li><a href="#" data-filter=".pf-graphics">Graphics</a></li>--}}

{{--                    </ul><!-- .grid-filter end -->--}}

{{--                    <div class="grid-shuffle" data-container="#portfolio">--}}
{{--                        <i class="icon-random"></i>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <!-- Portfolio Items--}}
{{--                ============================================= -->--}}
{{--                <div id="portfolio" class="portfolio row grid-container g-0" data-layout="fitRows">--}}

{{--                    <!-- Portfolio Item: Start -->--}}
{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-media pf-icons">--}}
{{--                        <!-- Grid Inner: Start -->--}}
{{--                        <div class="grid-inner">--}}
{{--                            <!-- Image: Start -->--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <a href="portfolio-single.html">--}}
{{--                                    <img src="{{ asset('images/portfolio/4/1.jpg')}}" alt="Open Imagination">--}}
{{--                                </a>--}}
{{--                                <!-- Overlay: Start -->--}}
{{--                                <div class="bg-overlay">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="images/portfolio/full/1.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>--}}
{{--                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                                <!-- Overlay: End -->--}}
{{--                            </div>--}}
{{--                            <!-- Image: End -->--}}
{{--                            <!-- Decription: Start -->--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single.html">Open Imagination</a></h3>--}}
{{--                                <span><a href="#">Media</a>, <a href="#">Icons</a></span>--}}
{{--                            </div>--}}
{{--                            <!-- Description: Start -->--}}
{{--                        </div>--}}
{{--                        <!-- Grid Inner: End -->--}}
{{--                    </article>--}}
{{--                    <!-- Portfolio Item: End -->--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-illustrations">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <a href="portfolio-single.html">--}}
{{--                                    <img src="{{ asset('images/portfolio/4/2.jpg')}}" alt="Locked Steel Gate">--}}
{{--                                </a>--}}
{{--                                <div class="bg-overlay">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="images/portfolio/full/2.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>--}}
{{--                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single.html">Locked Steel Gate</a></h3>--}}
{{--                                <span><a href="#">Illustrations</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-graphics pf-uielements">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <a href="#">--}}
{{--                                    <img src="{{ asset('images/portfolio/4/3.jpg')}}" alt="Mac Sunglasses">--}}
{{--                                </a>--}}
{{--                                <div class="bg-overlay">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="https://vimeo.com/89396394" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>--}}
{{--                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single-video.html">Mac Sunglasses</a></h3>--}}
{{--                                <span><a href="#">Graphics</a>, <a href="#">UI Elements</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-icons pf-illustrations">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <div class="fslider" data-arrows="false" data-speed="400" data-pause="4000">--}}
{{--                                    <div class="flexslider">--}}
{{--                                        <div class="slider-wrap">--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/4.jpg')}}" alt="Morning Dew"></a></div>--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/4-1.jpg')}}" alt="Morning Dew"></a></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay" data-lightbox="gallery">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="images/portfolio/full/4.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>--}}
{{--                                        <a href="images/portfolio/full/4-1.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single-gallery.html">Morning Dew</a></h3>--}}
{{--                                <span><a href="#">Icons</a>, <a href="#">Illustrations</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-uielements pf-media">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <a href="portfolio-single.html">--}}
{{--                                    <img src="{{ asset('images/portfolio/4/5.jpg')}}" alt="Console Activity">--}}
{{--                                </a>--}}
{{--                                <div class="bg-overlay">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="images/portfolio/full/5.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>--}}
{{--                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single.html">Console Activity</a></h3>--}}
{{--                                <span><a href="#">UI Elements</a>, <a href="#">Media</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-graphics pf-illustrations">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <div class="fslider" data-arrows="false">--}}
{{--                                    <div class="flexslider">--}}
{{--                                        <div class="slider-wrap">--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/6.jpg')}}" alt="Shake It"></a></div>--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/6-1.jpg')}}" alt="Shake It"></a></div>--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/6-2.jpg')}}" alt="Shake It"></a></div>--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/6-3.jpg')}}" alt="Shake It"></a></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay" data-lightbox="gallery">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="images/portfolio/full/6.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>--}}
{{--                                        <a href="images/portfolio/full/6-1.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                        <a href="images/portfolio/full/6-2.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                        <a href="images/portfolio/full/6-3.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                        <a href="portfolio-single-gallery.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single-gallery.html">Shake It!</a></h3>--}}
{{--                                <span><a href="#">Illustrations</a>, <a href="#">Graphics</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-uielements pf-icons">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <a href="portfolio-single-video.html">--}}
{{--                                    <img src="{{ asset('images/portfolio/4/7.jpg')}}" alt="Backpack Contents">--}}
{{--                                </a>--}}
{{--                                <div class="bg-overlay">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="https://www.youtube.com/watch?v=kuceVNBTJio" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>--}}
{{--                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single-video.html">Backpack Contents</a></h3>--}}
{{--                                <span><a href="#">UI Elements</a>, <a href="#">Icons</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-graphics">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <a href="portfolio-single.html">--}}
{{--                                    <img src="{{ asset('images/portfolio/4/8.jpg')}}" alt="Sunset Bulb Glow">--}}
{{--                                </a>--}}
{{--                                <div class="bg-overlay">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="images/portfolio/full/8.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>--}}
{{--                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single.html">Sunset Bulb Glow</a></h3>--}}
{{--                                <span><a href="#">Graphics</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-illustrations pf-icons">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <div class="fslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="fade">--}}
{{--                                    <div class="flexslider">--}}
{{--                                        <div class="slider-wrap">--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/9.jpg')}}" alt="Bridge Side"></a></div>--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/9-1.jpg')}}" alt="Bridge Side"></a></div>--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/9-2.jpg')}}" alt="Bridge Side"></a></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay" data-lightbox="gallery">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="images/portfolio/full/9.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>--}}
{{--                                        <a href="images/portfolio/full/9-1.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                        <a href="images/portfolio/full/9-2.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                        <a href="portfolio-single-gallery.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single.html">Bridge Side</a></h3>--}}
{{--                                <span><a href="#">Illustrations</a>, <a href="#">Icons</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-graphics pf-media pf-uielements">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <a href="portfolio-single-video.html">--}}
{{--                                    <img src="{{ asset('images/portfolio/4/10.jpg')}}" alt="Study Table">--}}
{{--                                </a>--}}
{{--                                <div class="bg-overlay">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="https://vimeo.com/91973305" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>--}}
{{--                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single-video.html">Study Table</a></h3>--}}
{{--                                <span><a href="#">Graphics</a>, <a href="#">Media</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-media pf-icons">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <a href="portfolio-single.html">--}}
{{--                                    <img src="{{ asset('images/portfolio/4/11.jpg')}}" alt="Workspace Stuff">--}}
{{--                                </a>--}}
{{--                                <div class="bg-overlay">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="images/portfolio/full/11.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>--}}
{{--                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single.html">Workspace Stuff</a></h3>--}}
{{--                                <span><a href="#">Media</a>, <a href="#">Icons</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                    <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-illustrations pf-graphics">--}}
{{--                        <div class="grid-inner">--}}
{{--                            <div class="portfolio-image">--}}
{{--                                <div class="fslider" data-arrows="false" data-speed="700" data-pause="7000">--}}
{{--                                    <div class="flexslider">--}}
{{--                                        <div class="slider-wrap">--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/12.jpg')}}" alt="Fixed Aperture"></a></div>--}}
{{--                                            <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/12-1.jpg')}}" alt="Fixed Aperture"></a></div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay" data-lightbox="gallery">--}}
{{--                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                        <a href="images/portfolio/full/12.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>--}}
{{--                                        <a href="images/portfolio/full/12-1.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                        <a href="portfolio-single-gallery.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                    </div>--}}
{{--                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="portfolio-desc">--}}
{{--                                <h3><a href="portfolio-single-gallery.html">Fixed Aperture</a></h3>--}}
{{--                                <span><a href="#">Illustrations</a>, <a href="#">Graphics</a></span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </article>--}}

{{--                </div><!-- #portfolio end -->--}}

            </div>
        </div>




    </div>
@endsection
@push('custom-scripts')
    <script src="{{asset('admin/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <script>
        var tabel;
        var data = {!! json_encode($data) !!};
        $(function() {
           tabel = $('#datatable1').DataTable({});
            // tabel.clear()
            // .draw();
            //
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
