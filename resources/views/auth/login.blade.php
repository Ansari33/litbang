<!DOCTYPE html>
<html lang="en">
<head>
	<base href="{{ url('/') }}">
	<meta charset="utf-8"/>
	<title>Litbang | Login</title>
	<meta name="description" content="Accounting Login"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
	<meta name="csrf-token" content="{{ csrf_token() }}" />

	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>

	<link href="{{ asset('admin/css/pages/login/login-1.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/plugins/global/plugins.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/style.bundle.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/themes/layout/header/base/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/themes/layout/header/menu/light.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/themes/layout/brand/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('admin/css/themes/layout/aside/dark.css?v=7.0.6') }}" rel="stylesheet" type="text/css"/>
	<link rel="shortcut icon" href="{{ asset('admin/media/logos/litbang-min.png') }}"/>
</head>

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

<div class="d-flex flex-column flex-root">
	<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
{{--		<div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">--}}
{{--			<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">--}}
{{--				<h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;">--}}
{{--					Lebih mudah dan cepat<br/>dengan Accounting Online--}}
{{--				</h3>--}}
{{--			</div>--}}
{{--			<div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center" style="background-image: url('{{ asset('media/svg/illustrations/login-visual-1.svg') }}')"></div>--}}
{{--		</div>--}}
		<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto">
			<div class="d-flex flex-column-fluid flex-center">
				<div class="login-form login-signin">
					<form class="form" novalidate="novalidate" id="kt_login_signin_form">
						<div class="pb-13 pt-lg-0 pt-5 text-center">
							<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Litbang Login</h3>
						</div>
						<div class="form-group">
							<label class="font-size-h6 font-weight-bolder text-dark">Email</label>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="text" name="email" autocomplete="off" value=""/>
						</div>
						<div class="form-group">
							<div class="d-flex justify-content-between mt-n5">
								<label class="font-size-h6 font-weight-bolder text-dark pt-5">Password</label>

							</div>
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg" type="password" name="password" autocomplete="off" value=""/>
						</div>
						<div class="pb-lg-0 pb-5">
							<button type="submit" id="kt_login_signin_submit" class="btn btn-primary btn-block font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-3">Login</button>
						</div>
            <a href="javascript:" class="text-primary font-size-h6 font-weight-bolder text-hover-primary pt-5" id="kt_login_forgot">Lupa Password ?</a>
					</form>
				</div>
				<div class="login-form login-forgot">
					<form class="form" novalidate="novalidate" id="kt_login_forgot_form">
						<div class="pb-13 pt-lg-0 pt-5">
							<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">Lupa Password ?</h3>
							<p class="text-muted font-weight-bold font-size-h4">Masukan email anda untuk mereset password</p>
						</div>
						<div class="form-group">
							<input class="form-control form-control-solid h-auto py-7 px-6 rounded-lg font-size-h6" type="email" placeholder="Email" name="email" autocomplete="off"/>
						</div>
						<div class="form-group d-flex flex-wrap pb-lg-0">
							<button type="button" id="kt_login_forgot_submit" class="btn btn-primary font-weight-bolder font-size-h6 px-8 py-4 my-3 mr-4">Kirim</button>
							<button type="button" id="kt_login_forgot_cancel" class="btn btn-light-primary font-weight-bolder font-size-h6 px-8 py-4 my-3">Batal</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	function login() {
    const $form = $('#kt_login_signin_form');
    var btn_login = KTUtil.getById("kt_login_signin_submit");
    KTUtil.btnWait(btn_login, "spinner spinner-right spinner-white pr-15", "Please wait");
    $.ajaxSetup({
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });
    $.ajax({
      type: "POST",
      timeout: 50000,
      url : "{{ route('login') }}",
      data: $form.serialize(),
      success: function (res) {
          console.log(res);
        window.location.replace("{{ url('/litbang-admin')  }}");
      },
      error: function (res, textstatus) {
        KTUtil.btnRelease(btn_login);
        if (textstatus === "timeout") {
          swal.fire({
            text: "Response Time Out.",
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light-primary"
            }
          }).then(function () {
            KTUtil.scrollTop();
          });
        } else {
          swal.fire({
            text: res.responseJSON.message,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
              confirmButton: "btn font-weight-bold btn-light-primary"
            }
          }).then(function () {
            KTUtil.scrollTop();
          });
        }

      }
    });
  }
</script>
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
<script src="{{ asset('admin/plugins/global/plugins.bundle.js?v=7.0.6') }}"></script>
<script src="{{ asset('admin/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6') }}"></script>
<script src="{{ asset('admin/js/scripts.bundle.js?v=7.0.6') }}"></script>
<script src="{{ asset('admin/js/login.js?v=7.0.6') }}"></script>
</body>
</html>
