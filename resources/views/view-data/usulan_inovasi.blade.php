@extends('layout')
@section('title')
    Detail Usulan Inovasi
@endsection
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row gutter-40 col-mb-80">
                <!-- Post Content
                ============================================= -->
                <div class="postcontent col-lg-9">
                    <div class="row">
                        <div class="col-md-7">
                            <h3>Judul Usulan Inovasi</h3>
                            <div data-readmore="true" data-readmore-trigger-open="Read More <i class='icon-angle-down'></i>" data-readmore-trigger-close="Read Less <i class='icon-angle-up'></i>">

                                <p>{{ $data['usulan'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h3>Pengusul Inovasi</h3>
                            <div data-readmore="true" data-readmore-trigger-open="Read More <i class='icon-angle-down'></i>" data-readmore-trigger-close="Read Less <i class='icon-angle-up'></i>">
                                <p>{{ $data['pengusul'] }}</p>
                            </div>
                        </div>
                    </div>

                    <h3>Latar Belakang</h3>
                    <div data-readmore="true"  data-readmore-trigger-open="<i class='icon-angle-down i-plain i-large m-0 float-none'></i>" data-readmore-trigger-close="<i class='icon-angle-up i-plain i-large m-0 float-none'></i>">

                        <p>{{ $data['latar_belakang'] }}</p>

                    </div>

                    <div class="line my-5"></div>

                    <h3>Tujuan</h3>
                    <div data-readmore="true"  data-readmore-trigger-open="<i class='icon-angle-down i-plain i-large m-0 float-none'></i>" data-readmore-trigger-close="<i class='icon-angle-up i-plain i-large m-0 float-none'></i>">

                        <p>{{ $data['tujuan'] }}</p>

                    </div>

                    <div class="line my-5"></div>

                    <h3>Status</h3>
                    <p>{{ $data['status'] }}</p>
                    <div class="line my-5"></div>

{{--                    <h3>Custom Height</h3>--}}
{{--                    <div data-readmore="true" data-readmore-size="6rem" data-readmore-trigger-open="<i class='icon-line-plus'></i>" data-readmore-trigger-close="<i class='icon-line-minus'></i>">--}}

{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ullam aliquid quos, tempore, quibusdam saepe numquam fugiat ab perspiciatis minima itaque in repellendus ad, modi voluptates quas distinctio iusto nesciunt. Esse, maxime dolorem distinctio quibusdam doloribus reiciendis sint obcaecati ex impedit ea non nam eos voluptate quod recusandae provident, unde libero, vel laudantium hic a. Ea amet, maxime voluptatibus distinctio temporibus libero cupiditate deserunt, facere rem, alias similique mollitia possimus asperiores cum harum at doloribus sed voluptas ipsam. Accusamus adipisci at sint voluptas unde deserunt incidunt excepturi perferendis quae similique laudantium voluptatibus quo sed perspiciatis autem quis hic, aut pariatur iste aliquid, veniam suscipit doloribus aliquam praesentium.</p>--}}

{{--                        <p class="mb-0">Maxime quos, ex eligendi possimus earum amet, voluptatibus tempore asperiores officia, blanditiis non adipisci labore deleniti. Aliquam perferendis cumque maxime necessitatibus ut consequuntur, alias, error, inventore pariatur, quisquam eius impedit dolores recusandae enim harum! Saepe vel optio nemo id magni tempore repudiandae quod ullam, quia reprehenderit incidunt ipsum natus cum quidem? Provident, a ut.</p>--}}

{{--                        <a href="#" class="btn btn-danger read-more-trigger"></a>--}}

{{--                    </div>--}}

{{--                    <div class="line my-5"></div>--}}

{{--                    <h3>No Mask</h3>--}}
{{--                    <div data-readmore="true" data-readmore-mask="false" data-readmore-trigger-open="Read More <i class='icon-angle-down'></i>" data-readmore-trigger-close="Read Less <i class='icon-angle-up'></i>">--}}

{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ullam aliquid quos, tempore, quibusdam saepe numquam fugiat ab perspiciatis minima itaque in repellendus ad, modi voluptates quas distinctio iusto nesciunt. Esse, maxime dolorem distinctio quibusdam doloribus reiciendis sint obcaecati ex impedit ea non nam eos voluptate quod recusandae provident, unde libero, vel laudantium hic a. Ea amet, maxime voluptatibus distinctio temporibus libero cupiditate deserunt, facere rem, alias similique mollitia possimus asperiores cum harum at doloribus sed voluptas ipsam. Accusamus adipisci at sint voluptas unde deserunt incidunt excepturi perferendis quae similique laudantium voluptatibus quo sed perspiciatis autem quis hic, aut pariatur iste aliquid, veniam suscipit doloribus aliquam praesentium.</p>--}}

{{--                        <p class="mb-0">Maxime quos, ex eligendi possimus earum amet, voluptatibus tempore asperiores officia, blanditiis non adipisci labore deleniti. Aliquam perferendis cumque maxime necessitatibus ut consequuntur, alias, error, inventore pariatur, quisquam eius impedit dolores recusandae enim harum! Saepe vel optio nemo id magni tempore repudiandae quod ullam, quia reprehenderit incidunt ipsum natus cum quidem? Provident, a ut.</p>--}}

{{--                        <a href="#" class="btn btn-secondary read-more-trigger"></a>--}}

{{--                    </div>--}}

{{--                    <div class="line my-5"></div>--}}

{{--                    <h3>with Shortcodes</h3>--}}
{{--                    <div data-readmore="true" data-readmore-trigger-open="Read More <i class='icon-angle-down'></i>" data-readmore-trigger-close="Read Less <i class='icon-angle-up'></i>">--}}

{{--                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ullam aliquid quos, tempore, quibusdam saepe numquam fugiat ab perspiciatis minima itaque in repellendus ad, modi voluptates quas distinctio iusto nesciunt. Esse, maxime dolorem distinctio quibusdam doloribus reiciendis sint obcaecati ex impedit ea non nam eos voluptate quod recusandae provident, unde libero, vel laudantium hic a.</p>--}}

{{--                        <div class="masonry-thumbs grid-container grid-4" data-big="3" data-lightbox="gallery">--}}
{{--                            <a class="grid-item" href="images/portfolio/full/1.jpg" data-lightbox="gallery-item"><img src="images/portfolio/4/1.jpg" alt="Gallery Thumb 1"></a>--}}
{{--                            <a class="grid-item" href="images/portfolio/full/2.jpg" data-lightbox="gallery-item"><img src="images/portfolio/4/2.jpg" alt="Gallery Thumb 2"></a>--}}
{{--                            <a class="grid-item" href="images/portfolio/full/3.jpg" data-lightbox="gallery-item"><img src="images/portfolio/4/3.jpg" alt="Gallery Thumb 3"></a>--}}
{{--                            <a class="grid-item" href="images/portfolio/full/4.jpg" data-lightbox="gallery-item"><img src="images/portfolio/4/4.jpg" alt="Gallery Thumb 4"></a>--}}
{{--                            <a class="grid-item" href="images/portfolio/full/5.jpg" data-lightbox="gallery-item"><img src="images/portfolio/4/5.jpg" alt="Gallery Thumb 5"></a>--}}
{{--                        </div>--}}

{{--                        <a href="#" class="btn btn-primary btn-sm read-more-trigger"></a>--}}

{{--                    </div>--}}

                </div><!-- .postcontent end -->

                <!-- Sidebar
                ============================================= -->
                <div class="sidebar col-lg-3">
                    <div class="sidebar-widgets-wrap">

                        <div class="widget clearfix">

                            <h4>Usulan Inovasi Lain</h4>
                            <div class="posts-sm row col-mb-30" id="post-list-sidebar">
                                @foreach($usulan_lain as $us => $ul)
                                <div class="entry col-12">
                                    <div class="grid-inner row g-0">
                                        <div class="col-auto">
                                            <div class="entry-image">
                                                <a href=":;"><img src="{{asset('images/magazine/small/3.jpg')}}" alt="Image"></a>
                                            </div>
                                        </div>
                                        <div class="col ps-3">
                                            <div class="entry-title">
                                                <h4><a href="/view-usulan-inovasi/{{ $ul['id'] }}">{{ $ul['usulan'] }}</a></h4>
                                            </div>
                                            <div class="entry-meta">
                                                <ul>
                                                    <li>{{ $ul['tanggal'] }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>

                        <div class="widget clearfix">

                            <h4>Embed Videos</h4>
                            <iframe src="//player.vimeo.com/video/103927232" width="500" height="250" allow="autoplay; fullscreen" allowfullscreen></iframe>

                        </div>

                    </div>
                </div><!-- .sidebar end -->
            </div>

        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>

    </script>
@endpush
