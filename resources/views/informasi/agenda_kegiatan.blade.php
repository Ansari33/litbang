@extends('layout')
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="position-relative">

                <div class="timeline-border"></div>

                <!-- Posts
                ============================================= -->
                <div id="posts_agenda" class="post-grid grid-container row post-timeline col-mb-50" data-basewidth=".entry:not(.entry-date-section):eq(0)" >

                    <div class="entry entry-date-section col-12 mb-3"><span>Agenda Kegiatan</span></div>
{{--                    <div class="clear topmargin-sm"></div>--}}
                    <ol class="commentlist border-0 m-0 p-0 clearfix">
                        @foreach($data as $dt => $d)
                           @if(fmod(($dt + 1),2) == 1)
                            <li class="comment even thread-even depth-1" id="li-comment-1">
                            <div id="comment-1" class="comment-wrap clearfix" style="width: 47%;">
                                <div class="comment-meta">
                                    <div class="comment-author vcard">
                                        <span class="comment-avatar clearfix">
                                        <img alt='Image' src='https://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=60&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G' class='avatar avatar-60 photo' height='60' width='60' />
                                        </span>
                                    </div>
                                </div>
                                <div class="comment-content clearfix">
                                    <div class="comment-author">{{ $d['nama'] }}<span><a href="#" title="Permalink to this comment">{{ $d['tanggal'] }} at {{ $d['waktu'] }}</a></span></div>
                                    <p>{{ $d['tempat'] }}</p>
                                    <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                </div>
                                <div class="clear"></div>
                            </div >

                        </li>
                           @elseif(fmod(($dt + 1),2) == 0)
                            <li class="comment byuser comment-author-_smcl_admin even thread-odd thread-alt depth-1" id="li-comment-2">
                            <div class="comment-wrap clearfix" style="margin-left: 52%; margin-top: -100px;">
                                <div class="comment-meta">
                                    <div class="comment-author vcard">
                                        <span class="comment-avatar clearfix">
                                        <img alt='Image' src='https://1.gravatar.com/avatar/30110f1f3a4238c619bcceb10f4c4484?s=60&amp;d=http%3A%2F%2F1.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D60&amp;r=G' class='avatar avatar-60 photo' height='60' width='60' />
                                        </span>
                                    </div>
                                </div>
                                <div class="comment-content clearfix">
                                    <div class="comment-author"><a href='https://themeforest.net/user/semicolonweb' rel='external nofollow' class='url'>{{ $d['nama'] }}</a><span><a href="#" title="Permalink to this comment">{{ $d['tanggal'] }} at {{ $d['waktu'] }}</a></span></div>

                                    <p>{{ $d['tempat'] }}</p>

                                    <a class='comment-reply-link' href='#'><i class="icon-reply"></i></a>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </li>
                           @endif
                        @endforeach

                    </ol>

                </div><!-- #posts end -->

            </div>

        </div>
    </div>

@endsection
@push('custom-scripts')
    <script>
        $(function () {
           // loadAgenda();
        })
    </script>

@endpush

