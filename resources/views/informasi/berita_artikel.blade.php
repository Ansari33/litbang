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

{{--                </ul>--}}
                <!-- .grid-filter end -->

                <div class="grid-shuffle flex-row-reverse" data-container="#portfolio" id="data-kotak">
                    <i class="icon-list"></i>
                </div>
                <div class="grid-shuffle flex-row-reverse" data-container="#portfolio" id="data-tabel">
                    <i class="icon-table"></i>
                </div>
            </div>
            <!-- Post Content
            ============================================= -->
            <div class="postcontent col-lg-12">

                <!-- Posts
                ============================================= -->
                <div id="posts_berita" class="row grid-container gutter-40">
                    @foreach($data as $brt => $b)
                        <div class="entry col-4">
                            <div class=" row g-0">
                                <div class="col-12">
                                    <div class="entry-image">
                                        <a href="javascript:;" class="entry-link" target="_blank" >
                                            @if($b['attachment'] != null)
                                                <img src="{{ asset($b['attachment'][0]['url']) }} " style="height: 200px; ">
                                            @else
                                                <img src="{{ asset('/images/services/ipad.png') }} " style="width: 100%; ">
                                            @endif
                                            {{--                                        {{ $b['judul'] }}--}}
                                        </a>
                                    </div>
                                    <div class="entry-title title-sm">
                                        <h5><a href="/view-berita/{{ $b['id'] }}">{{ $b['judul'] }}</a></h5>
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
                    {{ $data->links() }}
                </div>
                <!-- .pager end -->
            </div><!-- .postcontent end -->
        </div>
    </div>
</div>

@endsection
@push('custom-scripts')
    <script>

        $(function () {
            $('#posts_berita').html($('#berita-kotak').html());
            $('.w-5').css('display','none')
            $('.z-0').css('display','none')
        })

    </script>
@endpush

