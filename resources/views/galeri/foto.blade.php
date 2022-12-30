@extends('layout')
@section('content')
<div class="content-wrap">

{{--    <a href="#" class="button button-full button-purple center text-end header-stick bottommargin-lg">--}}
{{--        <div class="container clearfix">--}}
{{--            Canvas comes with Unlimited Customizations &amp; Options. <strong>Check Out</strong> <i class="icon-caret-right" style="top:4px;"></i>--}}
{{--        </div>--}}
{{--    </a>--}}

    <div class="container clearfix">

        <div class="heading-block center border-bottom-0 bottommargin-lg">
            <h1>Galeri Foto</h1>
            <span>Kumpulan Hasil Dokumentasi Kegiatan Dalam Bentuk Foto</span>
        </div>

{{--        <div class="row justify-content-center col-mb-50">--}}
{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="heading-block fancy-title border-bottom-0 title-bottom-border">--}}
{{--                    <h4>Why choose <span>Us</span>.</h4>--}}
{{--                </div>--}}

{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi quidem minus id omnis, nam expedita, ea fuga commodi voluptas iusto, hic autem deleniti dolores explicabo labore enim repellat earum perspiciatis.</p>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="heading-block fancy-title border-bottom-0 title-bottom-border">--}}
{{--                    <h4>Our <span>Mission</span>.</h4>--}}
{{--                </div>--}}

{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi quidem minus id omnis, nam expedita, ea fuga commodi voluptas iusto, hic autem deleniti dolores explicabo labore enim repellat earum perspiciatis.</p>--}}
{{--            </div>--}}

{{--            <div class="col-sm-6 col-lg-4">--}}
{{--                <div class="heading-block fancy-title border-bottom-0 title-bottom-border">--}}
{{--                    <h4>What we <span>Do</span>.</h4>--}}
{{--                </div>--}}

{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi quidem minus id omnis, nam expedita, ea fuga commodi voluptas iusto, hic autem deleniti dolores explicabo labore enim repellat earum perspiciatis.</p>--}}
{{--            </div>--}}
{{--        </div>--}}

    </div>

    <div class="section mb-0">
        <div class="container">
            <!-- Bootstrap Select CSS -->
            <link rel="stylesheet" href="{{asset('css/components/bs-select.css')}}" type="text/css" />
            <div class="subscribe-widget mb-6" style="text-align: center" >
                <div class="widget-subscribe-form-result"></div>
                <form style="align-items: center; width: 100%" class="row">

                <div class="col-12 form-group">
                    <div class="row">
                        <div class="col-lg-2">
                            <label class="mt-2"> Tipe Pencarian</label>
                        </div>

                        <div class="col-lg-3">
                            {{ Form::select('kegiatan',['kelitbangan' => 'kelitbangan','inovasi' => 'inovasi'],null, ['title' => 'Pilih Tipe Pencarian','class' => 'form-control selectpicker', 'id' => 'inovasi_instansi_add', 'data-size' => '7', 'data-live-search' => 'true', 'data-toggle'=>'ajax']) }}
                        </div>
                        <div class="col-lg-2">
                            <label class="mt-2"> Data Pencarian</label>
                        </div>
                        <div class="col-lg-3">
                            <input type="text" name="nomor" id="fitness-form-name" class="form-control required" value="" placeholder="Data Pencarian">
                        </div>
                        <div class="col-lg-2">
                            <button class="btn btn-success"> <i class="fa fa-search"></i> Mulai Pencarian</button>
                        </div>
                    </div>
                </div>
                </form>
                <div class="divider divider-lg"></div>

            </div>

            <div class="grid-filter-wrap">
                <!-- Grid Filter
                ============================================= -->
{{--                <ul class="grid-filter" data-container="#portfolio">--}}

{{--                    <li class="activeFilter"><a href="#" data-filter="*">Show All</a></li>--}}
{{--                    <li><a href="#" data-filter=".pf-icons">Icons</a></li>--}}
{{--                    <li><a href="#" data-filter=".pf-illustrations">Illustrations</a></li>--}}
{{--                    <li><a href="#" data-filter=".pf-uielements">UI Elements</a></li>--}}
{{--                    <li><a href="#" data-filter=".pf-media">Media</a></li>--}}
{{--                    <li><a href="#" data-filter=".pf-graphics">Graphics</a></li>--}}

{{--                </ul><!-- .grid-filter end -->--}}

