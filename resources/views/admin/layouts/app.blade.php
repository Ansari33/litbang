<!DOCTYPE html>
<html lang="en" >
<head>
	<meta charset="utf-8"/>
	<title>Litbang - @yield('title')</title>
	<meta name="description" content="Page with empty content"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="host_url" content="{{ url('/') }}">

	<meta http-equiv='cache-control' content='no-cache'>
	<meta http-equiv='expires' content='0'>
	<meta http-equiv='pragma' content='no-cache'>

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
	<link href="{{ asset('admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" href="{{ asset('admin/plugins/custom/jstree/jstree.bundle.css') }}">
	<link href="{{ asset('admin/plugins/custom/pace/pace.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/custom.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/plugins/custom/jquery-bootstrap-scrolling-tabs/dist/jquery.scrolling-tabs.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css"/>
	{{-- <link rel="stylesheet" href="{{ asset('admin/plugins/custom/printPage/css/normalize.min.css') }}"> --}}
    <link href="{{ asset('admin/plugins/custom/uppy/uppy.bundle.css') }}" rel="stylesheet" type="text/css"/>


	<link rel="shortcut icon" href="{{ asset('images/litbang-min.png') }}"/>
	@stack('style')
	<script src="{{ asset('admin/plugins/custom/pace/pace.min.js') }}"></script>
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	@include('admin.layouts.base.header-mobile')
	<div class="d-flex flex-column flex-root">
		<div class="d-flex flex-row flex-column-fluid page">
			@include('admin.layouts.base.aside')
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				@include('admin.layouts.base.header')
				@yield('content')
				@if(Session()->has('over'))

				@endif
				@include('admin.layouts.base.footer')
			</div>
		</div>
	</div>
	@include('admin.layouts.base.user_panel')
	@include('admin.layouts.base.quick_panel')

	<div id="kt_scrolltop" class="scrolltop">
		<span class="svg-icon">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
				<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
					<polygon points="0 0 24 0 24 24 0 24"/>
					<rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
					<path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero"/>
				</g>
			</svg>
		</span>
	</div>

	<script>
    var KTAppSettings = {
      "breakpoints": {
        "sm": 576,
        "md": 768,
        "lg": 992,
        "xl": 1200,
        "xxl": 1400
      },
      "colors": {
        "theme": {
          "base": {
            "white": "#ffffff",
            "primary": "#3699FF",
            "secondary": "#E5EAEE",
            "success": "#1BC5BD",
            "info": "#8950FC",
            "warning": "#FFA800",
            "danger": "#F64E60",
            "light": "#E4E6EF",
            "dark": "#181C32"
          },
          "light": {
            "white": "#ffffff",
            "primary": "#E1F0FF",
            "secondary": "#EBEDF3",
            "success": "#C9F7F5",
            "info": "#EEE5FF",
            "warning": "#FFF4DE",
            "danger": "#FFE2E5",
            "light": "#F3F6F9",
            "dark": "#D6D6E0"
          },
          "inverse": {
            "white": "#ffffff",
            "primary": "#ffffff",
            "secondary": "#3F4254",
            "success": "#ffffff",
            "info": "#ffffff",
            "warning": "#ffffff",
            "danger": "#ffffff",
            "light": "#464E5F",
            "dark": "#ffffff"
          }
        },
        "gray": {
          "gray-100": "#F3F6F9",
          "gray-200": "#EBEDF3",
          "gray-300": "#E4E6EF",
          "gray-400": "#D1D3E0",
          "gray-500": "#B5B5C3",
          "gray-600": "#7E8299",
          "gray-700": "#5E6278",
          "gray-800": "#3F4254",
          "gray-900": "#181C32"
        }
      },
      "font-family": "Poppins"
    };
	</script>
	<script src="{{ asset('admin/plugins/global/plugins.bundle.js') }}"></script>
	<script src="{{ asset('admin/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
	<script src="{{ asset('admin/js/scripts.bundle.js') }}"></script>
{{--	<script src="{{ asset('admin/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>--}}
{{--	<script src="{{ asset('admin/plugins/custom/gmaps/gmaps.js') }}"></script>--}}
	<script src="{{ asset('admin/plugins/custom/datatables/datatables.bundle.js') }}"></script>
{{--	<script src="{{ asset('admin/plugins/custom/dataTables-treeGrid/dataTables.treeGrid.js') }}"></script>--}}

	<!-- Report Button Datatable -->
{{--	<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>--}}
{{--	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
{{--	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
{{--	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
{{--	<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>--}}
	<!-- https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js
https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js
https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js
https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js
https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js -->
	<!-- End -->

{{--	<script src="{{ asset('admin/plugins/custom/price-format/jquery.priceformat.min.js') }}"></script>--}}
	<script src="{{ asset('admin/plugins/custom/datatables/api/sum().js') }}"></script>
	<script src="{{ asset('admin/plugins/custom/jquery-bootstrap-scrolling-tabs/dist/jquery.scrolling-tabs.js') }}"></script>
	<script src="{{ asset('admin/js/pages/widgets.js') }}"></script>
	<script src="{{ asset('admin/plugins/custom/datatables/sorting/date-eu.js') }}"></script>
	<script src="{{ asset('admin/plugins/custom/datatables/sorting/date-euro.js') }}"></script>
	<script src="{{ asset('admin/plugins/custom/datatables/sorting/currency.js') }}"></script>
	<script src="{{ asset('admin/plugins/custom/datatables/sorting/numeric-comma.js') }}"></script>
	<script src="{{ asset('admin/plugins/custom/datatables/sorting/any-number.js') }}"></script>
	<script src="{{ asset('admin/plugins/custom/datatables/sorting/num-html.js') }}"></script>
	<script src="{{ asset('admin/plugins/custom/datatables/sorting/formatted-numbers.js') }}"></script>
{{--	<script src="{{ asset('admin/plugins/custom/printPage/js/jQuery.print.js') }}"></script>--}}
	<script src="{{ asset('admin/js/pages/features/custom/spinners.js') }}"></script>
	<script src="{{ asset('admin/js/pages/crud/forms/widgets/select2.js') }}"></script>
	<script src="{{ asset('admin/js/pages/crud/forms/widgets/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('admin/js/pages/crud/forms/widgets/bootstrap-timepicker.js') }}"></script>
	<script src="{{ asset('admin/js/app.js') }}"></script>
	<script src="{{ asset('admin/js/barang_jasa.js') }}"></script>
	<script src="{{ asset('admin/js/penjualan.js') }}"></script>
	<script src="{{ asset('admin/js/datatableTransaksi.js') }}?n=1"></script>
	<script src="{{ asset('admin/js/fileDownload.js') }}"></script>
	<script src="{{ asset('admin/js/notices.js') }}"></script>
	<script src="https://unpkg.com/@develoka/angka-terbilang-js@1.4.1/index.min.js"></script>

    <script src="https://js.pusher.com/7.2.0/pusher.min.js"></script>

	@stack('js')
	<script type="text/javascript">


		//expired = ;
		//console.log(expired);
    $(document).ajaxStart(function() {
      Pace.restart();
    });
    $(document).ajaxError(function(event, jqxhr, settings, exception) {
      if (exception == 'Unauthorized') {

			//$('#modal_uang_muka').modal('show');

        var redirect = confirm("You're session has expired. Would you like to be redirected to the login page?");
        if (redirect) {
          {{--window.location = '{{ url('logout') }}';--}}
        }
      }
    });
		{{--    window.onbeforeunload = function() {--}}
		{{--      return "Dude, are you sure you want to leave? Think of the kittens!";--}}
		{{--    }--}}
    // $('body a').dblclick(function(e){
    //   e.preventDefault();
    // })

    $("#relogin_form").submit(function(e){
    	e.preventDefault();
		  $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	    $.ajax({
	    	type: "POST",
	      timeout: 50000,
	      {{--url: '{{ route('login') }}',--}}
	      async: true,
	      data: {token:'csrf_token()','email':$('#email').val(),'password':$('#password').val()},
	      success: function (res) {
	      	//console.log(res);
	        notice('Relogin Berhasil!','success');
	        check();
	        $("#relogin_form").trigger('reset');
	        $('#modal_login').modal('hide');
	      },
	      error: function (res, textstatus) {
	        if (textstatus === "timeout") {
	          notice('Response Time Out', 'error');
	        } else {
	          notice(res.responseJSON.message, 'error');
	        }
	      }
	    });
		});
	</script>
    <script>
        var pusher = new Pusher("40ab74c9addd0e520f33", {
            cluster: "ap1",
        });
        var channel = pusher.subscribe('test-channel');
        channel.bind('test-event', function(data) {
            alert(JSON.stringify(data));
            console.log(JSON.stringify(data));
            $('#spen').val(data);
            // this is called when the event notification is received...
        });
    </script>
</body>
</html>
