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
            <div class="postcontent col-lg-12">

                <!-- Posts
                ============================================= -->
                <div id="posts_berita" class="row grid-container gutter-40">
                  @foreach($data as $brt => $b)
                    <div class="entry col-3">
                        <div class=" row g-0">
                            <div class="col-12">
                                <div class="entry-image">
                                    <a href="https://themeforest.net" class="entry-link" target="_blank" >
                                        <img src="{{ asset('/images/blog/grid/3.jpg') }} " style="width: 100%; ">
{{--                                        {{ $b['judul'] }}--}}
                                    </a>
                                </div>
                                <div class="entry-title title-sm">
                                    <h3><a href="/view-berita/{{ $b['id'] }}">{{ $b['judul'] }}</a></h3>
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li><i class="icon-calendar3"></i> {{$b['tanggal']}}</li>
{{--                                        <li><a href="#"><i class="icon-user"></i> admin</a></li>--}}
                                        <li><i class="icon-folder-open"></i> <a href="#">Links</a>, <a href="#">Suggestions</a></li>
{{--                                        <li><a href="blog-single.html#comments"><i class="icon-comments"></i> 26</a></li>--}}
{{--                                        <li><a href="#"><i class="icon-link"></i></a></li>--}}
                                    </ul>
                                </div>
{{--                                <div class="entry-content">--}}
{{--                                    <p>{{ substr($b['deskripsi'],0,60)  }} ...</p>--}}
{{--                                    <a href="/view-berita/{{ $b['id'] }}" class="more-link">Read More</a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div><!-- #posts end -->

                <!-- Pager
                ============================================= -->
                <div class="d-flex justify-content-between mt-5">
{{--                    {{ $data->links() }}--}}
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