{{--                <div class="grid-shuffle" data-container="#portfolio">--}}
{{--                    <i class="icon-random"></i>--}}
{{--                </div>--}}

            </div>


            <!-- Portfolio Items
            ============================================= -->
            <div id="portfolio" class="portfolio row grid-container g-0" data-layout="fitRows">

                <!-- Portfolio Item: Start -->
                @foreach($data as $ind => $ft)
                    <article class="portfolio-item col-6 col-md-4 col-lg-3 pf-media pf-icons">
                        <div class="grid-inner">
                            <div class="portfolio-image">
                                <a href="portfolio-single.html">
                                    <img src="{{ asset($ft['url']) }}" alt="Open Imagination" style="height: 200px; width: 100%;">
                                </a>
                                <div class="bg-overlay">
                                    <div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
                                        <a href="{{ asset($ft['url']) }}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>
                                        <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>
                                    </div>
                                    <div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
                                </div>
                            </div>
                            <div class="portfolio-desc">
                                @php
                                  $title = '';
                                @endphp
                                @if($ft['kelitbangan_data'] != null)
                                    <h6><a href="/view-kelitbangan/{{ $ft['kelitbangan_id'] }}">{{ $ft['kelitbangan_data']['judul'] }}</a></h6>
                                @elseif($ft['inovasi_data'] != null)
                                    <h6><a href="/view-inovasi/{{ $ft['inovasi_id'] }}">{{ $ft['inovasi_data']['nama'] }}</a></h6>
                                @elseif($ft['agenda_data'] != null)
                                    <h6><a href="javascript:;">{{ $ft['agenda_data']['nama'] }}</a></h6>
                                @elseif($ft['berita_data'] != null)
                                    <h6><a href="/view-berita/{{ $ft['berita_id'] }}">{{ $ft['berita_data']['judul'] }}</a></h6>
                                @elseif($ft['usulan_penelitian_data'] != null)
                                    <h6><a href="/view-usulan-penelitian/{{ $ft['usulan_penelitian_id'] }}">{{ $ft['usulan_penelitian_data']['usulan'] }}</a></h6>
                                @elseif($ft['usulan_inovasi_data'] != null)
                                    <h6><a href="/view-usulan-inovasi/{{ $ft['usulan_inovasi_id'] }}">{{ $ft['usulan_inovasi_data']['usulan'] }}</a></h6>
                                @endif

