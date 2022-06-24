@extends('layout')
@section('content')
<div class="content-wrap">

{{--    <a href="#" class="button button-full button-purple center text-end header-stick bottommargin-lg">--}}
{{--        <div class="container clearfix">--}}
{{--            Canvas comes with Unlimited Customizations &amp; Options. <strong>Check Out</strong> <i class="icon-caret-right" style="top:4px;"></i>--}}
{{--        </div>--}}
{{--    </a>--}}

    <div class="container clearfix">

        <div class="heading-block center">
            <h1>Berita & Artikel</h1>
            <span>Daftar Berita dan Artikel Tentang Kota.</span>
        </div>

        <div class="row gutter-40 col-mb-80">
            <!-- Post Content
            ============================================= -->
            <div class="postcontent col-lg-10">

                <!-- Posts
                ============================================= -->
                <div id="posts_berita" class="row grid-container gutter-40">
                  @foreach($data as $brt => $b)
                    <div class="entry col-6">
                        <div class="grid-inner row g-0">
                            <div class="col-12">
                                <div class="entry-image">
                                    <a href="https://themeforest.net" class="entry-link" target="_blank" >
                                        <img src="{{ asset('/images/blog/grid/3.jpg') }} " style="width: 100%; ">
{{--                                        {{ $b['judul'] }}--}}
                                    </a>
                                </div>
                                <div class="entry-title title-sm">
                                    <h2><a href="blog-single.html">{{ $b['judul'] }}</a></h2>
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li><i class="icon-calendar3"></i> {{$b['tanggal']}}</li>
                                        <li><a href="#"><i class="icon-user"></i> admin</a></li>
                                        <li><i class="icon-folder-open"></i> <a href="#">Links</a>, <a href="#">Suggestions</a></li>
                                        <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 26</a></li>
                                        <li><a href="#"><i class="icon-link"></i></a></li>
                                    </ul>
                                </div>
                                <div class="entry-content">
                                    <p>{{ $b['deskripsi'] }}</p>
                                    <a href="blog-single.html" class="more-link">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach

{{--                    <div class="entry col-12">--}}
{{--                        <div class="grid-inner row g-0">--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="entry-image">--}}
{{--                                    <div class="card">--}}
{{--                                        <div class="card-body">--}}
{{--                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quia, fuga optio voluptatibus saepe tenetur aliquam debitis eos accusantium! Vitae, hic, atque aliquid repellendus accusantium laudantium minus eaque quibusdam ratione sapiente.--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="entry-meta">--}}
{{--                                    <ul>--}}
{{--                                        <li><i class="icon-calendar3"></i> 21st Mar 2021</li>--}}
{{--                                        <li><a href="#"><i class="icon-user"></i> admin</a></li>--}}
{{--                                        <li><i class="icon-folder-open"></i> <a href="#">Status</a>, <a href="#">News</a></li>--}}
{{--                                        <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 11</a></li>--}}
{{--                                        <li><a href="#"><i class="icon-align-justify2"></i></a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="entry col-12">--}}
{{--                        <div class="grid-inner row g-0">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="entry-image">--}}
{{--                                    <iframe src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/301161123&amp;auto_play=false&amp;hide_related=true&amp;visual=true"></iframe>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-8 ps-md-4">--}}
{{--                                <div class="entry-title title-sm">--}}
{{--                                    <h2><a href="blog-single.html">This is an Embedded Audio Post</a></h2>--}}
{{--                                </div>--}}
{{--                                <div class="entry-meta">--}}
{{--                                    <ul>--}}
{{--                                        <li><i class="icon-calendar3"></i> 28th Apr 2021</li>--}}
{{--                                        <li><a href="#"><i class="icon-user"></i> admin</a></li>--}}
{{--                                        <li><i class="icon-folder-open"></i> <a href="#">Audio</a>, <a href="#">General</a></li>--}}
{{--                                        <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 16</a></li>--}}
{{--                                        <li><a href="#"><i class="icon-music2"></i></a></li>--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                                <div class="entry-content">--}}
{{--                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, voluptatem, dolorem animi nisi autem blanditiis enim culpa reiciendis et explicabo tenetur voluptate rerum molestiae eaque possimus exercitationem eligendi fuga.</p>--}}
{{--                                    <a href="blog-single.html" class="more-link">Read More</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div><!-- #posts end -->

                <!-- Pager
                ============================================= -->
                <div class="d-flex justify-content-between mt-5">
                    @if($page != 0)
                    <a href="/informasi-berita-artikel/{{ $page }}" class="btn btn-outline-secondary">&larr; Older</a>
                    @endif
                    <a href="/informasi-berita-artikel/{{ $page + 1 }}" class="btn btn-outline-dark">Newer &rarr;</a>
                </div>
                <!-- .pager end -->

            </div><!-- .postcontent end -->

        </div>

    </div>
</div>
@endsection
@push('custom-scripts')
    <script>
        // $(function () {
        //     loadBerita();
        // })
    </script>
@endpush

