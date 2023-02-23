@extends('layout')
@section('title')
    Detail Inovasi
@endsection
@section('content')
    <div class="content-wrap">
        <div class="container clearfix">

            <div class="row col-mb-50">
                <div class="col-md-9">
                    <div class="fancy-title title-bottom-border">
                        <h3>Nama Inovasi</h3>
                    </div>

                    <p>{{ $data['nama'] }}</p>

                    <div class="divider divider-sm"></div>

                    <div class="fancy-title title-bottom-border">
                        <h3>Pelaksana</h3>
                    </div>

                    <p></p>

                    <div class="accordion accordion-bg">

                        <div class="accordion-header">
                            <div class="accordion-icon">
                                <i class="accordion-open icon-remove-circle"></i>
                                <i class="accordion-closed icon-ok-circle"></i>
                            </div>
                            <div class="accordion-title">
                                Daftar Nama Pelaksana
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="iconlist iconlist-color mb-0">
                                @foreach($data['pelaksana'] as $item => $p)
                                <li><i class="icon-user"></i>{{ $p['nama'] }}</li>
                                @endforeach

                            </ul>
                        </div>

                    </div>


                    <div class="divider divider-sm"></div>

                    <div class="fancy-title title-bottom-border">
                        <h3>Rancang Bangun</h3>
                    </div>

                    <p>{{ $data['rancang_bangun'] }}</p>

                    <div class="divider divider-sm"></div>

                    <div class="fancy-title title-bottom-border">
                        <h3>Tujuan</h3>
                    </div>

                    <p>{{ $data['tujuan'] }}</p>

                    <div class="divider divider-sm"></div>

                    <div class="fancy-title title-bottom-border">
                        <h3>Manfaat</h3>
                    </div>

                    <p>{{ $data['manfaat'] }}</p>

                    <div class="divider divider-sm"></div>

                    <div class="fancy-title title-bottom-border">
                        <h3>Hasil</h3>
                    </div>

                    <p> {{ $data['hasil'] }}</p>
                    <div class="divider divider-sm"></div>

                    <div class="fancy-title title-bottom-border">
                        <h3>Deskripsi</h3>
                    </div>

                    <p> {{ $data['deskripsi'] }}</p>
                    <div class="divider divider-sm"></div>

                    <div class="fancy-title title-bottom-border">
                        <h3>Pedoman Teknis</h3>
                    </div>

                    <p> <a href="{{ $data['kelengkapan'] }}" target="_blank">{{ $data['kelengkapan'] }}</a></p>
                    <div class="divider divider-sm"></div>

                </div>

                <div class="col-md-3">
                    <div id="job-apply" class="heading-block highlight-me">
                        <h4>Inovasi Lain</h4>
{{--                        <span>And we'll get back to you within 48 hours.</span>--}}
                    </div>

{{--                    <div class="form-widget">--}}
{{--                        <div class="form-result"></div>--}}

{{--                        <form action="include/form.php" id="template-jobform" name="template-jobform" class="row mb-0" method="post">--}}

{{--                            <div class="form-process">--}}
{{--                                <div class="css3-spinner">--}}
{{--                                    <div class="css3-spinner-scaler"></div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6 form-group">--}}
{{--                                <label for="template-jobform-fname">First Name <small>*</small></label>--}}
{{--                                <input type="text" id="template-jobform-fname" name="template-jobform-fname" value="" class="sm-form-control required" />--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6 form-group">--}}
{{--                                <label for="template-jobform-lname">Last Name <small>*</small></label>--}}
{{--                                <input type="text" id="template-jobform-lname" name="template-jobform-lname" value="" class="sm-form-control required" />--}}
{{--                            </div>--}}

{{--                            <div class="w-100"></div>--}}

{{--                            <div class="col-12 form-group">--}}
{{--                                <label for="template-jobform-email">Email <small>*</small></label>--}}
{{--                                <input type="email" id="template-jobform-email" name="template-jobform-email" value="" class="required email sm-form-control" />--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6 form-group">--}}
{{--                                <label for="template-jobform-age">Age <small>*</small></label>--}}
{{--                                <input type="text" name="template-jobform-age" id="template-jobform-age" value="" size="22" tabindex="4" class="sm-form-control required" />--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6 form-group">--}}
{{--                                <label for="template-jobform-city">City <small>*</small></label>--}}
{{--                                <input type="text" name="template-jobform-city" id="template-jobform-city" value="" size="22" tabindex="5" class="sm-form-control required" />--}}
{{--                            </div>--}}

{{--                            <div class="w-100"></div>--}}

{{--                            <div class="col-12 form-group">--}}
{{--                                <label for="template-jobform-service">Position <small>*</small></label>--}}
{{--                                <select name="template-jobform-position" id="template-jobform-position"  tabindex="9" class="sm-form-control required">--}}
{{--                                    <option value="">-- Select Position --</option>--}}
{{--                                    <option value="Senior Python Developer">Senior Python Developer</option>--}}
{{--                                    <option value="Design Analyst">Design Analyst</option>--}}
{{--                                    <option value="Head of UX and Design">Head of UX and Design</option>--}}
{{--                                    <option value="Web &amp; Visual Designer (Marketing)">Web &amp; Visual Designer (Marketing)</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6 form-group">--}}
{{--                                <label for="template-jobform-salary">Expected Salary</label>--}}
{{--                                <input type="text" name="template-jobform-salary" id="template-jobform-salary" value="" size="22" tabindex="6" class="sm-form-control" />--}}
{{--                            </div>--}}

{{--                            <div class="col-md-6 form-group">--}}
{{--                                <label for="template-jobform-time">Start Date</label>--}}
{{--                                <input type="text" name="template-jobform-start" id="template-jobform-start" value="" size="22" tabindex="7" class="sm-form-control" />--}}
{{--                            </div>--}}

{{--                            <div class="w-100"></div>--}}

{{--                            <div class="col-12 form-group">--}}
{{--                                <label for="template-jobform-website">Website (if any)</label>--}}
{{--                                <input type="text" name="template-jobform-website" id="template-jobform-website" value="" size="22" tabindex="8" class="sm-form-control" />--}}
{{--                            </div>--}}

{{--                            <div class="col-12 form-group">--}}
{{--                                <label for="template-jobform-experience">Experience (optional)</label>--}}
{{--                                <textarea name="template-jobform-experience" id="template-jobform-experience" rows="3" tabindex="10" class="sm-form-control"></textarea>--}}
{{--                            </div>--}}

{{--                            <div class="col-12 form-group">--}}
{{--                                <label for="template-jobform-application">Application <small>*</small></label>--}}
{{--                                <textarea name="template-jobform-application" id="template-jobform-application" rows="6" tabindex="11" class="sm-form-control required"></textarea>--}}
{{--                            </div>--}}

{{--                            <div class="col-12 form-group d-none">--}}
{{--                                <input type="text" id="template-jobform-botcheck" name="template-jobform-botcheck" value="" class="sm-form-control" />--}}
{{--                            </div>--}}

{{--                            <div class="col-12 form-group">--}}
{{--                                <button class="button button-3d button-large w-100 m-0" name="template-jobform-apply" type="submit" value="apply">Send Application</button>--}}
{{--                            </div>--}}

{{--                            <input type="hidden" name="prefix" value="template-jobform-">--}}

{{--                        </form>--}}
{{--                    </div>--}}

                </div>
            </div>

        </div>
    </div>
@endsection
@push('custom-scripts')
    <script>

    </script>
@endpush
