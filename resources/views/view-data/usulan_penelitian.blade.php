@extends('layout')
@section('title')
    Detail Usulan Penelitian
@endsection
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row align-items-center mw-sm mx-auto g-0">
                <div class="col-lg-2">

                </div>
                <div class="col-lg-10 row">
                    
                </div>
                <div class="col-12">
                    <div class="feature-box fbox-effect fbox-xl">
                        <div class="fbox-icon me-3">
                            <a href="#"><img src="{{asset('/images/intro/targets/shortcodes/tooltip.png')}}" alt="Feature Icon" class="bg-transparent rounded-0" style="width: 70px; height: 70px;"></a>
                        </div>
                        <div class="fbox-content">
                            <h3>Judul</h3>
                            <p>{{ $data['usulan'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="line my-5"></div>
                <div class="col-12">
                    <div class="feature-box fbox-effect fbox-xl">
                        <div class="fbox-icon me-3">
                            <a href="#"><img src="{{asset('/images/intro/targets/shortcodes/clients.png')}}" alt="Feature Icon" class="bg-transparent rounded-0" style="width: 70px; height: 70px;"></a>
                        </div>
                        <div class="fbox-content">
                            <h3>Pengusul</h3>
                            <p>{{ $data['pengusul'] }}</p>
                        </div>
                    </div>
                </div>

                <div class="line my-5"></div>
                <div class="col-12">
                    <div class="feature-box fbox-effect fbox-xl">
                        <div class="fbox-icon me-3">
                            <a href="#"><img src="{{asset('/images/intro/targets/shortcodes/posts.png')}}" alt="Feature Icon" class="bg-transparent rounded-0" style="width: 70px; height: 70px;"></a>
                        </div>
                        <div class="fbox-content">
                            <h3>Latar Belakang</h3>
                            <p>{{ $data['latar_belakang'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="line my-5"></div>
                <div class="col-12">
                    <div class="feature-box fbox-effect fbox-xl">
                        <div class="fbox-icon me-3">
                            <a href="#"><img src="{{asset('/images/intro/targets/shortcodes/animation.png')}}" alt="Feature Icon" class="bg-transparent rounded-0" style="width: 70px; height: 70px;"></a>
                        </div>
                        <div class="fbox-content">
                            <h3>Tujuan</h3>
                            <p>{{ $data['tujuan'] }}</p>

                        </div>
                    </div>
                </div>
                <div class="line my-5"></div>
                <div class="col-12">
                    <div class="feature-box fbox-effect fbox-xl">
                        <div class="fbox-icon me-1">
                            <a href="#"><img src="{{asset('/images/intro/targets/shortcodes/progress-bars.png')}}" alt="Feature Icon" class="bg-transparent rounded-0" style="width: 70px; height: 70px;"></a>
                        </div>
                        <div class="fbox-content">
                            <h3>Status</h3>
                            <p>{{ $data['status'] }}</p>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>

    </script>
@endpush
