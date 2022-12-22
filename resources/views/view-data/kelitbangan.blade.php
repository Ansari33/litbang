@extends('layout')
@section('title')
    Detail Kelitbangan
@endsection
@section('content')

<div class="content-wrap">
    <div class="container clearfix">

        <div class="row clearfix">

            <div class="col-md-9">

{{--                <img src="images/icons/avatar.jpg" class="alignleft img-circle img-thumbnail my-0" alt="Avatar" style="max-width: 84px;">--}}

                <div class="heading-block border-0">
                    <h3>{{ $data['judul'] }}</h3>
{{--                    <span>Your Profile Bio</span>--}}
                </div>

                <div class="clear"></div>

                <div class="row clearfix">

                    <div class="col-lg-12">

                        <div class="tabs tabs-alt clearfix" id="tabs-profile">

                            <ul class="tab-nav clearfix">
                                <li><a href="#tab-feeds"><i class="icon-users"></i> Pelaksana</a></li>
                                <li><a href="#tab-posts"><i class="icon-pencil2"></i> Abstrak</a></li>
                                <li><a href="#tab-replies"><i class="icon-reply"></i> Tindak Lanjut</a></li>
                                <li><a href="#tab-connections"><i class="icon-files"></i> Kelengkapan</a></li>
                            </ul>

                            <div class="tab-container">

                                <div class="tab-content clearfix" id="tab-feeds">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Nama</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($data['pelaksana'] as $index => $p)
                                        <tr>
                                            <td style="width: 5%;">
                                                <code>{{ $index + 1}}</code>
                                            </td>
                                            <td style="width: 95%;">{{ $p['nama'] }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>

                                </div>
                                <div class="tab-content clearfix" id="tab-posts">

                                    <p>{{ $data['abstrak'] }}</p>

                                </div>
                                <div class="tab-content clearfix" id="tab-replies">

                                    <p>{{ $data['tindak_lanjut'] }}</p>

                                </div>
                                <div class="tab-content clearfix" id="tab-connections">

                                    <div class="row topmargin-sm">
                                        @foreach($data['attachment'] as $att => $at)
                                        <div class="col-lg-3 col-md-6 bottommargin">
                                                <a href="/files-attachment/laporan-kelitbangan/{{ $at['nama'] }}" class="social-icon inline-block si-small si-light si-rounded si-gplus">
                                                    <i class="fa fa-download "></i><span>{{ $at['nama'] }}</span>
                                                </a>
                                        </div>
                                        @endforeach
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="w-100 line d-block d-md-none"></div>

            <div class="col-md-3">

                <div class="list-group">
                    @foreach($kelitbangan as $idx => $kl)
                    <a href="/view-kelitbangan/{{ $kl['id'] }}" class="list-group-item list-group-item-action d-flex justify-content-between"><div>{{ $kl['judul'] }}</div><i class="icon-file"></i></a>
                    @endforeach
                </div>

{{--                <div class="fancy-title topmargin title-border">--}}
{{--                    <h4>About Me</h4>--}}
{{--                </div>--}}

{{--                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum laboriosam, dignissimos veniam obcaecati. Quasi eaque, odio assumenda porro explicabo laborum!</p>--}}

{{--                <div class="fancy-title topmargin title-border">--}}
{{--                    <h4>Social Profiles</h4>--}}
{{--                </div>--}}

{{--                <a href="#" class="social-icon si-facebook si-small si-rounded si-light" title="Facebook">--}}
{{--                    <i class="icon-facebook"></i>--}}
{{--                    <i class="icon-facebook"></i>--}}
{{--                </a>--}}

{{--                <a href="#" class="social-icon si-gplus si-small si-rounded si-light" title="Google+">--}}
{{--                    <i class="icon-gplus"></i>--}}
{{--                    <i class="icon-gplus"></i>--}}
{{--                </a>--}}

{{--                <a href="#" class="social-icon si-dribbble si-small si-rounded si-light" title="Dribbble">--}}
{{--                    <i class="icon-dribbble"></i>--}}
{{--                    <i class="icon-dribbble"></i>--}}
{{--                </a>--}}

{{--                <a href="#" class="social-icon si-flickr si-small si-rounded si-light" title="Flickr">--}}
{{--                    <i class="icon-flickr"></i>--}}
{{--                    <i class="icon-flickr"></i>--}}
{{--                </a>--}}

{{--                <a href="#" class="social-icon si-linkedin si-small si-rounded si-light" title="LinkedIn">--}}
{{--                    <i class="icon-linkedin"></i>--}}
{{--                    <i class="icon-linkedin"></i>--}}
{{--                </a>--}}

{{--                <a href="#" class="social-icon si-twitter si-small si-rounded si-light" title="Twitter">--}}
{{--                    <i class="icon-twitter"></i>--}}
{{--                    <i class="icon-twitter"></i>--}}
{{--                </a>--}}

            </div>

        </div>

    </div>
</div>
@endsection
@push('custom-scripts')
    <script>

    </script>
@endpush