{{--                                <span><a href="#">Media</a>, <a href="#">Icons</a></span>--}}
                            </div>
                        </div>
                    </article>
                @endforeach
                <!-- Portfolio Item: End -->

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-illustrations">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <a href="portfolio-single.html">--}}
{{--                                <img src="{{ asset('images/portfolio/4/2.jpg')}}" alt="Locked Steel Gate">--}}
{{--                            </a>--}}
{{--                            <div class="bg-overlay">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="images/portfolio/full/2.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>--}}
{{--                                    <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single.html">Locked Steel Gate</a></h3>--}}
{{--                            <span><a href="#">Illustrations</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-graphics pf-uielements">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <a href="#">--}}
{{--                                <img src="{{ asset('images/portfolio/4/3.jpg')}}" alt="Mac Sunglasses">--}}
{{--                            </a>--}}
{{--                            <div class="bg-overlay">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="https://vimeo.com/89396394" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>--}}
{{--                                    <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single-video.html">Mac Sunglasses</a></h3>--}}
{{--                            <span><a href="#">Graphics</a>, <a href="#">UI Elements</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-icons pf-illustrations">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <div class="fslider" data-arrows="false" data-speed="400" data-pause="4000">--}}
{{--                                <div class="flexslider">--}}
{{--                                    <div class="slider-wrap">--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/4.jpg')}}" alt="Morning Dew"></a></div>--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/4-1.jpg')}}" alt="Morning Dew"></a></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="bg-overlay" data-lightbox="gallery">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="images/portfolio/full/4.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>--}}
{{--                                    <a href="images/portfolio/full/4-1.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                    <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single-gallery.html">Morning Dew</a></h3>--}}
{{--                            <span><a href="#">Icons</a>, <a href="#">Illustrations</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-uielements pf-media">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <a href="portfolio-single.html">--}}
{{--                                <img src="{{ asset('images/portfolio/4/5.jpg')}}" alt="Console Activity">--}}
{{--                            </a>--}}
{{--                            <div class="bg-overlay">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="images/portfolio/full/5.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>--}}
{{--                                    <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single.html">Console Activity</a></h3>--}}
{{--                            <span><a href="#">UI Elements</a>, <a href="#">Media</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-graphics pf-illustrations">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <div class="fslider" data-arrows="false">--}}
{{--                                <div class="flexslider">--}}
{{--                                    <div class="slider-wrap">--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/6.jpg')}}" alt="Shake It"></a></div>--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/6-1.jpg')}}" alt="Shake It"></a></div>--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/6-2.jpg')}}" alt="Shake It"></a></div>--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/6-3.jpg')}}" alt="Shake It"></a></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="bg-overlay" data-lightbox="gallery">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="images/portfolio/full/6.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>--}}
{{--                                    <a href="images/portfolio/full/6-1.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                    <a href="images/portfolio/full/6-2.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                    <a href="images/portfolio/full/6-3.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                    <a href="portfolio-single-gallery.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single-gallery.html">Shake It!</a></h3>--}}
{{--                            <span><a href="#">Illustrations</a>, <a href="#">Graphics</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-uielements pf-icons">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <a href="portfolio-single-video.html">--}}
{{--                                <img src="{{ asset('images/portfolio/4/7.jpg')}}" alt="Backpack Contents">--}}
{{--                            </a>--}}
{{--                            <div class="bg-overlay">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="https://www.youtube.com/watch?v=kuceVNBTJio" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>--}}
{{--                                    <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single-video.html">Backpack Contents</a></h3>--}}
{{--                            <span><a href="#">UI Elements</a>, <a href="#">Icons</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-graphics">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <a href="portfolio-single.html">--}}
{{--                                <img src="{{ asset('images/portfolio/4/8.jpg')}}" alt="Sunset Bulb Glow">--}}
{{--                            </a>--}}
{{--                            <div class="bg-overlay">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="images/portfolio/full/8.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>--}}
{{--                                    <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single.html">Sunset Bulb Glow</a></h3>--}}
{{--                            <span><a href="#">Graphics</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-illustrations pf-icons">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <div class="fslider" data-arrows="false" data-speed="650" data-pause="3500" data-animation="fade">--}}
{{--                                <div class="flexslider">--}}
{{--                                    <div class="slider-wrap">--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/9.jpg')}}" alt="Bridge Side"></a></div>--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/9-1.jpg')}}" alt="Bridge Side"></a></div>--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/9-2.jpg')}}" alt="Bridge Side"></a></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="bg-overlay" data-lightbox="gallery">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="images/portfolio/full/9.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>--}}
{{--                                    <a href="images/portfolio/full/9-1.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                    <a href="images/portfolio/full/9-2.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                    <a href="portfolio-single-gallery.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single.html">Bridge Side</a></h3>--}}
{{--                            <span><a href="#">Illustrations</a>, <a href="#">Icons</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-graphics pf-media pf-uielements">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <a href="portfolio-single-video.html">--}}
{{--                                <img src="{{ asset('images/portfolio/4/10.jpg')}}" alt="Study Table">--}}
{{--                            </a>--}}
{{--                            <div class="bg-overlay">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="https://vimeo.com/91973305" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="iframe"><i class="icon-line-play"></i></a>--}}
{{--                                    <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single-video.html">Study Table</a></h3>--}}
{{--                            <span><a href="#">Graphics</a>, <a href="#">Media</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-media pf-icons">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <a href="portfolio-single.html">--}}
{{--                                <img src="{{ asset('images/portfolio/4/11.jpg')}}" alt="Workspace Stuff">--}}
{{--                            </a>--}}
{{--                            <div class="bg-overlay">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="images/portfolio/full/11.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="image" title="Image"><i class="icon-line-plus"></i></a>--}}
{{--                                    <a href="portfolio-single.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single.html">Workspace Stuff</a></h3>--}}
{{--                            <span><a href="#">Media</a>, <a href="#">Icons</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

{{--                <article class="portfolio-item col-lg-3 col-md-4 col-sm-6 col-12 pf-illustrations pf-graphics">--}}
{{--                    <div class="grid-inner">--}}
{{--                        <div class="portfolio-image">--}}
{{--                            <div class="fslider" data-arrows="false" data-speed="700" data-pause="7000">--}}
{{--                                <div class="flexslider">--}}
{{--                                    <div class="slider-wrap">--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/12.jpg')}}" alt="Fixed Aperture"></a></div>--}}
{{--                                        <div class="slide"><a href="portfolio-single-gallery.html"><img src="{{ asset('images/portfolio/4/12-1.jpg')}}" alt="Fixed Aperture"></a></div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="bg-overlay" data-lightbox="gallery">--}}
{{--                                <div class="bg-overlay-content dark" data-hover-animate="fadeIn">--}}
{{--                                    <a href="images/portfolio/full/12.jpg" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>--}}
{{--                                    <a href="images/portfolio/full/12-1.jpg" class="d-none" data-lightbox="gallery-item"></a>--}}
{{--                                    <a href="portfolio-single-gallery.html" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350"><i class="icon-line-ellipsis"></i></a>--}}
{{--                                </div>--}}
{{--                                <div class="bg-overlay-bg dark" data-hover-animate="fadeIn"></div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="portfolio-desc">--}}
{{--                            <h3><a href="portfolio-single-gallery.html">Fixed Aperture</a></h3>--}}
{{--                            <span><a href="#">Illustrations</a>, <a href="#">Graphics</a></span>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </article>--}}

            </div><!-- #portfolio end -->

        </div>
    </div>

{{--    <div id="oc-clients-full" class="owl-carousel owl-carousel-full image-carousel footer-stick carousel-widget" data-margin="30" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false"data-items-xs="3" data-items-sm="4" data-items-md="5" data-items-lg="6" data-items-xl="7" style="padding: 30px 0;">--}}

{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/1.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/2.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/3.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/4.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/5.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/6.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/7.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/8.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/9.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/10.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/11.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/12.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/13.png')}}" alt="Clients"></a></div>--}}
{{--        <div class="oc-item"><a href="http://logofury.com/"><img src="{{ asset('images/clients/14.png')}}" alt="Clients"></a></div>--}}

{{--    </div>--}}


</div>
@endsection
@push('custom-scripts')
    <script src="{{ asset('js/components/bs-select.js') }}"></script>

@endpush
